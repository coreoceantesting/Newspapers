<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\FinancialYear;
use App\Models\Department;

class BudgetProvision extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['financial_year_id', 'department_id', 'budget'];

    public function financialYear(){
        return $this->belongsTo(FinancialYear::class, 'financial_year_id', 'id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public static function booted()
    {
        static::created(function (BudgetProvision $budgetProvision)
        {
            if(Auth::check())
            {
                self::where('id', $budgetProvision->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (BudgetProvision $budgetProvision)
        {
            if(Auth::check())
            {
                self::where('id', $budgetProvision->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (BudgetProvision $budgetProvision)
        {
            if(Auth::check())
            {
                self::where('id', $budgetProvision->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
