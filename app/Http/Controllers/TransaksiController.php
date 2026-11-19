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

        if (!$idOutlet && auth()->user()->role != 'admin') {
            abort(403, 'Outlet tidak valid');
        }
        $search = $request->search;

        // TRANSAKSI
        $query = Transaksi::with([
            'pelanggan',
            'outlet',
            'details.paket'
        ]);

        if (auth()->user()->role != 'admin') {
            $query->where('id_outlet', $idOutlet);
        }

        $transaksis = $query
            ->oldest()
            ->get();

        if (auth()->user()->role == 'admin') {

            $pelanggans = Pelanggan::all();
            $pakets = Paket::all();
            $outlets = Outlet::all();

        } else {

            $pelanggans = Pelanggan::where(
                'id_outlet',
                $idOutlet
            )->get();

            $pakets = Paket::where(
                'id_outlet',
                $idOutlet
            )->get();

            $outlets = Outlet::where(
                'id',
                $idOutlet
            )->get();

        }

        // COUNT
        $countTransaksi = auth()->user()->role == 'admin'
            ? Transaksi::count()
            : Transaksi::where('id_outlet', $idOutlet)->count();

        $countProses = auth()->user()->role == 'admin'
            ? Transaksi::where('status', 'proses')->count()
            : Transaksi::where('id_outlet', $idOutlet)
                ->where('status', 'proses')
                ->count();

        $countSelesai = auth()->user()->role == 'admin'
            ? Transaksi::where('status', 'selesai')->count()
            : Transaksi::where('id_outlet', $idOutlet)
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
        $rules = [
            'id_pelanggan' => 'required',
            'status' => 'required',
            'status_bayar' => 'required',
            'batas_waktu' => 'required|date',
            'id_paket' => 'required|array',
            'qty' => 'required|array'
        ];

        $request->validate($rules);
        // SIMPAN TRANSAKSI
        $pelanggan = Pelanggan::findOrFail($request->id_pelanggan);
        $transaksi = Transaksi::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_outlet' => $pelanggan->id_outlet,
            'id_user' => auth()->id(),
            'kode_invoice' => $request->kode_invoice,
            'status' => $request->status,
            'status_bayar' => $request->status_bayar,
            'tgl_masuk' => now(),
            'batas_waktu' => $request->batas_waktu,
            'tgl_bayar' => $request->status_bayar == 'dibayar'
                ? now()
                : null,
            'total_harga' => $request->total_harga,
        ]);

        // SIMPAN DETAIL TRANSAKSI
        foreach ($request->id_paket as $index => $idPaket) {

            $paket = Paket::find($idPaket);

            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_paket' => $idPaket,
                'qty' => $request->qty[$index],
                'subtotal' => $paket->harga * $request->qty[$index],
            ]);
        }

        if (auth()->user()->role == 'kasir') {
            return redirect()->route('kasir.transaksi')->with('success', 'Transaksi berhasil dtambahkan!');
        }

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    // =========================
    // DETAIL
    // =========================
    public function show($id)
    {
        $query = Transaksi::with(['pelanggan', 'outlet']);

        if (auth()->user()->role != 'admin') {
            $query->where('id_outlet', auth()->user()->id_outlet);
        }

        $transaksi = $query->findOrFail($id);

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

        $query = Transaksi::query();

        if (auth()->user()->role != 'admin') {
            $query->where('id_outlet', auth()->user()->id_outlet);
        }

        $transaksi = $query->findOrFail($id);

        $transaksi->update([
            'status' => $request->status,

            'status_bayar' => $request->status_bayar,

            'tgl_bayar' => $request->status_bayar == 'dibayar'
                ? now()
                : null,
        ]);

        if (auth()->user()->role == 'kasir') {
            return redirect()->route('kasir.transaksi')->with('success', 'Transaksi berhasil diupdate!');
        }

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diupdate!');
    }

    // CETAK NOTA 
    public function nota($id)
    {
        $query = Transaksi::with(['pelanggan', 'details.paket']);

        if (auth()->user()->role != 'admin') {
            $query->where('id_outlet', auth()->user()->id_outlet);
        }

        $transaksi = $query->findOrFail($id);

        return view('transaksi.nota', compact('transaksi'));
    }



    // =========================
    // HAPUS
    // =========================
    public function destroy($id)
    {
        $query = Transaksi::query();

        if (auth()->user()->role != 'admin') {
            $query->where('id_outlet', auth()->user()->id_outlet);
        }

        $transaksi = $query->findOrFail($id);

        $transaksi->delete();

        if (auth()->user()->role == 'kasir') {
            return redirect()->route('kasir.transaksi')->with('success', 'Transaksi berhasil dihapus!');
        }

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }


}