<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Billing;

class Expandeture extends Model
{
    use HasFactory, SoftDeletes;

    public function billing(){
        return $this->belongsTo(Billing::class, 'billing_id', 'id');
    }
}
