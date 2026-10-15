<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}

$id_produk = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Mengambil data produk beserta nama kategorinya
$query = mysqli_query($conn, "SELECT produk.*, kategori.nama_kategori FROM produk LEFT JOIN kategori ON produk.kategori_id = kategori.id WHERE produk.id = $id_produk");
$produk = mysqli_fetch_assoc($query);

if(!$produk) {
    echo "<script>alert('Produk tidak ditemukan!'); window.location='dashboard.php';</script>";
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
        <div class="header" style="background: var(--white); display: flex; align-items: center; padding: 15px 20px;">
            <a href="dashboard.php" style="text-decoration: none; font-size: 20px; color: var(--text-color);">← Detail Barang</a>
        </div>

        <?php if(!empty($produk['gambar'])): ?>
            <img src="../assets/img/<?= $produk['gambar']; ?>" style="width: 100%; height: 250px; object-fit: cover; background-color: #ddd;" alt="<?= htmlspecialchars($produk['nama_produk']); ?>">
        <?php else: ?>
            <div style="width: 100%; height: 250px; background: #ddd; display: flex; align-items: center; justify-content: center; color: #777;">Tidak Ada Foto</div>
        <?php endif; ?>

        <div style="padding: 20px;">
            <div style="display:flex; gap:10px; margin-bottom:10px;">
                <span class="label-status" style="background-color: #e2e3e5; padding: 3px 8px; border-radius: 5px; font-size: 11px;"><?= htmlspecialchars($produk['nama_kategori'] ?? 'Barang Kampus'); ?></span>
            </div>
            
            <h2 style="font-size: 18px; margin-bottom: 5px;"><?= htmlspecialchars($produk['nama_produk']); ?></h2>
            <h3 style="color: var(--primary-color); margin-bottom: 15px;">Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></h3>

            <!-- Form untuk mengirim jumlah barang dan ID produk ke tambah_keranjang.php -->
            <form action="tambah_keranjang.php" method="GET" style="display: flex; gap: 10px; margin-bottom: 20px; align-items: center;">
                <input type="hidden" name="id" value="<?= $produk['id']; ?>">
                
                <div style="display: flex; border: 1px solid #ccc; border-radius: 8px; overflow: hidden; height: 40px;">
                    <button type="button" style="padding: 0 12px; border: none; background: #f0f0f0; cursor:pointer;" onclick="kurangJumlah()">-</button>
                    <input type="text" name="jumlah" id="jumlahInput" value="1" style="width: 40px; text-align: center; border: none; outline:none;" readonly>
                    <button type="button" style="padding: 0 12px; border: none; background: #f0f0f0; cursor:pointer;" onclick="tambahJumlah(<?= $produk['stok']; ?>)">+</button>
                </div>

                <!-- Tombol Submit ke Keranjang -->
                <button type="submit" class="btn-primary" style="flex: 1; border: none; border-radius: 8px; cursor: pointer; height: 40px; font-weight: bold; text-align: center;">+ Keranjang</button>
            </form>

            <a href="https://wa.me/?text=Halo,%20saya%20tertarik%20dengan%20produk%20<?= urlencode($produk['nama_produk']); ?>" target="_blank" class="btn-primary" style="background-color: #25D366; color: white; display:flex; justify-content:center; align-items:center; gap:10px; text-decoration:none; padding: 10px; border-radius: 8px;">
                WhatsApp Penjual
            </a>

            <div style="margin-top: 20px;">
                <h4 style="margin-bottom: 5px;">Deskripsi</h4>
                <p style="font-size: 13px; color: #555; line-height: 1.5;">
                    <?= nl2br(htmlspecialchars($produk['deskripsi'] ?? 'Tidak ada deskripsi.')); ?><br>
                    Stok Tersedia: <strong><?= $produk['stok']; ?></strong>
                </p>
            </div>
        </div>
    </div>

    <!-- Script Interaktif untuk Tombol + dan - -->
    <script>
        function kurangJumlah() {
            var input = document.getElementById('jumlahInput');
            var val = parseInt(input.value);
            if (val > 1) {
                input.value = val - 1;
            }
        }
        function tambahJumlah(maxStok) {
            var input = document.getElementById('jumlahInput');
            var val = parseInt(input.value);
            if (val < maxStok) {
                input.value = val + 1;
            } else {
                alert('Jumlah tidak boleh melebihi stok yang tersedia!');
            }
        }
    </script>
</body>
</html>
