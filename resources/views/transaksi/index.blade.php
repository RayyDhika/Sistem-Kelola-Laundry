<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; background: #f8faff;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-primary">TAMBAH TRANSAKSI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-5 border-end">
                            <h6 class="text-primary mb-3">Pelanggan & Layanan</h6>
                            
                            <label class="small">Pelanggan</label>
                            <select name="id_pelanggan" class="form-select mb-3" required>
                                <option value="">Pilih Pelanggan</option>
                                @foreach($pelanggans as $p)
                                    <option value="{{ $p->id }}">{{ $p->nm_pelanggan }} ({{ $p->no_telp }})</option>
                                @endforeach
                            </select>

                            <div class="p-3 bg-white border rounded">
                                <label class="small">Tambah Layanan</label>
                                <select id="selectPaket" class="form-select mb-2">
                                    <option value="">Pilih Paket Cucian</option>
                                    @foreach($pakets as $pk)
                                        <option value="{{ $pk->id }}" data-nama="{{ $pk->nm_paket }}" data-harga="{{ $pk->harga }}">
                                            {{ $pk->nm_paket }} - Rp {{ number_format($pk->harga) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="d-flex gap-2">
                                    <input type="number" id="inputQty" class="form-control" placeholder="Jumlah">
                                    <button type="button" class="btn btn-primary" onclick="tambahKeKeranjang()">+ Add</button>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="small">Pembayaran</label>
                                <select name="metode_pembayaran" class="form-select mb-2">
                                    <option value="langsung">Bayar Langsung</option>
                                    <option value="nanti">Bayar Nanti</option>
                                </select>
                                <label class="small">Estimasi Selesai</label>
                                <input type="date" name="estimasi_selesai" class="form-select" required>
                            </div>
                        </div>

                        <div class="col-md-7 ps-4">
                            <h6 class="text-primary mb-3">Keranjang Pesanan</h6>
                            <div id="keranjangKosong" class="text-center p-5 border rounded bg-white">
                                <i class="fa fa-shopping-cart fs-1 text-muted opacity-25"></i>
                                <p class="text-muted mt-2">Keranjang Pesanan Kosong</p>
                            </div>

                            <div id="daftarItem" style="display:none;">
                                <div class="list-group mb-3" id="cartItems">
                                    </div>

                                <div class="p-3 border rounded bg-white">
                                    <div class="d-flex justify-content-between">
                                        <span>Total:</span>
                                        <h5 class="text-primary mb-0" id="textTotal">Rp 0</h5>
                                        <input type="hidden" name="total_harga" id="inputTotal">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-info text-white" data-bs-dismiss="modal">BATAL</button>
                                <button type="submit" class="btn btn-primary px-4">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let cart = [];

function tambahKeKeranjang() {
    let select = document.getElementById('selectPaket');
    let pkg = select.options[select.selectedIndex];
    let qty = document.getElementById('inputQty').value;

    if(!pkg.value || !qty) return Swal.fire('Peringatan', 'Pilih paket dan jumlah!', 'warning');

    cart.push({
        id_paket: pkg.value,
        nama: pkg.getAttribute('data-nama'),
        harga: pkg.getAttribute('data-harga'),
        qty: qty
    });

    renderCart();
}

function renderCart() {
    let html = '';
    let total = 0;
    
    if(cart.length > 0) {
        document.getElementById('keranjangKosong').style.display = 'none';
        document.getElementById('daftarItem').style.display = 'block';
        
        cart.forEach((item, index) => {
            let subtotal = item.harga * item.qty;
            total += subtotal;
            html += `
                <div class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                    <div>
                        <strong class="text-primary">${item.nama}</strong><br>
                        <small class="text-muted">Rp ${item.harga}/KG</small>
                    </div>
                    <div class="text-end d-flex align-items-center gap-3">
                        <span>${item.qty} KG</span>
                        <span class="fw-bold">Rp ${subtotal.toLocaleString()}</span>
                        <button type="button" class="btn btn-sm btn-danger" onclick="hapusItem(${index})"><i class="fa fa-trash"></i></button>
                        <input type="hidden" name="items[${index}][id_paket]" value="${item.id_paket}">
                        <input type="hidden" name="items[${index}][qty]" value="${item.qty}">
                    </div>
                </div>`;
        });
    } else {
        document.getElementById('keranjangKosong').style.display = 'block';
        document.getElementById('daftarItem').style.display = 'none';
    }

    document.getElementById('cartItems').innerHTML = html;
    document.getElementById('textTotal').innerText = 'Rp ' + total.toLocaleString();
}

function hapusItem(index) {
    cart.splice(index, 1);
    renderCart();
}

// Notifikasi SweetAlert (Sama persis dengan Registrasi Pelanggan)
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 1500,
        background: '#ffffff',
        iconColor: '#3577f3'
    });
@endif

// Fungsi Cetak Nota
function cetakNota(id) {
    window.location.href = "/transaksi/cetak/" + id;
}
</script>