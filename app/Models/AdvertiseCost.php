<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\NewsPaperType;
use App\Models\Language;
use App\Models\Cost;

class AdvertiseCost extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['news_paper_type_id', 'language_id', 'no_of_newspaper', 'cost_id'];

    public function newsPaperType(){
        return $this->belongsTo(NewsPaperType::class, 'news_paper_type_id', 'id');
    }

    public function language(){
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function cost(){
        return $this->belongsTo(Cost::class, 'cost_id', 'id');
    }

    public static function booted()
    {
        static::created(function (AdvertiseCost $advertiseCost)
        {
            if(Auth::check())
            {
                self::where('id', $advertiseCost->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });

        static::updated(function (AdvertiseCost $advertiseCost)
        {
            if(Auth::check())
            {
                self::where('id', $advertiseCost->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });

        static::deleting(function (AdvertiseCost $advertiseCost)
        {
            if(Auth::check())
            {
                self::where('id', $advertiseCost->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
