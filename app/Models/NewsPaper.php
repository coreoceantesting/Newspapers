<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\NewsPaperType;
use App\Models\AdvertiseNewsPaper;
use App\Models\Language;
use App\Models\Billing;
use App\Models\AccountDetail;

class NewsPaper extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['news_paper_type_id', 'language_id', 'name', 'editor_name', 'email', 'mobile'];

    public function newsPaperType(){
        return $this->belongsTo(NewsPaperType::class, 'news_paper_type_id', 'id');
    }

    public function language(){
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function billing(){
        return $this->belongsTo(Billing::class, 'billing_id', 'id');
    }

    public function advertiseNewsPaper(){
        return $this->hasOne(AdvertiseNewsPaper::class, 'news_paper_id', 'id');
    }

    public function accountDetails(){
        return $this->hasMany(AccountDetail::class, 'news_paper_id', 'id');
    }

    public static function booted()
    {
        static::created(function (NewsPaper $newsPaper)
        {
            if(Auth::check())
            {
                self::where('id', $newsPaper->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (NewsPaper $newsPaper)
        {
            if(Auth::check())
            {
                self::where('id', $newsPaper->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (NewsPaper $newsPaper)
        {
            if(Auth::check())
            {
                self::where('id', $newsPaper->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
