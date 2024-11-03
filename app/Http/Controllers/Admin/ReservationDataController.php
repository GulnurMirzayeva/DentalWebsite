<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Mail\ReservationCreated; // Correctly import the ReservationCreated class
use Illuminate\Support\Facades\Mail; // Correctly import Mail

class ReservationDataController extends Controller
{
    public function checkTimeAvailability(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $exists = Reservation::where('date', $request->date)
            ->where('time', $request->time)
            ->where('status', '!=', 'rejected')
            ->exists();

        return response()->json([
            'taken' => $exists
        ]);
    }

    public function storeReservation(Request $request)
    {
        $request->validate([
            'department' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:10|max:15',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        // Check if time slot is already taken
        $timeExists = Reservation::where('date', $request->date)
            ->where('time', $request->time)
            ->where('status', '=', 'accepted')
            ->exists();

        if ($timeExists) {
            return response()->json([
                'success' => false,
                'message' => 'Seçilmiş vaxt rezervasiya olunub. Zəhmət olmasa, başqa vaxt seçin.',
            ], 422);
        }

        $reservation = Reservation::create([
            'service_id' => $request->department,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        Mail::to('stomotology.dentist@gmail.com')->send(new ReservationCreated($reservation));

        return response()->json([
            'success' => true,
            'message' => 'Rezervasiya uğurla yaradıldı.',
        ]);
    }

    public function index()
    {
        $reservations = Reservation::with('service')->get();
        return view('admin.pages.reservation', compact('reservations'));
    }

    public function accept($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'accepted';
        $reservation->save();

        return redirect()->back()->with('success', 'Rezervasiya qəbul edildi.');
    }

    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'rejected';
        $reservation->save();

        return redirect()->back()->with('success', 'Rezervasiya qəbul edilmədi.');
    }
}
