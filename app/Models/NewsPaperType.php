<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\AdvertiseCost;
use App\Models\NewsPaper;

class NewsPaperType extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function advertiseCost(){
        return $this->hasMany(AdvertiseCost::class, 'news_paper_type_id', 'id');
    }

    public function newsPaper(){
        return $this->hasMany(NewsPaper::class, 'news_paper_type_id', 'id');
    }

    public static function booted()
    {
        static::created(function (NewsPaperType $newsPaperType)
        {
            if(Auth::check())
            {
                self::where('id', $newsPaperType->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (NewsPaperType $newsPaperType)
        {
            if(Auth::check())
            {
                self::where('id', $newsPaperType->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (NewsPaperType $newsPaperType)
        {
            if(Auth::check())
            {
                self::where('id', $newsPaperType->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
