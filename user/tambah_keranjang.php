<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$produk_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$jumlah = isset($_GET['jumlah']) ? (int)$_GET['jumlah'] : 1;
if ($jumlah < 1) $jumlah = 1;

if ($produk_id > 0) {
    // Cek stok produk di database
    $cek_produk = mysqli_query($conn, "SELECT stok FROM produk WHERE id = $produk_id");
    $data_produk = mysqli_fetch_assoc($cek_produk);

    if($data_produk) {
        $stok_tersedia = $data_produk['stok'];

        // Cek apakah produk sudah ada di keranjang user
        $cek = mysqli_query($conn, "SELECT * FROM keranjang WHERE user_id = '$user_id' AND produk_id = '$produk_id'");

        if (mysqli_num_rows($cek) > 0) {
            $row_keranjang = mysqli_fetch_assoc($cek);
            $jumlah_baru = $row_keranjang['jumlah'] + $jumlah;

            if ($jumlah_baru > $stok_tersedia) {
                echo "<script>alert('Total jumlah di keranjang melebihi stok produk yang tersedia!'); window.location='keranjang.php';</script>";
                exit;
            }

            // Jika sudah ada, tambahkan dengan jumlah yang dipilih
            $query_update = mysqli_query($conn, "UPDATE keranjang SET jumlah = $jumlah_baru WHERE user_id = '$user_id' AND produk_id = '$produk_id'");
            
            if ($query_update) {
                echo "<script>alert('Jumlah produk di keranjang berhasil ditambah!'); window.location='keranjang.php';</script>";
            } else {
                echo "<script>alert('Gagal memperbarui keranjang!'); window.location='dashboard.php';</script>";
            }
        } else {
            if ($jumlah > $stok_tersedia) {
                echo "<script>alert('Jumlah yang diminta melebihi stok produk!'); window.location='detail_produk.php?id=$produk_id';</script>";
                exit;
            }

            // Jika belum ada, masukkan data baru dengan jumlah pilihan
            $query_insert = mysqli_query($conn, "INSERT INTO keranjang (user_id, produk_id, jumlah) VALUES ('$user_id', '$produk_id', $jumlah)");
            
            if ($query_insert) {
                echo "<script>alert('Produk berhasil ditambahkan ke keranjang!'); window.location='keranjang.php';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan ke keranjang!'); window.location='dashboard.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Produk tidak ditemukan!'); window.location='dashboard.php';</script>";
    }
} else {
    echo "<script>alert('Produk tidak valid!'); window.location='dashboard.php';</script>";
}
?>
