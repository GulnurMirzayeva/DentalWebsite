<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PricingPackage;
use App\Models\Service;
use App\Models\HeaderImage;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    public function index()
    {
        $packages = PricingPackage::all();
        $services = Service::paginate(8);
        $defaultImage = asset('assets/front/img/bg_1.jpg');
        $headerImage = HeaderImage::latest()->first();
        $backgroundImage = $headerImage && Storage::disk('public')->exists($headerImage->header_image)
            ? asset('storage/' . $headerImage->header_image)
            : $defaultImage;


        return view('front.services', compact('packages', 'services', 'backgroundImage'));
    }
}
