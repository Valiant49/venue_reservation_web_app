<?php

namespace App\Http\Controllers\Staff;

use App\Models\Resident;
use App\Models\Facility;
use App\Models\Log;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Staff;
use Database\Seeders\DatabaseSeeder;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

class XmlController extends Controller
{
    private array $entityMap = [
        'residents' => [
            'model' => Resident::class,
            'singular' => 'resident',
            'fields' => [
                'id',
                'block_num',
                'lot_num',
                'street_num',
                'first_name',
                'middle_name',
                'last_name',
                'contact_num',
                'email'
            ],
        ],
        'facilities' => [
            'model' => Facility::class,
            'singular' => 'facility',
            'fields' => [
                'id',
                'name',
                'category',
                'description',
                'reservation_type',
                'facility_status',
                'base_fee',
                'starting_hours',
                'closing_hours',
                'max_capacity',
                'max_reservation_duration',
            ],
        ],
        'reservations' => [
            'model' => Reservation::class,
            'singular' => 'reservation',
            'fields' => [
                'id',
                'code',
                'date',
                'start_time',
                'end_time',
                'total_fee',
                'guest_count',
                'event_type',
                'status',
                'notes',
                'facility_id',
                'reserved_by',
                'facilitated_by',
                'created_at',
                'updated_at',
            ],
        ],
        'staffs' => [
            'model' => Staff::class,
            'singular' => 'staff',
            'fields' => [
                'id',
                'first_name',
                'middle_name',
                'last_name',
                'role',
                'email',
                'created_at',
            ],
        ],
    ];

    public function index()
    {
        $residents = Resident::get();

        return view('employee-facing.xml-settings.index', compact('residents'));
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
                    // $value = htmlspecialchars((string) ($record->$field ?? ''), ENT_XML1, 'UTF-8');
                    $value = htmlspecialchars(
                        (string) $this->transformExportData($entity, $record, $field),
                        ENT_XML1,
                        'UTF-8'
                    );
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

            $data = $this->transformImportData($entity, $data);

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
            'residents'    => 'email',
            'facilities'   => 'name',
            'reservations' => 'code',
            'staffs'       => 'email',
        ];

        $field = $uniqueFields[$entity] ?? null;

        if (!$field || empty($data[$field])) return null;

        $unique = [$field => $data[$field]];
        $rest   = array_diff_key($data, $unique);

        return [$unique, $rest];
    }

    private function transformExportData(
        string $entity,
        $record,
        string $field
    )
    {
        if ($entity === 'reservations') {

            return match ($field) {

                'facility_id' =>
                    optional($record->facility)->name,

                'reserved_by' =>
                    optional($record->resident)->email,

                'facilitated_by' =>
                    optional($record->staff)->email,

                default =>
                    $record->$field,
            };
        }

        return $record->$field;
    }

    private function transformImportData(
        string $entity,
        array $data
    ): array
    {
        if ($entity === 'reservations') {

            $data['facility_id'] =
                Facility::where('name', $data['facility_id'])->value('id');

            $data['reserved_by'] =
                Resident::where('email', $data['reserved_by'])->value('id');

            if (!empty($data['facilitated_by'])) {

                $data['facilitated_by'] =
                    Staff::where('email', $data['facilitated_by'])->value('id');
            }
        }

        return $data;
    }
}
