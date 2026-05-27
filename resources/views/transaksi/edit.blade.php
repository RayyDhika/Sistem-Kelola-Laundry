<div class="modal-content p-4">
    <div class="modal-header border-0">
        <h5 class="fw-bold text-primary">EDIT TRANSAKSI: {{ $transaksi->kode_invoice }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    
    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf @method('PUT')
        
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label text-primary fw-bold">Status Progres</label>
                <select name="status" class="form-select">
                    <option value="baru" {{ $transaksi->status == 'baru' ? 'selected' : '' }}>Baru</option>
                    <option value="proses" {{ $transaksi->status == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="diambil" {{ $transaksi->status == 'diambil' ? 'selected' : '' }}>Diambil</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label text-primary fw-bold">Status Pembayaran</label>

                <select name="status_bayar" class="form-select">
                    <option value="belum" {{ $transaksi->status_bayar == 'belum' ? 'selected' : '' }}>Belum Lunas</option>
                    <option value="dibayar" {{ $transaksi->status_bayar == 'dibayar' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>
        </div>
        
        <div class="modal-footer border-0">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" style="background:#0649ca">Simpan Perubahan</button>
        </div>
    </form>
</div>