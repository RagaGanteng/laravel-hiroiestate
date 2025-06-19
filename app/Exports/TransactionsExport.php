<?php

namespace App\Exports;

use App\Models\PropertyTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    protected $from, $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function collection()
    {
        return PropertyTransaction::with(['propertyType', 'agent'])
            ->whereBetween('date', [$this->from, $this->to])
            ->get()
            ->map(function ($tx) {
                return [
                    'Customer Name' => $tx->customer_name,
                    'Email' => $tx->customer_email,
                    'Property Type' => $tx->propertyType->name,
                    'Agent' => $tx->agent->name,
                    'Status' => ucfirst($tx->status),
                    'Date' => $tx->date,
                    'Notes' => $tx->notes,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Customer Name', 'Email', 'Property Type', 'Agent', 'Status', 'Date', 'Notes'
        ];
    }
}

