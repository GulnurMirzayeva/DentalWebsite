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
        'locale',  // Add locale to fillable attributes
        'pricing_package_id'  // Also add this to ensure it can be set
    ];
}
