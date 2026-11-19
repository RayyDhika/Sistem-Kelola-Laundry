<!DOCTYPE html>
<html>

<head>
    <title>Laporan Laundry</title>

    <style>
        body {
            font-family: sans-serif;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            background: #dbeafe;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>

<body>

    @php
        $namaOutlet = 'SEMUA OUTLET';

        if ($laporans->count() > 0) {
            $outletUnik = $laporans->pluck('id_outlet')->unique();

            if ($outletUnik->count() == 1) {
                $namaOutlet = $laporans->first()->outlet->nm_outlet;
            }
        }
    @endphp

    <h2>
        LAPORAN TRANSAKSI LAUNDRY
        <br>
        {{ strtoupper($namaOutlet) }}
    </h2>

    <p style="text-align:center; margin-bottom:15px;">
        Periode:
        {{ \Carbon\Carbon::parse($tanggal_awal)->format('d/m/Y') }}
        s/d
        {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d/m/Y') }}
    </p>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Kode Invoice</th>
                <th>Pelanggan</th>
                <th>Paket Cucian</th>
                <th>Berat/Qty</th>
                <th>Tanggal Transaksi</th>
                <th>Total Harga</th>
            </tr>
        </thead>

        <tbody>

            @forelse($laporans as $no => $l)

                <tr>

                    <td>{{ $no + 1 }}</td>

                    <td>
                        {{ $l->kode_invoice }}
                    </td>

                    <td>
                        {{ $l->pelanggan->nm_pelanggan ?? '-' }}
                    </td>

                    <td>
                        @foreach($l->details as $detail)
                            {{ $detail->paket->nm_paket ?? '-' }}@if(!$loop->last),@endif<br>
                        @endforeach
                    </td>

                    <td>
                        {{ $l->details->sum('qty') }} KG
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($l->tgl_masuk)->format('d/m/Y') }}
                    </td>

                    <td>
                        Rp {{ number_format($l->total_harga, 0, ',', '.') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7">
                        Tidak ada data transaksi
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</body>

</html>