<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}

$id_produk = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = mysqli_query($conn, "SELECT p.*, c.nama_kategori FROM products p LEFT JOIN categories c ON p.kategori_id = c.id WHERE p.id = $id_produk");
$produk = mysqli_fetch_assoc($query);

if(!$produk) {
    echo "Produk tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Pindah Tangan</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="app-container">
        <div class="header">
            <a href="produk.php" style="text-decoration: none; font-size: 20px; color: var(--text-color);">← Detail Barang</a>
            <div>♡ 🔗</div>
        </div>

        <img src="../assets/img/produk/<?= $produk['gambar'] ? $produk['gambar'] : 'default.jpg' ?>" style="width: 100%; height: 250px; object-fit: cover; background-color: #ddd;">

        <div style="padding: 20px;">
            <div style="display:flex; gap:10px; margin-bottom:10px;">
                <span class="label-status" style="background-color: #e2e3e5;"><?= $produk['nama_kategori'] ?></span>
                <?php if($produk['kondisi'] == 'Barter'): ?>
                    <span class="label-status label-barter">Bisa Barter</span>
                <?php endif; ?>
            </div>
            
            <h2 style="font-size: 18px; margin-bottom: 5px;"><?= $produk['nama_produk'] ?></h2>
            <h3 style="color: var(--primary-color); margin-bottom: 15px;">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></h3>

            <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                <div style="display: flex; border: 1px solid #ccc; border-radius: 8px; overflow: hidden; width: 100px;">
                    <button style="padding: 10px; border: none; background: #f0f0f0; cursor:pointer;">-</button>
                    <input type="text" value="1" style="width: 40px; text-align: center; border: none; outline:none;">
                    <button style="padding: 10px; border: none; background: #f0f0f0; cursor:pointer;">+</button>
                </div>
                <button class="btn-primary" style="flex: 1;">+ Keranjang</button>
            </div>

            <button class="btn-primary" style="background-color: #25D366; color: white; display:flex; justify-content:center; align-items:center; gap:10px;">
                WhatsApp Penjual
            </button>

            <div style="margin-top: 20px;">
                <h4 style="margin-bottom: 5px;">Deskripsi</h4>
                <p style="font-size: 13px; color: #555; line-height: 1.5;">
                    Kondisi barang: <?= $produk['kondisi'] ?>.<br>
                    Ukuran: <?= $produk['ukuran'] ? $produk['ukuran'] : '-' ?><br>
                    (Simulasi Data Deskripsi dari Database)
                </p>
            </div>
        </div>
    </div>
</body>
</html>
