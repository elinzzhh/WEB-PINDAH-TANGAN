<?php
session_start();
include '../../config/koneksi.php';

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Ambil data gambar terlebih dahulu untuk dihapus dari folder
    $query_gambar = mysqli_query($conn, "SELECT gambar FROM produk WHERE id = $id");
    $data_gambar = mysqli_fetch_assoc($query_gambar);
    
    if($data_gambar && !empty($data_gambar['gambar'])) {
        // Sesuaikan folder path gambar Anda (misal: ../../assets/img/)
        $target_file = "../../assets/img/" . $data_gambar['gambar'];
        if(file_exists($target_file)) {
            unlink($target_file);
        }
    }
    
    // Hapus data dari tabel 'produk' di database
    $hapus = mysqli_query($conn, "DELETE FROM produk WHERE id = $id");
    
    if($hapus) {
        echo "<script>alert('Produk berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus produk!'); window.location='index.php';</script>";
    }
} else {
    header("Location: index.php");
    exit;
}
?>