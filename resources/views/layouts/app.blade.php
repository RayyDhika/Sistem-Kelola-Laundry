<script>
    // 1. Notifikasi Sukses (Tambah & Edit)
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'BERHASIL', // Judul sesuai gambar image_0b3b13.png
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2500,
            iconColor: '#28a745' // Warna hijau
        });
    @endif

    // 2. Notifikasi Berhasil Hapus
    @if(session('deleted'))
        Swal.fire({
            icon: 'success',
            title: 'DATA BERHASIL DIHAPUS', // Sesuai gambar image_0b3b37.png kanan
            showConfirmButton: false,
            timer: 2500
        });
    @endif

    // 3. Konfirmasi Hapus (Muncul saat tombol hapus diklik)
    function konfirmasiHapus(id) {
        Swal.fire({
            title: 'APAKAH ANDA YAKIN?',
            text: "Data Yang Dihapus Tidak Dapat Dikembalikan!!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#007bff', // Biru terang (Ya, Hapus!)
            cancelButtonColor: '#000080',  // Biru tua (Batal)
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-hapus-' + id).submit();
            }
        });
    }
</script>