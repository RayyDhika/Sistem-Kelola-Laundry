<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        // ambil outlet user login
        $idOutlet = auth()->user()->id_outlet;

        // query dasar
        $query = Transaksi::with(['pelanggan', 'details.paket']);

        // kalau bukan outlet pusat
        if (auth()->user()->role != 'admin') {
            $query->where('id_outlet', $idOutlet);
        }

        $transaksi = collect();

        if ($tanggal_awal && $tanggal_akhir) {

            $transaksi = $query
                ->whereBetween('tgl_masuk', [$tanggal_awal, $tanggal_akhir])
                ->get();
        }

        return view('laporan.index', compact(
            'transaksi',
            'tanggal_awal',
            'tanggal_akhir'
        ));
    }


    public function cetak()
    {
        $idOutlet = auth()->user()->id_outlet;

        $query = Transaksi::with('pelanggan');

        if (auth()->user()->role != 'admin') {
            $query->where('id_outlet', $idOutlet);
        }

        $laporans = $query->latest()->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('laporans'));

        return $pdf->download('laporan-laundry.pdf');
    }


    public function kasirIndex(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $idOutlet = auth()->user()->id_outlet;

        $query = Transaksi::with(['pelanggan', 'details.paket']);

        if (auth()->user()->role != 'admin') {
            $query->where('id_outlet', $idOutlet);
        }

        $transaksi = [];

        if ($tanggal_awal && $tanggal_akhir) {

            $transaksi = $query
                ->whereBetween('tgl_masuk', [$tanggal_awal, $tanggal_akhir])
                ->get();
        }

        return view('laporan.index', compact(
            'transaksi',
            'tanggal_awal',
            'tanggal_akhir'
        ));
    }


    public function ownerIndex(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $idOutlet = auth()->user()->id_outlet;

        $query = Transaksi::with(['pelanggan', 'details.paket']);

        if (auth()->user()->role != 'admin') {
            $query->where('id_outlet', $idOutlet);
        }

        $transaksi = [];

        if ($tanggal_awal && $tanggal_akhir) {

            $transaksi = $query
                ->whereBetween('tgl_masuk', [$tanggal_awal, $tanggal_akhir])
                ->get();
        }

        return view('laporan.index', compact(
            'transaksi',
            'tanggal_awal',
            'tanggal_akhir'
        ));
    }
}