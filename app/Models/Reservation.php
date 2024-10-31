<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'name',
        'email',
        'phone',
        'date',
        'time',
        'status',
    ];

    public function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
