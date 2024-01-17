<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Cost;
use App\Models\PublicationType;
use App\Models\Department;
use App\Models\PrintType;
use App\Models\BannerSize;
use App\Models\AdvertiseNewsPaper;
use App\Models\Billing;

class Advertise extends Model
{
    use HasFactory, SoftDeletes;

    public function cost(){
        return $this->belongsTo(Cost::class, 'cost_id', 'id');
    }

    public function publicationType(){
        return $this->belongsTo(PublicationType::class, 'publication_type_id', 'id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function printType(){
        return $this->belongsTo(PrintType::class, 'print_type_id', 'id');
    }

    public function bannerSize(){
        return $this->belongsTo(BannerSize::class, 'banner_size_id', 'id');
    }

    public function advertiseNewsPapers(){
        return $this->hasMany(AdvertiseNewsPaper::class, 'advertise_id', 'id');
    }

    public function billing(){
        return $this->hasMany(Billing::class, 'advertise_id', 'id');
    }
}
