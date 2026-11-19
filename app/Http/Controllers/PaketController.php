<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $idOutlet = auth()->user()->id_outlet;

        // ADMIN PUSAT
        if (auth()->user()->role == 'admin') {

            $pakets = Paket::with('outlet')->get();

            $outlets = Outlet::all();

            $users = User::all();

        }
        // ADMIN CABANG
        else {

            $pakets = Paket::with('outlet')
                ->where('id_outlet', $idOutlet)
                ->get();

            $outlets = Outlet::where('id', $idOutlet)->get();

            $users = User::where('id_outlet', $idOutlet)->get();
        }

        return view('paket.index', compact('pakets', 'outlets', 'users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required',
            'nm_paket' => 'required',
            'harga' => 'required',
        ]);

        Paket::create([

            'id_outlet' => $request->id_outlet,

            'jenis' => $request->jenis,

            'nm_paket' => $request->nm_paket,

            'harga' => $request->harga,

        ]);

        return redirect()->back()->with('success', 'Paket berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);
        $paket->update([
            'id_outlet' => $request->id_outlet,
            'jenis' => $request->jenis,
            'nm_paket' => $request->nm_paket,
            'harga' => $request->harga,
        ]);

        return redirect()->back()->with('success', 'Paket berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Paket::destroy($id);
        return redirect()->back()->with('success', 'Paket berhasil dihapus!');
    }
}