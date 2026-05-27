<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Pelanggan;
use App\Models\Outlet;
use App\Models\Paket;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // =========================
    // INDEX
    // =========================
    public function index(Request $request)
{
    $idOutlet = auth()->user()->id_outlet;
    $search = $request->search;

    // TRANSAKSI
    $transaksis = Transaksi::with(['pelanggan', 'outlet'])
        ->where('id_outlet', $idOutlet)

        ->when($search, function ($query, $search) {
            $query->where('kode_invoice', 'like', "%{$search}%")
                  ->orWhereHas('pelanggan', function ($q) use ($search) {
                      $q->where('nm_pelanggan', 'like', "%{$search}%");
                  });
        })

        ->latest()
        ->get();

    // PELANGGAN
    $pelanggans = Pelanggan::where(
        'id_outlet',
        $idOutlet
    )->get();

    // PAKET
    $pakets = Paket::where(
        'id_outlet',
        $idOutlet
    )->get();

    // OUTLET USER SAJA
    $outlets = Outlet::where(
        'id',
        $idOutlet
    )->get();

    // COUNT
    $countTransaksi = Transaksi::where(
        'id_outlet',
        $idOutlet
    )->count();

    $countProses = Transaksi::where(
        'id_outlet',
        $idOutlet
    )
    ->where('status', 'proses')
    ->count();

    $countSelesai = Transaksi::where(
        'id_outlet',
        $idOutlet
    )
    ->where('status', 'selesai')
    ->count();

    return view('transaksi.index', compact(
        'transaksis',
        'pelanggans',
        'outlets',
        'pakets',
        'countTransaksi',
        'countProses',
        'countSelesai'
    ));
}

    // =========================
    // SIMPAN TRANSAKSI
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required',
            'kode_invoice' => 'required',
            'status' => 'required',
            'status_bayar' => 'required',
        ]);

        $transaksi = Transaksi::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_outlet' => auth()->user()->id_outlet,
            'id_user' => auth()->id(),
            'kode_invoice' => $request->kode_invoice,
            'status' => $request->status,
            'status_bayar' => $request->status_bayar,
            'tgl_masuk' => now(),
            'batas_waktu' => now()->addDays(3),
            'tgl_bayar' => $request->status_bayar == 'dibayar' ? now() : null,
            'total_harga' => $request->total_harga,
        ]);

        DetailTransaksi::create([
            'id_transaksi' => $transaksi->id,
            'id_paket' => Paket::first()->id,
            'qty' => 5,
            'subtotal' => $request->total_harga,
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    // =========================
    // DETAIL
    // =========================
    public function show($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'outlet'])
            ->findOrFail($id);

        return response()->json($transaksi);
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('transaksi.edit', compact('transaksi'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'status_bayar' => 'required',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status' => $request->status,

            'status_bayar' => $request->status_bayar,

            'tgl_bayar' => $request->status_bayar == 'dibayar'
                ? now()
                : null,
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diupdate!');
    }

    // CETAK NOTA 
    public function nota($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'details.paket'])
            ->findOrFail($id);

        return view('transaksi.nota', compact('transaksi'));
    }



    // =========================
    // HAPUS
    // =========================
public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }


}