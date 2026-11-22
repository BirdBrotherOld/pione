<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMembership extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id', 'points', 'ktp_num', 'born_location', 'born_date', 'nickname', 'gender', 'religion', 'size', 'address',
        'city', 'province', 'police_num', 'type', 'color', 'year_production', 'chapter_id', 'photo_car', 'photo_identity', 'photo_license',
        'vehicle_tax', 'status', 'alias', 'id_member',
    ];

    protected $hidden = [];

    protected $dates = [
        'vehicle_tax',
        'born_date',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
}
