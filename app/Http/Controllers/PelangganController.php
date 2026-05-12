<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    // ==========================================
    // BAGIAN 1: MENAMPILKAN DATA (READ)
    // ==========================================
    
    public function index()
    {
        // Mengambil semua data dari tabel pelanggan
        $pelanggans = Pelanggan::all();
        // Mengirim data ke view create.blade.php agar tabel terisi
        return view('pelanggan.create', compact('pelanggans'));
    }

    public function create()
    {
        // Sama seperti index, agar saat akses /create tabel tetap muncul
        $pelanggans = Pelanggan::all(); 
        return view('pelanggan.create', compact('pelanggans'));
    }

    // ==========================================
    // BAGIAN 2: SIMPAN DATA BARU (CREATE)
    // ==========================================
    
    public function store(Request $request)
    {
        // Validasi input: pastikan semua kolom diisi
        $request->validate([
            'nm_pelanggan'  => 'required',
            'no_telp'       => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required'
        ]);

        // Proses Insert ke Database
        // Pastikan nm_pelanggan dan no_telp sudah ada di $fillable di Model Pelanggan
        Pelanggan::create([
            'nm_pelanggan'  => $request->nm_pelanggan,
            'no_telp'       => $request->no_telp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
        ]);

        // Kembali ke halaman sebelumnya dengan pesan sukses (SweetAlert)
        return redirect()->route('pelanggan.create')->with('success', 'DATA PELANGGAN BERHASIL DITAMBAHKAN');
    }

    // ==========================================
    // BAGIAN 3: HALAMAN EDIT (UPDATE - VIEW)
    // ==========================================
    
    public function edit($id)
    {
        // Mencari data pelanggan berdasarkan ID, jika tidak ada tampilkan error 404
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    // ==========================================
    // BAGIAN 4: PROSES UPDATE (UPDATE - LOGIC)
    // ==========================================
    
    public function update(Request $request, $id)
    {
        // Validasi input untuk update
        $request->validate([
            'nm_pelanggan'  => 'required',
            'no_telp'       => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required'
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        
        // Proses memperbarui data
        $pelanggan->update([
            'nm_pelanggan'  => $request->nm_pelanggan,
            'no_telp'       => $request->no_telp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
        ]);

        return redirect()->route('pelanggan.create')->with('success', 'DATA PELANGGAN BERHASIL DIPERBARUI');
    }

    // ==========================================
    // BAGIAN 5: HAPUS DATA (DELETE)
    // ==========================================
    
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        // Mengirim flash session 'deleted' untuk memicu SweetAlert peringatan
        return redirect()->route('pelanggan.create')->with('deleted', 'DATA BERHASIL DIHAPUS');
    }
}