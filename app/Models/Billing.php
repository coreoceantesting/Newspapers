<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\NewsPaper;
use App\Models\Department;
use App\Models\Advertise;
use App\Models\AccountDetail;

class Billing extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "billing";

    public function newsPaper(){
        return $this->belongsTo(NewsPaper::class, 'news_paper_id', 'id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function advertise(){
        return $this->belongsTo(Advertise::class, 'advertise_id', 'id');
    }

    public function accountDetails(){
        return $this->belongsTo(AccountDetail::class, 'account_detail_id', 'id');
    }
}
