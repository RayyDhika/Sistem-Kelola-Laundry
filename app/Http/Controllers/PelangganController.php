<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Outlet;

class PelangganController extends Controller
{
    // ==========================================
    // BAGIAN 1: MENAMPILKAN DATA (READ)
    // ==========================================

    public function index()
    {
        if (
            auth()->user()->role == 'admin' ||
            auth()->user()->role == 'owner'
        ) {

            $pelanggans = Pelanggan::with('outlet')->get();

        } else {

            $pelanggans = Pelanggan::where(
                'id_outlet',
                auth()->user()->id_outlet
            )->get();

        }

        $outlets = Outlet::all();

        return view(
            'pelanggan.create',
            compact('pelanggans', 'outlets')
        );
    }

    public function create()
    {
        if (
            auth()->user()->role == 'admin' ||
            auth()->user()->role == 'owner'
        ) {

            $pelanggans = Pelanggan::with('outlet')->get();

        } else {

            $pelanggans = Pelanggan::where(
                'id_outlet',
                auth()->user()->id_outlet
            )->get();

        }

        $outlets = Outlet::all();

        return view(
            'pelanggan.create',
            compact('pelanggans', 'outlets')
        );
    }

    // ==========================================
    // BAGIAN 2: SIMPAN DATA BARU (CREATE)
    // ==========================================

    public function store(Request $request)
    {
        // Validasi input: pastikan semua kolom diisi
        $request->validate([
            'nm_pelanggan' => 'required',
            'no_telp' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',

            'id_outlet' => auth()->user()->role == 'admin'
                ? 'required'
                : 'nullable'
        ]);

        // Proses Insert ke Database
        // Pastikan nm_pelanggan dan no_telp sudah ada di $fillable di Model Pelanggan

        Pelanggan::create([
            'id_outlet' => (
                auth()->user()->role == 'admin' ||
                auth()->user()->role == 'owner'
            )
                ? $request->id_outlet
                : auth()->user()->id_outlet,
            'nm_pelanggan' => $request->nm_pelanggan,
            'no_telp' => $request->no_telp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ]);

        if (auth()->user()->role == 'kasir') {
            return redirect()->route('kasir.pelanggan')->with('success', 'Data Pelanggan Berhasil di Tambahkan!');
        }

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data Pelanggan Berhasil di Tambahkan!');

    }

    // ==========================================
    // BAGIAN 3: HALAMAN EDIT (UPDATE - VIEW)
    // ==========================================

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $outlets = Outlet::all();

        return view(
            'pelanggan.edit',
            compact('pelanggan', 'outlets')
        );
    }

    // ==========================================
    // BAGIAN 4: PROSES UPDATE (UPDATE - LOGIC)
    // ==========================================

    public function update(Request $request, $id)
    {
        $request->validate([
            'nm_pelanggan' => 'required',
            'no_telp' => 'required|unique:pelanggan,no_telp',
            'jenis_kelamin' => 'required',
            'alamat' => 'required'

            ], [
                'telepon.unique' => 'Nomor telepon sudah digunakan.',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->update([
            'nm_pelanggan' => $request->nm_pelanggan,
            'no_telp' => $request->no_telp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'id_outlet' => auth()->user()->role == 'admin' || auth()->user()->role == 'owner'
                ? $request->id_outlet
                : auth()->user()->id_outlet
        ]);

        if (auth()->user()->role == 'kasir') {
            return redirect()->route('kasir.pelanggan')->with('success', 'Data Pelanggan Berhasil di Perbarui!');
        }

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data Pelanggan Berhasil di Perbarui!');
    }

    // ==========================================
    // BAGIAN 5: HAPUS DATA (DELETE)
    // ==========================================

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        if (auth()->user()->role == 'kasir') {
            return redirect()->route('kasir.pelanggan')->with('success', 'Data Berhasil di Hapus');
        }

        // Mengirim flash session 'deleted' untuk memicu SweetAlert peringatan
        return redirect()->route('pelanggan.create')->with('success', 'Data Berhasil di Hapus');
    }
}