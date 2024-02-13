<?php

namespace App\Exports;

use App\Models\Expandeture;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExpandetureExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $expendature;

    public function __construct($expendature)
    {
        $this->expendature = $expendature;
    }

    public function collection()
    {
        return $this->expendature;
    }

    public function map($expendature): array
    {
        return [
            ($expendature->created_at) ? date('d-m-Y', strtotime($expendature->created_at)) : '',
            $expendature->unique_no,
            $expendature?->billing?->bill_number,
            $expendature?->newsPaper?->name,
            round($expendature->invoice_amount, 2),
            round($expendature->balance, 2)
        ];
    }

    public function headings(): array
    {
        return ["दिनांक", "युनिक क्र", "बिल क्र", "वर्तमानपत्र नाव", "देयाकावारची रक्कम", "शिल्लक"];
    }
}
