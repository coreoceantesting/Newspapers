<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NewsPaper;
use App\Models\Advertise;

class AdvertiseNewsPaper extends Model
{
    use HasFactory;

    public function newsPaper(){
        return $this->belongsTo(NewsPaper::class, 'news_paper_id', 'id');
    }

    public function advertise(){
        return $this->belongsTo(Advertise::class, 'advertise_id', 'id');
    }
}
