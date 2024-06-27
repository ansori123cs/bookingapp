<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\kost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $kost = kost::all();
        $booking = booking::all();
        return view('home.index', [
            "title" => "KostIn-Aja",
            "kost" => $kost,
            "booking" => $booking,
        ]);
    }
}
