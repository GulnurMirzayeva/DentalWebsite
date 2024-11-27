<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPackageTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'service_name',
        'locale',
        'pricing_package_id'
    ];
}
