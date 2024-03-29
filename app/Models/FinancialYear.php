<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\BudgetProvision;

class FinancialYear extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function budgetProvision(){
        return $this->hasOne(BudgetProvision::class, 'financial_year_id', 'id');
    }

    public static function booted()
    {
        static::created(function (FinancialYear $financialYear)
        {
            if(Auth::check())
            {
                self::where('id', $financialYear->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (FinancialYear $financialYear)
        {
            if(Auth::check())
            {
                self::where('id', $financialYear->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (FinancialYear $financialYear)
        {
            if(Auth::check())
            {
                self::where('id', $financialYear->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
