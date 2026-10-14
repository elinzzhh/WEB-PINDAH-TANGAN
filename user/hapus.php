<?php
session_start();
include '../../config/koneksi.php';

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Penting: Hapus juga data di tabel orders yang terkait dengan user ini karena adanya Foreign Key
    mysqli_query($conn, "DELETE FROM orders WHERE user_id = $id");
    
    // Hapus user utama
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    echo "<script>alert('User berhasil dihapus!'); window.location='index.php';</script>";
} else {
    header("Location: index.php");
}
?>