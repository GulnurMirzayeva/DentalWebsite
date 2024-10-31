<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintSuggestion extends Model
{
    use HasFactory;

    protected $table = 'complaints_suggestions';

    protected $fillable = [
        'fullname',
        'phone',
        'email',
        'subject',
        'message',
        'viewed',
    ];
}
