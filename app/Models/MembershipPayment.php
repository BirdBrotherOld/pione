<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'membership_id', 'photo', 'payment_period', 'payment_for',
    ];

    protected $hidden = [

    ];

    protected $dates = [
        'created_at', 'updated_at', 'payment_period',
    ];

    // public $appends = ['url'];

    // public function getUrlAttribute()
    // {
    //     return Storage::disk('s3')->url($this->photo);
    // }

    public function membership()
    {
        return $this->belongsTo(UserMembership::class, 'membership_id');
    }
}
