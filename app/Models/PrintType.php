<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PrintType extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public static function booted()
    {
        static::created(function (PrintType $printType)
        {
            if(Auth::check())
            {
                self::where('id', $printType->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (PrintType $printType)
        {
            if(Auth::check())
            {
                self::where('id', $printType->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (PrintType $printType)
        {
            if(Auth::check())
            {
                self::where('id', $printType->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
