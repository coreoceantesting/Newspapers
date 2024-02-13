<?php

namespace App\Exports;

use App\Models\Billing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BillingExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $billing;

    public function __construct($billing)
    {
        $this->billing = $billing;
    }
    public function collection()
    {
        return $this->billing;
    }

    public function map($billing): array
    {
        return [
            $billing?->department?->name,
            $billing->bill_number,
            ($billing->bill_date) ? date('d-m-Y', strtotime($billing->bill_date)) : '',
            $billing?->newsPaper?->name,
            $billing?->accountDetails?->bank,
            $billing?->accountDetails?->branch,
            $billing?->accountDetails?->account_number,
            $billing?->accountDetails?->ifsc_code,
            $billing?->accountDetails?->pan_card,
            $billing?->accountDetails?->gst_no,
            $billing->basic_amount,
            $billing->gst,
            $billing->gross_amount,
            $billing->tds,
            $billing->it,
            $billing->net_amount,
        ];
    }

    public function headings(): array
    {
        return ["विभाग", "बिल क्रमांक", "बिल तारीख", "वर्तमानपत्राचे नाव", "बँकेचे नाव", "शाखेचे नाव", "खाते क्रमांक", "IFSC कोड", "पॅन कार्ड", "GST क्रमांक", "Basic Amount", "GST", "Gross Amount", "TDS", "IT", "Net Amount"];
    }
}
