<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'category', 'price', 'user_id', 'path', 'size', 'is_merchandise'
    ];

    protected $hidden = [

    ];

    public function getUrlAttribute()
    {
        return Storage::disk('s3')->url($this->path);
    }

    public function getSizeInKbAttribute()
    {
        return round($this->size / 1024, 2);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
