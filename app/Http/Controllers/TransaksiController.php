<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Paket; // Asumsi ada model Paket
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::all();
        $pakets = Paket::all();
        $transaksis = Transaksi::with('pelanggan')->latest()->get();
        return view('transaksi.index', compact('pelanggans', 'pakets', 'transaksis'));
    }

    public function store(Request $request)
    {
        // Validasi dan Simpan Transaksi Utama
        $transaksi = Transaksi::create([
            'id_pelanggan' => $request->id_pelanggan,
            'tgl' => now(),
            'batas_waktu' => $request->estimasi_selesai,
            'status' => 'baru',
            'dibayar' => $request->metode_pembayaran == 'langsung' ? 'dibayar' : 'belum_dibayar',
            'id_user' => auth()->id() ?? 1
        ]);

        // Simpan Detail Pesanan dari Keranjang
        foreach ($request->items as $item) {
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_paket' => $item['id_paket'],
                'qty' => $item['qty'],
            ]);
        }

        return redirect()->back()->with('success', 'Pesanan berhasil ditambahkan!');
    }

    public function nota($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'details.paket'])->findOrFail($id);
        return view('transaksi.nota', compact('transaksi'));
    }
    
    public function destroy($id)
    {
        Transaksi::find($id)->delete();
        return redirect()->back()->with('success', 'Data transaksi berhasil dihapus!');
    }
}