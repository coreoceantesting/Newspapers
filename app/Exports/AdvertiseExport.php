<?php

namespace App\Exports;

use App\Models\Advertise;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdvertiseExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $advertise;

    public function __construct($advertise)
    {
        $this->advertise = $advertise;
    }

    public function collection()
    {
        return $this->advertise;
    }

    public function map($advertise): array
    {
        return [
            $advertise->unique_number,
            $advertise->work_order_number,
            $advertise?->publicationType?->name,
            $advertise?->cost?->name,
            $advertise?->department?->name,
            $advertise?->printType?->name,
            $advertise?->bannerSize?->size,
            $advertise->context,
            ($advertise->context_date) ? date('d-m-Y', strtotime($advertise->context_date)) : ''
        ];
    }

    public function headings(): array
    {
        return ["युनिक क्र", "वर्क ऑर्डर क्र", "प्रसिध्दीचा स्तर", "कामाची किंमत", "विभाग", "प्रिंट प्रकार", "बॅनर आकार", "संदर्भ", "संदर्भ तारीख"];
    }
}
