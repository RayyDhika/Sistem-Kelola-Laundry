<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
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

        return view('admin.dashboard', compact(
            'countTransaksi',
            'countProses',
            'countSelesai'
        ));
    }
}