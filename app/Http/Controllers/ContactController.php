<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactDetail;
use App\Models\HeaderImage;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index()
    {
        $defaultImage = asset('assets/front/img/bg_1.jpg');
        $headerImage = HeaderImage::latest()->first();
        $backgroundImage = $headerImage && Storage::disk('public')->exists($headerImage->header_image)
            ? asset('storage/' . $headerImage->header_image)
            : $defaultImage;
        return view('front.contact', compact('backgroundImage'));
    }

    public function contact()
    {
        $contactDetails = ContactDetail::first();
        return view('front.contact.contact-form', compact('contactDetails'));
    }
}
