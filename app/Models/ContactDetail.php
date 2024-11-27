<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    protected $table = 'contact_details';
    protected $fillable = ['address', 'map', 'phone', 'email', 'instagram', 'facebook'];
}
