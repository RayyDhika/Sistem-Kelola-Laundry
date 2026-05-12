<!DOCTYPE html>
<html>
<head>
    <title>Cetak Nota #{{ $transaksi->id }}</title>
    <style>
        @page { size: 80mm 200mm; margin: 0; }
        body { font-family: 'Courier New', Courier, monospace; width: 70mm; padding: 5mm; margin: auto; }
        .text-center { text-align: center; }
        .line { border-bottom: 1px dashed black; margin: 10px 0; }
        .box { border: 1.5px solid black; padding: 5px; margin: 10px 0; font-weight: bold; font-size: 1.2em; }
        .item-list { width: 100%; font-size: 0.9em; }
        .btn-print-wrapper { text-align: center; margin-bottom: 20px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="btn-print-wrapper no-print">
        <button onclick="window.print()" style="background: #0038cf; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">CETAK NOTA</button>
        <button onclick="window.history.back()" style="background: #359df3; color: white; border: none; padding: 10px 200px border-radius: 5px; cursor: pointer;">KEMBALI</button>
    </div>

    <div class="text-center">
        <h2 style="margin: 0;">LAUNDRY</h2>
        <div class="box">ORDER #{{ $transaksi->id }}</div>
    </div>

    <div class="line"></div>

    <table class="item-list">
        <tr>
            <td colspan="2"><strong>CUSTOMER :</strong></td>
        </tr>
        <tr>
            <td colspan="2">{{ $transaksi->pelanggan->nm_pelanggan }}<br>{{ $transaksi->pelanggan->no_telp }}</td>
        </tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>
            <td colspan="2"><strong>ITEMS :</strong></td>
        </tr>
        @foreach($transaksi->details as $detail)
        <tr>
            <td>• {{ $detail->paket->nm_paket }}</td>
            <td align="right">{{ $detail->qty }} kg</td>
        </tr>
        @endforeach
        <tr>
            <td><strong>Total :</strong></td>
            <td align="right"><strong>{{ $transaksi->details->count() }} item</strong></td>
        </tr>
    </table>

    <div class="line"></div>

    <div style="font-size: 0.9em;">
        TGL ORDER: {{ $transaksi->tgl->format('d/m/Y') }}<br>
        ESTIMASI SELESAI: {{ $transaksi->batas_waktu->format('d/m/Y') }}
    </div>

    <div class="text-center" style="margin-top: 15px;">
        STATUS: {{ strtoupper($transaksi->status) }}
        <div class="box" style="font-size: 1em;">PEMBAYARAN {{ $transaksi->dibayar == 'dibayar' ? 'LUNAS' : 'BELUM LUNAS' }}</div>
    </div>

    <p class="text-center" style="font-size: 0.8em; margin-top: 20px;">Terima kasih atas kepercayaan anda!</p>
</body>
</html>