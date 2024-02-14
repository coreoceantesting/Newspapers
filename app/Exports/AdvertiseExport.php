<?php

namespace App\Exports;

use App\Models\Advertise;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AdvertiseExport implements FromView
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

    public function view(): View
    {
        return view('advertise.export', [
            'advertises' => $this->advertise,
            'is_mail_send' => request()->is_mail_send
        ]);
    }
}
