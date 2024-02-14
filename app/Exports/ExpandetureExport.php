<?php

namespace App\Exports;

use App\Models\Expandeture;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExpandetureExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $expendature;

    public function __construct($expendature)
    {
        $this->expendature = $expendature;
    }

    public function view(): View
    {
        return view('expandeture.export', [
            'expandetures' => $this->expendature
        ]);
    }
}
