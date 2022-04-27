<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function order() {
        return $this->hasMany(Order::class,'alat_id','id');
    }
}
