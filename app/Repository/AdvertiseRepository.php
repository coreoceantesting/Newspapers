<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\PublicationType;
use App\Models\Cost;
use App\Models\NewsPaperType;
use App\Models\Language;
use App\Models\Department;
use App\Models\PrintType;
use App\Models\BannerSize;
use App\Models\Advertise;
use App\Models\AdvertiseNewsPaper;
use App\Models\FinancialYear;
use App\Models\NewsPaper;
use App\Models\Signature;

class AdvertiseRepository{
    public function index(){
        $advertises = Advertise::with([
            'publicationType', 'cost', 'department', 'printType', 'bannerSize'
        ])->latest()->get();

        return $advertises;
    }

    public function store($request){
        
    }
}