<?php

namespace App\Exports;

use App\Models\Billing;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BillingExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $billing;

    public function __construct($billing)
    {
        $this->billing = $billing;
    }

    public function view(): View
    {
        return view('billing.export', [
            'billing' => $this->billing
        ]);
    }
}
