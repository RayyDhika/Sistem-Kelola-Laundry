<!-- MODAL DETAIL & EDIT -->
    @foreach($transaksis as $t)

        <div class="modal fade" id="modalDetail{{ $t->id }}" tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content p-4">

                    <h5 class="text-primary mb-3">
                        Detail Transaksi
                    </h5>

                    <div class="mb-2">
                        <b>Pelanggan:</b><br>

                        <span class="detail-value">
                            {{ $t->pelanggan->nm_pelanggan }}
                        </span>

                    </div>

                    <div class="mb-2">
                        <b>Invoice:</b><br>

                        <span class="detail-value">
                            {{ $t->kode_invoice }}
                        </span>
                    </div>

                    <div class="mb-2">
                        <b>Status:</b><br>

                        @if($t->status == 'proses')

                            <span class="badge bg-info text-white">
                                Proses
                            </span>

                        @else

                            <span class="badge bg-success text-white">
                                Selesai
                            </span>

                        @endif
                    </div>

                    <div class="mb-2">
                        <b>Status Pembayaran:</b><br>

                        @if($t->status_bayar == 'dibayar')

                            <span class="badge bg-success">
                                Lunas
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Belum Lunas
                            </span>

                        @endif
                    </div>

                    <div class="mb-2">
                        <b>Tanggal Masuk:</b><br>
                        <span class="detail-value">
                            {{ \Carbon\Carbon::parse($t->tgl_masuk)->format('d M Y') }}
                        </span>
                    </div>

                    <div class="mb-2">
                        <b>Estimasi Selesai:</b><br>
                        <span class="detail-value">
                            {{ \Carbon\Carbon::parse($t->batas_waktu)->format('d M Y') }}
                        </span>
                    </div>

                    <div class="mb-2">
                        <b>Paket Laundry:</b><br>

                        @foreach($t->details as $detail)

                            <div class="border rounded-3 p-2 mb-2" style="background:#f8fbff;">

                                <span class="detail-value">
                                    {{ $detail->paket->nm_paket ?? '-' }}
                                </span>

                                <br>

                                <small style="color:#6b8bd6;">
                                    {{ $detail->qty }} x
                                    Rp {{ number_format($detail->paket->harga ?? 0, 0, ',', '.') }}
                                </small>

                                <br>

                                <b style="font-size:13px;">
                                    Subtotal :
                                    Rp {{ number_format(($detail->qty * ($detail->paket->harga ?? 0)), 0, ',', '.') }}
                                </b>

                            </div>

                        @endforeach
                    </div>

                    <div class="mb-2">
                        <b>Total Harga:</b><br>

                        <span class="detail-value">
                            Rp {{ number_format($t->total_harga ?? 0, 0, ',', '.') }}
                        </span>
                    </div>

                    @if($t->tgl_bayar)
                        <div class="mb-2">
                            <b>Tanggal Bayar:</b><br>
                            <span class="detail-value">
                                {{ \Carbon\Carbon::parse($t->tgl_bayar)->format('d M Y') }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEdit{{ $t->id }}" tabindex="-1">

            <div class="modal-dialog modal-dialog-centered" style="max-width:500px;">

                <div class="modal-content" style="
                                                    border-radius:18px;
                                                    padding:10px 14px;
                                                 ">

                    <div class="modal-header border-0 pb-1">

                        <h5 class="fw-bold text-primary mb-0" style="font-size:16px;">

                            EDIT TRANSAKSI : {{ $t->kode_invoice }}

                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <form action="{{ route('transaksi.update', $t->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="modal-body pt-1 pb-2">

                            <div class="mb-2">

                                <label class="form-label text-primary fw-bold mb-1" style="font-size:14px;">

                                    Status Progres

                                </label>

                                <select name="status" class="form-select" style="height:40px; font-size:14px;">

                                    <option value="proses" {{ $t->status == 'proses' ? 'selected' : '' }}>
                                        Proses
                                    </option>

                                    <option value="selesai" {{ $t->status == 'selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>

                                </select>

                            </div>

                            <div class="mb-2">

                                <label class="form-label text-primary fw-bold mb-1" style="font-size:14px;">

                                    Status Pembayaran

                                </label>

                                <select name="status_bayar" class="form-select" style="height:40px; font-size:14px;">

                                    <option value="dibayar" {{ $t->status_bayar == 'dibayar' ? 'selected' : '' }}>
                                        Lunas
                                    </option>

                                    <option value="belum" {{ $t->status_bayar == 'belum' ? 'selected' : '' }}>
                                        Belum Lunas
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="modal-footer border-0 pt-1">

                            <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-bs-dismiss="modal">

                                Batal

                            </button>

                            <button type="submit" class="btn btn-primary btn-sm px-3" style="background:#0649ca">

                                Simpan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    @endforeach