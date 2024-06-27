<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Http\Requests\StorebookingRequest;
use App\Http\Requests\UpdatebookingRequest;
use App\Models\kost;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kost = kost::all();
        $booking = booking::all();
        return view('Monitoring.index', [
            "title" => "KostIn-Aja",
            "kost" => $kost,
            "booking" => $booking,
        ]);
    }
    public function addDataBooking(Request $request)
    {
        try {
            $request->validate([
                'id_kost' => 'required|exists:kosts,id',
                'nama_pemesan' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15',
                'pesan_khusus' => 'nullable|string|max:255',
                'total_harga' => 'required|numeric',
            ]);

            Booking::create($request->all());
            return redirect()->back()->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Data Gagal Disimpan');
        }
    }
    public function editDataBooking(Request $request, $id)
    {
        try {
            $request->validate([
                'id_kost' => 'required|exists:kosts,id',
                'nama_pemesan' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15',
                'pesan_khusus' => 'nullable|string|max:255',
                'total_harga' => 'required|numeric',
            ]);
            $booking  = booking::find($id);
            if ($booking == null) {
                return redirect()->back()->with('error', 'Data tidak ada');
            }
            $booking->update($request->all());
            // Additional logic or redirection after successful data update
            return redirect()->back()->with('success', 'Data berhasil diupdate!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data tidak ada');
        }
    }
    public function deleteDataBooking(Request $request, $id)
    {
        try {
            $booking  = booking::find($id);
            if ($booking == null) {
                return redirect()->back()->with('error', 'Data tidak ada');
            }
            $booking->delete();
            // Additional logic or redirection after successful data update
            return redirect()->back()->with('success', 'Data berhasil Dihapus!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data tidak ada');
        }
    }
}
