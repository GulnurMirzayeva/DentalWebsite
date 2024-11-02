<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ComplaintSuggestion;

class ComplaintSuggestionController extends Controller
{
    public function storeContactForm(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|regex:/^[0-9]+$/|min:7|max:15',
            'email' => 'nullable|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ComplaintSuggestion::create($request->all());

        return redirect()->back()->with('success', 'Mesaj göndərildi!');
    }

    public function markAsViewed($id)
    {
        $message = ComplaintSuggestion::find($id);
        if ($message && !$message->viewed) {
            $message->viewed = true;
            $message->save();
        }

        return response()->json(['success' => true]);
    }


    public function showMessages()
    {
        $messages = ComplaintSuggestion::all();
        return view('admin.pages.contact.contact', compact('messages'));
    }

    public function destroy($id)
    {
        $message = ComplaintSuggestion::findOrFail($id);

        $message->delete();

        return redirect()->back()->with('success', 'Mesaj silindi!');
    }
}
