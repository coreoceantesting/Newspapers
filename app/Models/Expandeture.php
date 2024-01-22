<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Billing;
use App\Models\NewsPaper;

class Expandeture extends Model
{
    use HasFactory, SoftDeletes;

    public function billing(){
        return $this->belongsTo(Billing::class, 'billing_id', 'id');
    }

    public function newsPaper(){
        return $this->belongsTo(NewsPaper::class, 'news_paper_id', 'id');
    }
}
