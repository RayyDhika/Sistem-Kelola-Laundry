<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {

            $countTransaksi = Transaksi::count();

            $countProses = Transaksi::where(
                'status',
                'proses'
            )->count();

            $countSelesai = Transaksi::where(
                'status',
                'selesai'
            )->count();

        } else {

            $idOutlet = auth()->user()->id_outlet;

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
        }

        if (auth()->user()->role == 'admin') {

            $pendapatanBulanIni = Transaksi::whereMonth('tgl_masuk', now()->month)
                ->whereYear('tgl_masuk', now()->year)
                ->sum('total_harga');

            $totalPesanan = Transaksi::whereMonth('tgl_masuk', now()->month)
                ->whereYear('tgl_masuk', now()->year)
                ->count();

            $transaksiTerakhir = Transaksi::with('pelanggan')
                ->whereMonth('tgl_masuk', now()->month)
                ->whereYear('tgl_masuk', now()->year)
                ->latest()
                ->take(5)
                ->get();

        } else {

            $idOutlet = auth()->user()->id_outlet;

            $pendapatanBulanIni = Transaksi::where('id_outlet', $idOutlet)
                ->whereMonth('tgl_masuk', now()->month)
                ->whereYear('tgl_masuk', now()->year)
                ->sum('total_harga');

            $totalPesanan = Transaksi::where('id_outlet', $idOutlet)
                ->whereMonth('tgl_masuk', now()->month)
                ->whereYear('tgl_masuk', now()->year)
                ->count();

            $transaksiTerakhir = Transaksi::with('pelanggan')
                ->where('id_outlet', $idOutlet)
                ->whereMonth('tgl_masuk', now()->month)
                ->whereYear('tgl_masuk', now()->year)
                ->latest()
                ->take(5)
                ->get();
        }
            if (auth()->user()->role == 'admin') {

                return view('admin.dashboard', [
                    'countTransaksi' => $countTransaksi,
                    'countProses' => $countProses,
                    'countSelesai' => $countSelesai,
                    'pendapatanBulanIni' => $pendapatanBulanIni,
                    'totalPesanan' => $totalPesanan,
                    'transaksiTerakhir' => $transaksiTerakhir,
                ]);

            }

            return view('kasir.dashboard', [
                'countTransaksi' => $countTransaksi,
                'countProses' => $countProses,
                'countSelesai' => $countSelesai,
                'pendapatanBulanIni' => $pendapatanBulanIni,
                'totalPesanan' => $totalPesanan,
                'transaksiTerakhir' => $transaksiTerakhir,
            ]); 
    }
}