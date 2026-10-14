<?php
session_start();
include '../../config/koneksi.php';

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // (Opsional Aman): Mengatur produk yang memiliki kategori ini agar kategori_id nya menjadi NULL 
    // agar tidak terjadi error foreign key constraint pada database MySQL.
    mysqli_query($conn, "UPDATE products SET kategori_id = NULL WHERE kategori_id = $id");
    
    // Menghapus kategori dari tabel categories
    mysqli_query($conn, "DELETE FROM categories WHERE id = $id");
    
    echo "<script>alert('Kategori berhasil dihapus!'); window.location='index.php';</script>";
} else {
    header("Location: index.php");
}
?>