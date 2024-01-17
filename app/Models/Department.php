<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Department extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'initial'];

    public static function booted()
    {
        static::created(function (Department $department)
        {
            if(Auth::check())
            {
                self::where('id', $department->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });

        static::updated(function (Department $department)
        {
            if(Auth::check())
            {
                self::where('id', $department->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });

        static::deleted(function (Department $department)
        {
            if(Auth::check())
            {
                self::where('id', $department->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
