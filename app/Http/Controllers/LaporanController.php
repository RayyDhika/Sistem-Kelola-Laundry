<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Tangkap input filter rentang tanggal dari form
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        // Query dasar mengambil data transaksi beserta relasi pelanggan dan paket
        $query = Transaksi::with(['pelanggan', 'details.paket']);

        // default kosong
        $transaksi = collect();

        // Data transaksi hanya akan difilter jika user sudah memilih tanggal
        if ($tanggal_awal && $tanggal_akhir) {

            $transaksi = $query
                ->whereBetween('tgl_masuk', [$tanggal_awal, $tanggal_akhir])
                ->get();
        }

        // Kirim data ke view laporan
        return view('laporan.index', compact('transaksi', 'tanggal_awal', 'tanggal_akhir'));
    }


    public function cetak()
    {
        $idOutlet = auth()->user()->id_outlet;

        $laporans = Transaksi::with('pelanggan')
            ->where('id_outlet', $idOutlet)
            ->latest()
            ->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('laporans'));

        return $pdf->download('laporan-laundry.pdf');
    }
}