<?php

namespace App\Repository;

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

class CommonRepository{
    public function getPublicationType(){
        return PublicationType::latest()->get();
    }

    public function getCost(){
        return Cost::latest()->get();
    }

    public function getNewsPaperType(){
        return NewsPaperType::latest()->get();
    }

    public function getLanguage(){
        return Language::latest()->get();
    }

    public function getDepartment(){
        return Department::latest()->get();
    }

    public function getPrintType(){
        return PrintType::latest()->get();
    }

    public function getBannerSize(){
        return BannerSize::latest()->get();
    }
}