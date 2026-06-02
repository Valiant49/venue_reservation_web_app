<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facility;
use App\Models\Log;
use App\Models\Reservation;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class XmlController extends Controller
{
    private array $entityMap = [
        'clients' => [
            'model' => Client::class,
            'singular' => 'client',
            'fields' => [
                'id',
                'block_num',
                'lot_num',
                'street_num',
                'first_name',
                'middle_name',
                'last_name',
                'contact_num',
                'email'],
        ],
        'facilities' => [
            'model' => Facility::class,
            'singular' => 'facility',
            'fields' => [
                'id',
                'facility_code',
                'facility_name',
                'facility_type',
                'base_fee',
                'capacity',
                'description'],
        ],
        'reservations' => [
            'model' => Reservation::class,
            'singular' => 'reservation',
            'fields' => [
                'id',
                'reservation_code',
                'reservation_date',
                'start_time',
                'end_time',
                'total_fee',
                'created_at',
                'updated_at',
                'guest_count',
                'status',
                'event_type',
                'notes',
                'facility_id',
                'reserved_by',
                'facilitated_by',
            ],
        ],
        'staffs' => [

            'model' => User::class,
            'singular' => 'staff',
            'fields' => [
                'id',
                'name',
                'email',
                'role',
                'created_at',
            ],
        ],
    ];

    public function index()
    {
        $clients = Client::get();

        return view('xml-settings.index', compact('clients'));
    }

    public function export(string $entity)
    {
        abort_unless(array_key_exists($entity, $this->entityMap), 404);

        try {
            $config = $this->entityMap[$entity];
            $records = $config['model']::all();

            if ($records->isEmpty()) {
                return redirect()->route('xml.index')->with('error', "No {$entity} records found to export.");
            }

            $dom = new DOMDocument('1.0', 'UTF-8');
            $dom->formatOutput = true;

            $root = $dom->createElement('records');
            $dom->appendChild($root);

            foreach ($records as $record) {
                $node = $dom->createElement($config['singular']);

                foreach ($config['fields'] as $field) {
                    $value = htmlspecialchars((string) ($record->$field ?? ''), ENT_XML1, 'UTF-8');
                    $node->appendChild($dom->createElement($field, $value));
                }

                $root->appendChild($node);
            }

            return response($dom->saveXML(), 200, [
                'Content-Type' => 'application/xml',
                'Content-Disposition' => "attachment; filename={$entity}_export.xml",
            ]);
        } catch (\Throwable $e) {
            return redirect()->route('xml.index')->with('error', "Export failed: {$e->getMessage()}");
        }
    }

    public function import(Request $request, string $entity)
    {
        abort_unless(array_key_exists($entity, $this->entityMap), 404);

        $request->validate(['xml_file' => 'required|file|mimes:xml,text|max:2048']);

        $config = $this->entityMap[$entity];

        $dom = new DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        $dom->loadXML(file_get_contents($request->file('xml_file')->getRealPath()));

        $loaded = $dom->loadXML(
            file_get_contents($request->file('xml_file')->getRealPath())
        );

        if (! $loaded) {
            $xmlErrors = collect(libxml_get_errors())
                ->map(fn ($e) => "Line {$e->line}: ".trim($e->message))
                ->implode(', ');
            libxml_clear_errors();

            return back()->with('error', "Invalid XML file: {$xmlErrors}");
        }

        libxml_use_internal_errors();

        $nodes = $dom->getElementsByTagName($config['singular']);

        if ($nodes->length === 0) {
            return back()->with('error', "No <{$config['singular']}> records found in the file. Check your XML structure.");
        }

        $inserted = 0;
        $skipped = 0;
        $rowErrors = [];

        foreach ($nodes as $index => $node) {
            $row = $index + 1;
            $data = [];

            foreach ($config['fields'] as $field) {
                $data[$field] = trim($node->getElementsByTagName($field)->item(0)?->textContent ?? '');
            }

            try {
                unset($data['id'], $data['created_at'], $data['updated_at']);

                $uniqueKey = $this->getUniqueKey($entity, $data);

                if ($uniqueKey) {
                    [$unique, $rest] = $uniqueKey;
                    $record = $config['model']::firstOrCreate($unique, $rest);

                    
                    if ($record->wasRecentlyCreated) {
                        $inserted++;
                    } else {
                        $skipped++;
                    }
                } else {
                    $config['model']::create($data);
                    $inserted++;
                }
            } catch (\Throwable $e) {
                $rowErrors[] = "Row {$row}: {$e->getMessage()}";
                $skipped++;
            }
        }

        return back()->with([
            'success' => "Imported {$inserted} {$entity} successfully, {$skipped} skipped.",
            'row-error' => $rowErrors, ]);
    }

    public function reset(Request $request)
    {
        $request->validate(
            ['verification-code' => 'required']
        );

        $secretCode = 80102;

        if ((int) $request->input('verification-code') !== $secretCode) {
            return back()->withErrors([
                'verification-code' => 'Incorrect code.',
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Reservation::truncate();
        Client::truncate();
        Facility::truncate();
        User::truncate();
        Log::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Artisan::call('db:seed', ['--class' => 'DatabaseSeeder']);

        return redirect()->route('xml.index')->with('success', 'System data has been wiped.');
    }

    private function getUniqueKey(string $entity, array $data): ?array
    {
        $uniqueFields = [
            'clients'      => 'email',
            'facilities'   => 'facility_code',
            'reservations' => 'reservation_code',
            'staffs'       => 'email',
        ];

        $field = $uniqueFields[$entity] ?? null;

        if (!$field || empty($data[$field])) return null;

        $unique = [$field => $data[$field]];
        $rest   = array_diff_key($data, $unique);

        return [$unique, $rest];
    }
}
