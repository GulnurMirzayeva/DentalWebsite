<?php

namespace App\Http\Controllers;

use App\Models\AboutImage;
use App\Models\Blog;
use App\Models\HeaderImage;
use App\Models\PricingPackage;
use App\Models\Service;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ContactDetail;


class HomeController extends Controller
{
    public function index()
    {
        $packages = PricingPackage::all();
        $blogs = Blog::latest()->take(3)->get();
        $services = Service::latest()->take(4)->get();
        $allServices = Service::paginate(8);
        $sliderImages = Slider::latest()->take(2)->get();
        $defaultImageSlider = asset('assets/front/img/bg_1.jpg');
        $defaultImage = asset('assets/front/img/bg_1.jpg');
        $headerImage = HeaderImage::latest()->first();
        $backgroundImage = $headerImage && Storage::disk('public')->exists($headerImage->header_image)
            ? asset('storage/' . $headerImage->header_image)
            : $defaultImage;
        $defaultImageAbout = asset('assets/front/img/bg_1.jpg');
        $aboutImage = AboutImage::latest()->first();
        $bestDentist = $aboutImage && Storage::disk('public')->exists($aboutImage->about_image)
            ? asset('storage/' . $aboutImage->about_image)
            : $defaultImageAbout;

        $contactDetails = ContactDetail::first();

        return view('front.home', compact('packages', 'contactDetails', 'blogs', 'services', 'allServices', 'sliderImages', 'defaultImageSlider', 'backgroundImage', 'bestDentist',));
    }
}
