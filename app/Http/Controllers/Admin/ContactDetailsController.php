<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ContactDetail;
use App\Http\Controllers\Controller;

class ContactDetailsController extends Controller
{
    public function index()
    {
        $contactDetails = ContactDetail::first();
        return view('admin.pages.contact-details.index', compact('contactDetails'));
    }


    public function update(Request $request)
    {
        $contactDetail = ContactDetail::first() ?? new ContactDetail;
        $contactDetail->fill($request->all());
        $contactDetail->save();

        return redirect()->route('admin.contact-details.index')->with('success', 'Contact details updated successfully.');
    }
}
