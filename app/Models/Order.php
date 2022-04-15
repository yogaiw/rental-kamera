<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function alat() {
        return $this->belongsTo(Alat::class,'alat_id');
    }

    public function payment() {
        return $this->belongsTo(Payment::class,'payment_id');
    }
}
