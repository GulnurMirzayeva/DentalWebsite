<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = [
        'icon',
    ];

    public $translatedAttributes = [
        'title',
        'slug',
        'description'
    ];

    public function pricingPackages()
    {
        return $this->belongsToMany(PricingPackage::class, 'pricing_package_service');
    }

}
