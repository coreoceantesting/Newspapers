<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\NewsPaper;
use App\Models\Billing;

class AccountDetail extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['news_paper_id', 'bank', 'branch', 'account_number', 'ifsc_code', 'pan_card', 'gst_no', 'document'];

    public function newsPaper()
    {
        return $this->belongsTo(NewsPaper::class, 'news_paper_id', 'id');
    }

    public function billing()
    {
        return $this->hasMany(Billing::class, 'account_detail_id', 'id');
    }

    public static function booted()
    {
        static::created(function (AccountDetail $accountDetail) {
            if (Auth::check()) {
                self::where('id', $accountDetail->id)->update([
                    'created_by' => Auth::user()->id,
                ]);
            }
        });
        static::updated(function (AccountDetail $accountDetail) {
            if (Auth::check()) {
                self::where('id', $accountDetail->id)->update([
                    'updated_by' => Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (AccountDetail $accountDetail) {
            if (Auth::check()) {
                self::where('id', $accountDetail->id)->update([
                    'deleted_by' => Auth::user()->id,
                ]);
            }
        });
    }
}
