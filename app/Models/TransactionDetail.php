<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'transaction_id', 'code','product_id', 'event_id', 'price', 'resi', 'total_price', 'transaction_status'
    ];

    protected $hidden = [];
    
    public function transaction(){
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
