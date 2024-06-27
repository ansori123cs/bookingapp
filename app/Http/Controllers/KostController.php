<?php

namespace App\Http\Controllers;

use App\Models\kost;
use App\Models\booking;
use Illuminate\Http\Request;

class KostController extends Controller
{
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
    public function addDataKost(Request $request)
    {
        $request->validate([
            'nama_kost' => 'required|string|max:255',
            'fasilitas' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        kost::create($request->all());

        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }
    public function editDataKost(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_kost' => 'required|string|max:255',
                'fasilitas' => 'required|string|max:255',
                'jenis' => 'required|string|max:255',
                'harga' => 'required|numeric',
                'rating' => 'required|integer|min:1|max:5',
            ]);
            $kost  = kost::find($id);
            if ($kost == null) {
                return redirect()->back()->with('error', 'Data tidak ada');
            }
            $kost->update($request->all());
            // Additional logic or redirection after successful data update
            return redirect()->back()->with('success', 'Data berhasil diupdate!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data tidak ada');
        }
    }
    public function deleteDataKost(Request $request, $id)
    {
        try {
            $kost  = kost::find($id);
            if ($kost == null) {
                return redirect()->back()->with('error', 'Data tidak ada');
            }
            $kost->delete();
            // Additional logic or redirection after successful data update
            return redirect()->back()->with('success', 'Data berhasil Dihapus!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data tidak ada');
        }
    }
}
