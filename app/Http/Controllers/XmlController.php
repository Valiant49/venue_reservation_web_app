<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facility;
use App\Models\Reservation;
use DOMDocument;
use Illuminate\Http\Request;

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
    ];

    public function index()
    {
        $clients = Client::get();

        return view('xml-settings.index', compact('clients'));
    }

    public function export(string $entity)
    {
        abort_unless(array_key_exists($entity, $this->entityMap), 404);

        $config = $this->entityMap[$entity];
        $records = $config['model']::all();

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = 'true';

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
    }

    public function import(Request $request, string $entity)
    {
        abort_unless(array_key_exists($entity, $this->entityMap), 404);

        $request->validate(['xml_file' => 'required|file|mimes:xml,text|max:2048']);

        $config = $this->entityMap[$entity];

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->loadXML(file_get_contents($request->file('xml_file')->getRealPath()));

        // dd($dom);
        // dump($dom->getElementsByTagName($config['singular']));

        $count = 0;
        foreach ($dom->getElementsByTagName($config['singular']) as $node) {
            $data = [];

            foreach ($config['fields'] as $field) {
                $data[$field] = trim($node->getElementsByTagName($field)->item(0)?->textContent ?? '');
            }

            try {
                unset($data['id']);
                $config['model']::create($data);
                $count++;
            } catch (\Throwable $e) {
                dump($e->getMessage());
            }
            // dump($data);

        }
        return back()->with('success', "Imported {$count} {$entity} successfully.");
    }
}
