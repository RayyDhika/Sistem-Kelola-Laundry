<?php

namespace App\Http\Controllers;

use App\Models\Outlet; 
use App\Models\User;
use App\Models\Paket;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Menampilkan daftar outlet
     */
    public function index()
    {
        // Mengambil semua data dari tabel outlet
        $outlets = Outlet::all();

        $users = User::all();

        $pakets = Paket::all();
        
        // Menghitung jumlah outlet untuk tampilan Stat Card
        $countOutlet = $outlets->count();

        // Mengirim data ke view index di folder outlet
        return view('outlet.index', compact('outlets', 'users', 'pakets', 'countOutlet'));
    }

    /**
     * Menyimpan data outlet baru
     */
    public function store(Request $request)
    {
        // Validasi input sesuai dengan migration project BubbleBliss
        $request->validate([
            'nm_outlet' => 'required|max:40',
            'alamat'    => 'required',
            'no_telp'   => 'required|max:20',
            'owner'     => 'required|max:40',
        ]);

        // Simpan ke database
        Outlet::create([
            'nm_outlet' => $request->nm_outlet,
            'alamat'    => $request->alamat,
            'no_telp'   => $request->no_telp,
            'owner'     => $request->owner,
        ]);

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('outlet.index')->with('success', 'Data Outlet berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman edit (Ini yang tadi kurang)
     */
    public function edit($id)
    {
        // Mengambil data outlet berdasarkan ID, jika tidak ada akan error 404
        $outlet = Outlet::findOrFail($id);
        
        // Mengarahkan ke file resources/views/outlet/edit.blade.php
        return view('outlet.edit', compact('outlet'));
    }

    /**
     * Memperbarui data outlet
     */
    public function update(Request $request, $id)
    {
        // Validasi tetap diperlukan saat update
        $request->validate([
            'nm_outlet' => 'required|max:40',
            'alamat'    => 'required',
            'no_telp'   => 'required|max:20',
            'owner'     => 'required|max:40',
        ]);

        $outlet = Outlet::findOrFail($id);
        
        // Mengupdate data menggunakan data dari request form
        $outlet->update([
            'nm_outlet' => $request->nm_outlet,
            'alamat'    => $request->alamat,
            'no_telp'   => $request->no_telp,
            'owner'     => $request->owner,
        ]);

        return redirect()->route('outlet.index')->with('success', 'Data Outlet berhasil diperbarui!');
    }

    /**
     * Menghapus data outlet
     */
    public function destroy($id)
    {
        $outlet = Outlet::findOrFail($id);
        $outlet->delete();

        return redirect()->route('outlet.index')->with('success', 'Data Outlet berhasil dihapus!');
    }
}