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

        $pakets = Paket::with('outlet')
            ->where('id_outlet', $idOutlet)
            ->get();

        $outlets = Outlet::where('id', $idOutlet)->get();

        $users = User::where('id_outlet', $idOutlet)->get();

        // 4. Kirim variabel $outlets ke view paket
        return view('paket.index', compact('pakets', 'outlets', 'users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'jenis' =>'required',
            'nm_paket' => 'required',
            'harga' => 'required',
        ]);

         Paket::create([

        'id_outlet' => auth()->user()->id_outlet,

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