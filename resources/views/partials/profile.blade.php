<div class="position-relative">
    <button id="profileBtn" class="btn border-0 bg-transparent d-flex align-items-center gap-2 text-primary">
        
        @if(auth()->user()->foto && file_exists(public_path('foto_profil/' . auth()->user()->foto)))
            <img src="{{ asset('foto_profil/' . auth()->user()->foto) }}" width="40" height="40" class="rounded-circle border" style="object-fit: cover;">
        @else
            <i class="fa fa-user-circle fs-1"></i>
        @endif
        
        <span>
            {{ auth()->user()->name }}
        </span>
    </button>

    <div id="profileCard" class="shadow-lg rounded-4 bg-white p-3" style="
                    width: 320px;
                    position: absolute;
                    top: 70px;
                    right: 0;
                    display: none;
                    z-index: 9999;
                ">

        <div class="d-flex align-items-center gap-3 p-3 rounded-4" style="background: #eaf2ff;">

            <form id="fotoForm" action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="fotoInput" name="foto" accept="image/*" hidden>

                <div style="cursor:pointer" onclick="document.getElementById('fotoInput').click()" title="Klik untuk ganti foto">
                    @if(auth()->user()->foto && file_exists(public_path('foto_profil/' . auth()->user()->foto)))
                        <img src="{{ asset('foto_profil/' . auth()->user()->foto) }}" width="70" height="70"
                            class="rounded-circle border" style="object-fit: cover;">
                    @else
                        <i class="fa fa-user-circle text-primary" style="font-size:70px"></i>
                    @endif
                </div>
            </form>

            <div>
                <h4 class="m-0 fw-bold text-primary text-uppercase" style="font-size: 16px;">
                    {{ auth()->user()->name }}
                </h4>
                <small class="text-primary">
                    {{ auth()->user()->email }}
                </small>
            </div>
        </div>

        @if(auth()->user()->foto && file_exists(public_path('foto_profil/' . auth()->user()->foto)))
            <div class="mt-2 text-center">
                <form id="resetFotoForm" action="{{ route('profil.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="reset_foto" value="1">
                    <button type="button" id="resetFotoBtn" class="btn btn-sm btn-outline-secondary w-100 border-0 text-muted" style="font-size: 12px;">
                        <i class="fa fa-rotate-left me-1"></i> Kembalikan Profil Semula
                    </button>
                </form>
            </div>
        @endif

        <div class="border rounded-4 p-3 mt-3">
            <p class="mb-2 text-primary" style="font-family: Arial, Helvetica, sans-serif">
                <i class="fa fa-user me-2"></i>
                Role: <span class="text-capitalize">{{ auth()->user()->role }}</span>
            </p>
            <p class="mb-0 text-success" style="font-family: Arial, Helvetica, sans-serif">
                <i class="fa fa-circle me-2"></i>
                Outlet: {{ auth()->user()->outlet->nm_outlet ?? '-' }}
            </p>
        </div>

        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="button" id="logoutBtn" class="btn btn-danger w-100 fw-bold py-2 rounded-3">
                <i class="fa fa-power-off me-2"></i>
                LOGOUT
            </button>
        </form>
    </div>
</div>

<script>
    // 1. Logika Dropdown Buka-Tutup Card Profil
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

    // 2. Konfirmasi sebelum melakukan reset foto profil
    const resetFotoBtn = document.getElementById('resetFotoBtn');
    if (resetFotoBtn) {
        resetFotoBtn.addEventListener('click', function () {
            Swal.fire({
                title: 'Kembalikan ke profil semula?',
                text: 'Foto profil Anda saat ini akan dihapus dan kembali menggunakan ikon default.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Reset',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('resetFotoForm').submit();
                }
            });
        });
    }

    // 3. Script otomatis submit ketika memilih file foto baru
    const fotoInput = document.getElementById('fotoInput');
    if (fotoInput) {
        fotoInput.addEventListener('change', function() {
            document.getElementById('fotoForm').submit();
        });
    }

    // 4. Script Konfirmasi Tombol Logout
    const logoutBtn = document.getElementById('logoutBtn');
    const logoutForm = document.getElementById('logoutForm');

    if (logoutBtn && logoutForm) {
        logoutBtn.addEventListener('click', function () {
            Swal.fire({
                title: 'Yakin ingin logout?',
                text: 'Anda akan keluar dari aplikasi',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
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