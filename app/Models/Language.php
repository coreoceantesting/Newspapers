<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\NewsPaper;

class Language extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function newsPapers(){
        return $this->hasMany(NewsPaper::class, 'language_id', 'id');
    }

    public static function booted()
    {
        static::created(function (Language $language)
        {
            if(Auth::check())
            {
                self::where('id', $language->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (Language $language)
        {
            if(Auth::check())
            {
                self::where('id', $language->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (Language $language)
        {
            if(Auth::check())
            {
                self::where('id', $language->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
