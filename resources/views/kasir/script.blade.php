<!-- SCRIPT PROFILE -->
<script>

    const profileBtn = document.getElementById('profileBtn');
    const profileCard = document.getElementById('profileCard');

    profileBtn.addEventListener('click', function () {

        if (profileCard.style.display === 'block') {

            profileCard.style.display = 'none';

        } else {

            profileCard.style.display = 'block';

        }

    });

    document.addEventListener('click', function (e) {

        if (
            !profileBtn.contains(e.target) &&
            !profileCard.contains(e.target)
        ) {
            profileCard.style.display = 'none';
        }

    });

</script>

<!-- SCRIPT LOGOUT -->
<script>

    const logoutBtn = document.getElementById('logoutBtn');
    const logoutForm = document.getElementById('logoutForm');

    logoutBtn.addEventListener('click', function () {

        Swal.fire({

            title: 'Yakin ingin logout?',
            text: 'Anda akan keluar dari halaman kasir',
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

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>