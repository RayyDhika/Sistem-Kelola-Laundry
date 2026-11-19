@push('scripts')
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        function konfirmasiHapus(id) {
            Swal.fire({
                title: 'Hapus Paket?',
                text: 'Data paket akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1a4fbf',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'HAPUS',
                cancelButtonText: 'BATAL'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-hapus-' + id).submit();
                }
            });
        }
    </script>

    <script>

        document.querySelector('form').addEventListener('submit', function () {

            let btn = document.getElementById('btnSimpan');

            btn.disabled = true;

            btn.innerHTML = 'MENYIMPAN...';

        });

    </script>
    <!-- search -->

    <script>

        document.getElementById('searchPaket').addEventListener('keyup', function () {

            let keyword = this.value.toLowerCase();

            let rows = document.querySelectorAll('.table-custom tbody tr');

            rows.forEach(function (row) {

                let text = row.innerText.toLowerCase();

                if (text.includes(keyword)) {

                    row.style.display = '';

                } else {

                    row.style.display = 'none';

                }

            });

        });

    </script>

@endpush