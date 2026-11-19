@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function toggleInputPassword() {
            let input = document.getElementById('passwordInput');
            let icon = document.getElementById('eyeIcon');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

    <script>
        function konfirmasiHapus(id) {
            Swal.fire({
                title: 'Hapus Pengguna?',
                text: 'Data pengguna akan dihapus!',
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
        const profileBtn = document.getElementById('profileBtn');
        const profileCard = document.getElementById('profileCard');

        if (profileBtn && profileCard) {
            profileBtn.addEventListener('click', function () {
                if (profileCard.style.display === 'block') {
                    profileCard.style.display = 'none';
                } else {
                    profileCard.style.display = 'block';
                }
            });

            document.addEventListener('click', function (e) {
                if (!profileBtn.contains(e.target) && !profileCard.contains(e.target)) {
                    profileCard.style.display = 'none';
                }
            });
        }
    </script>

    <script>
        const logoutBtn = document.getElementById('logoutBtn');
        const logoutForm = document.getElementById('logoutForm');

        if (logoutBtn && logoutForm) {
            logoutBtn.addEventListener('click', function () {
                Swal.fire({
                    title: 'Yakin ingin logout?',
                    text: 'Anda akan keluar dari halaman admin',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Logout',
                    cancelButtonText: 'Batal',
                    background: '#ffffff',
                    color: '#0650d1'
                }).then((result) => {
                    if (result.isConfirmed) {
                        logoutForm.submit();
                    }
                });
            });
        }
    </script>

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

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>

    <script>
        const telepon = document.getElementById('telepon');
        if (telepon) {
            telepon.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, '');
                let hasil = '';
                if (value.length > 0) hasil += value.substring(0, 4);
                if (value.length > 4) hasil += '-' + value.substring(4, 8);
                if (value.length > 8) hasil += '-' + value.substring(8, 13);
                e.target.value = hasil;
            });
        }

        @foreach($users as $u)
            const teleponEdit{{ $u->id }} = document.getElementById('telepon_edit{{ $u->id }}');
            if (teleponEdit{{ $u->id }}) {
                teleponEdit{{ $u->id }}.addEventListener('input', function (e) {
                    let value = e.target.value.replace(/\D/g, '');
                    let hasil = '';
                    if (value.length > 0) hasil += value.substring(0, 4);
                    if (value.length > 4) hasil += '-' + value.substring(4, 8);
                    if (value.length > 8) hasil += '-' + value.substring(8, 13);
                    e.target.value = hasil;
                });
            }
        @endforeach
    </script>

    <script>
        const searchUser = document.getElementById('searchUser');
        if (searchUser) {
            searchUser.addEventListener('keyup', function () {
                let keyword = this.value.toLowerCase();
                let rows = document.querySelectorAll('#userTable tbody tr');

                rows.forEach(function (row) {
                    let text = row.innerText.toLowerCase();
                    if (text.includes(keyword)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    </script>
@endpush