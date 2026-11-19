@push('scripts')
    <script>
        $(document).ready(function () {
            
            // ==========================================
            // 1. FITUR LIVE SEARCH (PENCARIAN)
            // ==========================================
            $("#searchInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#pelangganTable tbody tr").filter(function () {
                    $(this).toggle($(this).find(".nama-pelanggan").text().toLowerCase().indexOf(value) > -1);
                });
            });

            // ==========================================
            // 2. TRIGGER MODAL EDIT & ISI DATA AUTOMATIS
            // ==========================================
            $(document).on('click', '.btn-edit', function () {
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let telp = $(this).data('telp');
                let alamat = $(this).data('alamat');
                let outlet = $(this).data('outlet');
                let jk = $(this).data('jk');

                // Isi input text & textarea modal
                $('#edit_nama').val(nama);
                $('#edit_telp').val(telp);
                $('#edit_alamat').val(alamat);
                $('#edit_outlet').val(outlet);
                
                // Set radio button jenis kelamin
                if (jk === 'L') {
                    $('#edit_jk_l').prop('checked', true);
                } else if (jk === 'P') {
                    $('#edit_jk_p').prop('checked', true);
                }
                
                // Ubah action form secara dinamis mengarah ke ID pelanggan terpilih
                $('#formEdit').attr('action', '/pelanggan/' + id);

                // Solusi Bootstrap 5: Picu modal menggunakan vanilla JS agar pasti terbuka
                var modalEditEl = document.getElementById('modalEdit');
                var modalEdit = bootstrap.Modal.getInstance(modalEditEl) || new bootstrap.Modal(modalEditEl);
                modalEdit.show();
            });

            // ==========================================
            // 3. FORMAT AUTOMATIS INPUT NOMOR TELEPON
            // ==========================================
            // Menangani format input telepon baik di form tambah maupun form edit
            $(document).on('input', '#no_telp, #edit_telp', function (e) {
                let value = e.target.value.replace(/\D/g, '');
                let hasil = '';
                if (value.length > 0) hasil += value.substring(0, 4);
                if (value.length > 4) hasil += '-' + value.substring(4, 8);
                if (value.length > 8) hasil += '-' + value.substring(8, 13);
                e.target.value = hasil;
            });

        });

        // ==========================================
        // 4. KONFIRMASI HAPUS DATA (SWEETALERT2)
        // ==========================================
        function konfirmasiHapus(id) {
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0649ca',
                cancelButtonColor: '#3498db',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-hapus-' + id).submit();
                }
            });
        }
    </script>
@endpush