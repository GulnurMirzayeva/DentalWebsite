<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description_one',
        'description_two'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
