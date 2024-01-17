<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Cost extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public static function booted()
    {
        static::created(function (Cost $cost)
        {
            if(Auth::check())
            {
                self::where('id', $cost->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (Cost $cost)
        {
            if(Auth::check())
            {
                self::where('id', $cost->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (Cost $cost)
        {
            if(Auth::check())
            {
                self::where('id', $cost->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
