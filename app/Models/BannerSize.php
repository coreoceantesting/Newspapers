<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BannerSize extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['size'];

    public static function booted()
    {
        static::created(function (BannerSize $bannerSize)
        {
            if(Auth::check())
            {
                self::where('id', $bannerSize->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (BannerSize $bannerSize)
        {
            if(Auth::check())
            {
                self::where('id', $bannerSize->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (BannerSize $bannerSize)
        {
            if(Auth::check())
            {
                self::where('id', $bannerSize->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
