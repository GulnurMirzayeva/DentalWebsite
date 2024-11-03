<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPackage extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = [
        'price',
    ];

    public $translatedAttributes = [
        'name',
        'slug',
        'service_name',
    ];


    public function services()
    {
        return $this->belongsToMany(Service::class, 'pricing_package_service');
    }



}
