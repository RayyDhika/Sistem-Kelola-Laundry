<!DOCTYPE html>
<html>
<head>
    <title>Laporan Laundry</title>

    <style>
        body{
            font-family: sans-serif;
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table, th, td{
            border:1px solid black;
        }

        th{
            background:#dbeafe;
        }

        th, td{
            padding:10px;
            text-align:center;
            font-size:12px;
        }
    </style>
</head>
<body>

    <h2>LAPORAN TRANSAKSI LAUNDRY</h2>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Invoice</th>
                <th>Status</th>
                <th>Pembayaran</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>

            @foreach($laporans as $no => $l)

            <tr>

                <td>{{ $no + 1 }}</td>

                <td>
                    {{ $l->pelanggan->nm_pelanggan ?? '-' }}
                </td>

                <td>
                    {{ $l->kode_invoice }}
                </td>

                <td>
                    {{ ucfirst($l->status) }}
                </td>

                <td>
                    {{ ucfirst($l->status_bayar) }}
                </td>

                <td>
                    Rp {{ number_format($l->total_harga,0,',','.') }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</body>
</html>