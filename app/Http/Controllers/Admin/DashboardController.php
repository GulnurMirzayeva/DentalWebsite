<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class DashboardController extends Controller
{

    public function index()
    {
        $reservations = Reservation::with('service')->get();
        return view('admin.pages.dashboard', compact('reservations'));

    }
}
