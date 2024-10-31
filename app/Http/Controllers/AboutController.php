<?php

namespace App\Http\Controllers;

use App\Models\HeaderImage;
use App\Models\AboutImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
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

        return view('front.about', compact('backgroundImage', 'bestDentist',));
    }
}
