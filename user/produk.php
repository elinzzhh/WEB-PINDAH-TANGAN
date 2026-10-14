<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}

$filter_query = "";
if(isset($_GET['kategori'])) {
    $kat_id = (int)$_GET['kategori'];
    $filter_query = "WHERE kategori_id = $kat_id";
}

$query_produk = mysqli_query($conn, "SELECT p.*, c.nama_kategori FROM products p LEFT JOIN categories c ON p.kategori_id = c.id $filter_query ORDER BY p.id DESC");
$query_kategori = mysqli_query($conn, "SELECT * FROM categories");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog - Pindah Tangan</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .filter-scroll {
            display: flex;
            overflow-x: auto;
            padding: 10px 20px;
            gap: 10px;
        }
        .filter-btn {
            padding: 8px 15px;
            background-color: var(--white);
            border: 1px solid #ccc;
            border-radius: 20px;
            text-decoration: none;
            color: var(--text-color);
            white-space: nowrap;
            font-size: 12px;
        }
        .filter-btn.active {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <div class="header">
            <div>
                <a href="dashboard.php" style="text-decoration: none; font-size: 20px; color: var(--text-color);">←</a>
            </div>
            <div class="search-bar" style="margin: 0; width: 70%;">
                🔍 <input type="text" placeholder="Cari modul, alat praktikum...">
            </div>
            <div>🛒</div>
        </div>

        <div class="filter-scroll">
            <a href="produk.php" class="filter-btn <?= !isset($_GET['kategori']) ? 'active' : '' ?>">Semua</a>
            <?php while($kat = mysqli_fetch_assoc($query_kategori)): ?>
                <a href="produk.php?kategori=<?= $kat['id'] ?>" class="filter-btn <?= (isset($_GET['kategori']) && $_GET['kategori'] == $kat['id']) ? 'active' : '' ?>">
                    <?= $kat['nama_kategori'] ?>
                </a>
            <?php endwhile; ?>
        </div>

        <div class="produk-grid">
            <?php while($row = mysqli_fetch_assoc($query_produk)): 
                $label_class = 'label-jual';
                $label_text = 'Jual';
                $harga_display = 'Rp ' . number_format($row['harga'], 0, ',', '.');
                
                if($row['harga'] == 0 && $row['kondisi'] == 'Barter') {
                    $label_class = 'label-barter';
                    $label_text = 'Barter';
                    $harga_display = 'Opsi Barter';
                } elseif ($row['harga'] == 0) {
                    $label_class = 'label-hibah';
                    $label_text = 'Hibah';
                    $harga_display = 'Rp 0 (Gratis)';
                }
            ?>
            <a href="detail_produk.php?id=<?= $row['id'] ?>" style="text-decoration: none; color: inherit;">
                <div class="produk-card">
                    <img src="../assets/img/produk/<?= $row['gambar'] ? $row['gambar'] : 'default.jpg' ?>" alt="<?= $row['nama_produk'] ?>">
                    <h5 style="font-size: 13px; margin-top:5px;"><?= $row['nama_produk'] ?></h5>
                    <p style="font-size: 11px; color: #666; margin: 3px 0;">Lokasi Kampus PENS</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <p style="color: var(--primary-color); font-weight: bold; font-size: 12px; margin: 5px 0;"><?= $harga_display ?></p>
                        <span class="label-status <?= $label_class ?>"><?= $label_text ?></span>
                    </div>
                </div>
            </a>
            <?php endwhile; ?>
        </div>

        <div class="bottom-nav">
            <a href="dashboard.php" class="nav-item">
                <div style="font-size: 20px;">🏠</div>
                <span>Beranda</span>
            </a>
            <a href="produk.php" class="nav-item" style="color: var(--primary-color);">
                <div style="font-size: 20px;">📦</div>
                <span>Kategori</span>
            </a>
            <a href="keranjang.php" class="nav-item">
                <div style="font-size: 20px;">🛒</div>
                <span>Keranjang</span>
            </a>
            <a href="profil.php" class="nav-item">
                <div style="font-size: 20px;">👤</div>
                <span>Profil</span>
            </a>
        </div>
    </div>
</body>
</html>
