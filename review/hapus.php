<?php
session_start();
include '../../config/koneksi.php';

// Cek apakah ada parameter id yang dikirim melalui URL
if(isset($_GET['id'])) {
    $id_hapus = (int)$_GET['id'];
    
    // 1. Hapus data rincian barang di tabel order_items terlebih dahulu 
    // Hal ini wajib dilakukan untuk menghindari error Foreign Key Constraint
    $query_items = "DELETE FROM order_items WHERE order_id = $id_hapus";
    mysqli_query($conn, $query_items);
    
    // 2. Setelah rincian terhapus, hapus data transaksi utama di tabel orders
    $query_order = "DELETE FROM orders WHERE id = $id_hapus";
    $eksekusi = mysqli_query($conn, $query_order);
    
    if($eksekusi) {
        echo "<script>
                alert('Data riwayat (review) transaksi berhasil dihapus!'); 
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Terjadi kesalahan saat menghapus data!'); 
                window.location.href = 'index.php';
              </script>";
    }
} else {
    // Jika tidak ada parameter ID, tendang kembali ke halaman index
    header("Location: index.php");
    exit;
}
?>