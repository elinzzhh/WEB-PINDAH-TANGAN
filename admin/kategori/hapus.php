<?php
session_start();
// Naik 2 tingkat dari folder admin/kategori/ ke root, lalu masuk ke config/koneksi.php
include '../../config/koneksi.php';

// Memastikan parameter ID kategori ada pada URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Cek apakah kategori dengan ID tersebut ada di database
    $cek = mysqli_query($conn, "SELECT * FROM kategori WHERE id = $id");

    if (mysqli_num_rows($cek) > 0) {
        // Hapus kategori dari database
        $hapus = mysqli_query($conn, "DELETE FROM kategori WHERE id = $id");

        if ($hapus) {
            echo "<script>
                    alert('Kategori berhasil dihapus!');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menghapus kategori!');
                    window.location.href = 'index.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Data kategori tidak ditemukan!');
                window.location.href = 'index.php';
              </script>";
    }
} else {
    // Jika diakses langsung tanpa parameter ID
    header("Location: index.php");
    exit();
}
?>