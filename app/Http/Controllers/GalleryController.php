<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\HeaderImage;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = Gallery::orderBy('id', 'desc')->paginate(12);
        $defaultImage = asset('assets/front/img/bg_1.jpg');
        $headerImage = HeaderImage::latest()->first();
        $backgroundImage = $headerImage && Storage::disk('public')->exists($headerImage->header_image)
            ? asset('storage/' . $headerImage->header_image)
            : $defaultImage;
        return view('front.gallery', compact('images', 'backgroundImage'));
    }
}
