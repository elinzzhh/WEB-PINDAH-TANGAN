<?php
session_start();

include '../../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menghindari SQL Injection
    $id = mysqli_real_escape_string($conn, $id);

    // Cek apakah user dengan ID tersebut ada
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");

    if (mysqli_num_rows($cek) > 0) {
        // Hapus user dari database
        $hapus = mysqli_query($conn, "DELETE FROM users WHERE id = '$id'");

        if ($hapus) {
            echo "<script>
                    alert('User berhasil dihapus!');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menghapus user!');
                    window.location.href = 'index.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Data user tidak ditemukan!');
                window.location.href = 'index.php';
              </script>";
    }
} else {
    // Jika diakses langsung tanpa parameter ID
    header("Location: index.php");
    exit();
}
?>