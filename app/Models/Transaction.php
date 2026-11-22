<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id', 'code', 'shipping_price', 'total_price', 'transaction_status'
    ];

    protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }

    public function transaction_detail(){
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }
}
