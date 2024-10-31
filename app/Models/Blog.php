<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = [
        'image_one',
        'image_two',
        'date',
        'comments_count',
    ];

    public $translatedAttributes = [
        'title',
        'slug',
        'description_one',
        'description_two'
    ];

    public function blog_comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_id');
    }

    public function getCommentsCountAttribute()
    {
        return $this->blog_comments()->count();
    }
}
