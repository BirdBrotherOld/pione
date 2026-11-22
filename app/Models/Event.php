<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'rundown', 'photos', 'location', 'price', 'start_date', 'end_date', 'chapter_id', 'is_comingsoon'
    ];

    protected $hidden = [];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'start_date', 'end_date'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
}
