@push('scripts')
    <script>
        // Fitur Live Search Data Transaksi Berdasarkan Nama Pelanggan
        $("#searchTransaksi").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#transaksiTable tbody tr").filter(function () {
                $(this).toggle($(this).find(".nama-pelanggan").text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Alert Konfirmasi Hapus Menggunakan SweetAlert2
        $(document).on('click', '.btn-hapus-transaksi', function (e) {
            e.preventDefault();
            let id = $(this).data('id');

            Swal.fire({
                title: 'APAKAH ANDA YAKIN?',
                text: "Data transaksi ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-hapus-' + id).submit();
                }
            });
        });

        // Array penampung data keranjang belanja laundry

        document.getElementById('pelangganselect').addEventListener('change', function () {

            let outletPelanggan = this.options[this.selectedIndex].dataset.outlet;

            let paketSelect = document.getElementById('paketSelect');

            for (let option of paketSelect.options) {

                if (!option.value) {
                    option.hidden = false;
                    continue;
                }

                let outletPaket = option.dataset.outlet;

                option.hidden = outletPaket != outletPelanggan;
            }

            paketSelect.value = '';
        });

        let keranjang = [];

        function tambahKeranjang() {
            let paketSelect = document.getElementById('paketSelect');
            let jumlahInput = document.getElementById('jumlahInput');

            let idPaket = paketSelect.value;
            let namaPaket = paketSelect.options[paketSelect.selectedIndex].text;
            let harga = parseFloat(paketSelect.options[paketSelect.selectedIndex].getAttribute('data-harga'));
            let qty = parseInt(jumlahInput.value);

            if (!idPaket || !qty || qty < 1) {
                Swal.fire('Oops!', 'Pilih paket dan tentukan jumlahnya terlebih dahulu.', 'warning');
                return;
            }

            // Cek jika item paket sudah diinput sebelumnya
            let eksis = keranjang.find(item => item.id === idPaket);
            if (eksis) {
                eksis.qty += qty;
                eksis.subtotal = eksis.qty * eksis.harga;
            } else {
                keranjang.push({
                    id: idPaket,
                    nama: namaPaket,
                    harga: harga,
                    qty: qty,
                    subtotal: qty * harga
                });
            }

            jumlahInput.value = '';
            renderKeranjang();
        }

        function hapusItemKeranjang(index) {
            keranjang.splice(index, 1);
            renderKeranjang();
        }

        function renderKeranjang() {
            let cartBox = document.getElementById('cartBox');
            let hiddenInputs = document.getElementById('hiddenInputs');
            let subtotalText = document.getElementById('subtotalText');
            let totalText = document.getElementById('totalText');
            let totalHargaInput = document.getElementById('totalHargaInput');

            if (keranjang.length === 0) {
                cartBox.innerHTML = `
                    <div class="cart-empty text-center text-muted pt-4">
                        <i class="fa fa-cart-shopping fa-2x mb-2"></i>
                        <p>Keranjang Pesanan Kosong</p>
                    </div>`;
                hiddenInputs.innerHTML = '';
                subtotalText.innerText = 'Rp 0';
                totalText.innerText = 'Rp 0';
                totalHargaInput.value = 0;
                return;
            }

            let htmlCart = '<ul class="list-group list-group-flush">';
            let htmlInputs = '';
            let totalAkhir = 0;

            keranjang.forEach((item, index) => {
                totalAkhir += item.subtotal;
                htmlCart += `
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent py-2 px-0">
                        <div>
                            <span class="fw-bold d-block" style="font-size:14px;">${item.nama}</span>
                            <small class="text-muted">${item.qty} x Rp ${item.harga.toLocaleString('id-ID')}</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-bold text-primary">Rp ${item.subtotal.toLocaleString('id-ID')}</span>
                            <button type="button" class="btn btn-sm text-danger p-0" onclick="hapusItemKeranjang(${index})">
                                <i class="fa fa-times-circle fa-lg"></i>
                            </button>
                        </div>
                    </li>`;

                // Generate input array tersembunyi untuk dikirim ke Controller Laravel
                htmlInputs += `
                    <input type="hidden" name="id_paket[]" value="${item.id}">
                    <input type="hidden" name="qty[]" value="${item.qty}">`;
            });

            htmlCart += '</ul>';

            cartBox.innerHTML = htmlCart;
            hiddenInputs.innerHTML = htmlInputs;
            subtotalText.innerText = 'Rp ' + totalAkhir.toLocaleString('id-ID');
            totalText.innerText = 'Rp ' + totalAkhir.toLocaleString('id-ID');
            totalHargaInput.value = totalAkhir;
        }
    </script>
@endpush