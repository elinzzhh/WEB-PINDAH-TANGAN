<?php
session_start();
include '../../config/koneksi.php';

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Opsional: Hapus file gambar dari folder uploads agar tidak menumpuk
    $query_gambar = mysqli_query($conn, "SELECT gambar FROM products WHERE id = $id");
    $data_gambar = mysqli_fetch_assoc($query_gambar);
    if($data_gambar && file_exists("../../uploads/produk/".$data_gambar['gambar'])) {
        unlink("../../uploads/produk/".$data_gambar['gambar']);
    }
    
    // Hapus dari database
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    echo "<script>alert('Produk berhasil dihapus!'); window.location='index.php';</script>";
} else {
    header("Location: index.php");
}
?>