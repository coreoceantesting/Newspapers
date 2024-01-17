<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PublicationType extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public static function booted()
    {
        static::created(function (PublicationType $publicationType)
        {
            if(Auth::check())
            {
                self::where('id', $publicationType->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (PublicationType $publicationType)
        {
            if(Auth::check())
            {
                self::where('id', $publicationType->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (PublicationType $publicationType)
        {
            if(Auth::check())
            {
                self::where('id', $publicationType->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
