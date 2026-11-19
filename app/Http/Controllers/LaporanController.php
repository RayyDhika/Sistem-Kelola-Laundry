<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Outlet;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // ==========================
    // ADMIN
    // ==========================
    public function index(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;
        $id_outlet = $request->id_outlet;

        $outlets = Outlet::all();

        $query = Transaksi::with([
            'pelanggan',
            'details.paket'
        ]);

        // ADMIN boleh filter outlet
        if ($id_outlet) {

            $query->where(
                'id_outlet',
                $id_outlet
            );
        }

        $transaksi = collect();

        if ($tanggal_awal && $tanggal_akhir) {

            $transaksi = $query
                ->whereBetween(
                    'tgl_masuk',
                    [$tanggal_awal, $tanggal_akhir]
                )
                ->get();
        }

        return view('laporan.index', compact(
            'transaksi',
            'tanggal_awal',
            'tanggal_akhir',
            'id_outlet',
            'outlets'
        ));
    }

    // ==========================
    // CETAK PDF ADMIN
    // ==========================
    public function cetak(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;
        $id_outlet = $request->id_outlet;

        $query = Transaksi::with([
            'pelanggan',
            'outlet',
            'details.paket'
        ]);

        if ($id_outlet) {

            $query->where(
                'id_outlet',
                $id_outlet
            );
        }

        if ($tanggal_awal && $tanggal_akhir) {

            $query->whereBetween(
                'tgl_masuk',
                [$tanggal_awal, $tanggal_akhir]
            );
        }

        $laporans = $query->latest()->get();

        $pdf = Pdf::loadView(
            'laporan.pdf',
            compact(
                'laporans',
                'tanggal_awal',
                'tanggal_akhir'
            )
        );

        return $pdf->download('laporan-laundry.pdf');
    }

    // ==========================
    // KASIR
    // ==========================
    public function kasirIndex(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $transaksi = collect(); // default kosong

        if ($tanggal_awal && $tanggal_akhir) {

            $transaksi = Transaksi::with([
                'outlet',
                'pelanggan',
                'details.paket'
            ])
                ->where('id_outlet', auth()->user()->id_outlet)
                ->whereBetween('tgl_masuk', [$tanggal_awal, $tanggal_akhir])
                ->latest()
                ->get();
        }

        return view('laporan.index', compact(
            'transaksi',
            'tanggal_awal',
            'tanggal_akhir'
        ));
    }
    // ==========================
    // OWNER
    // ==========================
    public function ownerIndex(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $transaksi = collect(); // default kosong

        if ($tanggal_awal && $tanggal_akhir) {

            $transaksi = Transaksi::with([
                'outlet',
                'pelanggan',
                'details.paket'
            ])
                ->where('id_outlet', auth()->user()->id_outlet)
                ->whereBetween('tgl_masuk', [$tanggal_awal, $tanggal_akhir])
                ->latest()
                ->get();
        }

        return view('laporan.index', compact(
            'transaksi',
            'tanggal_awal',
            'tanggal_akhir'
        ));
    }

    // ==========================
    // CETAK PDF OWNER
    // ==========================
    public function ownerCetak(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $query = Transaksi::with([
            'pelanggan',
            'outlet',
            'details.paket'
        ])
            ->where(
                'id_outlet',
                auth()->user()->id_outlet
            );

        if ($tanggal_awal && $tanggal_akhir) {

            $query->whereBetween(
                'tgl_masuk',
                [$tanggal_awal, $tanggal_akhir]
            );
        }

        $laporans = $query->latest()->get();

        $pdf = Pdf::loadView(
            'laporan.pdf',
            compact(
                'laporans',
                'tanggal_awal',
                'tanggal_akhir'
            )
        );

        return $pdf->download('laporan-owner.pdf');
    }

    // ==========================
    // CETAK PDF KASIR
    // ==========================
    public function kasirCetak(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $query = Transaksi::with([
            'pelanggan',
            'outlet',
            'details.paket'
        ])
            ->where('id_outlet', auth()->user()->id_outlet);

        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('tgl_masuk', [$tanggal_awal, $tanggal_akhir]);
        }

        $laporans = $query->latest()->get();

        $pdf = Pdf::loadView(
            'laporan.pdf',
            compact('laporans', 'tanggal_awal', 'tanggal_akhir')
        );

        return $pdf->download('laporan-kasir.pdf');
    }
}
