<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Pindah Tangan</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="app-container">
        <div class="header">
            <div>
                <h3 style="color: var(--primary-color);">Pindah Tangan</h3>
                <small>Halo, <?= $_SESSION['nama']; ?></small>
            </div>
            <div>🛒</div>
        </div>

        <div class="search-bar">
            🔍 <input type="text" placeholder="Cari modul, alat praktikum, barang kost...">
        </div>

        <div class="banner">
            <h3>Thrift & Barter Kampus: Transaksi Aman Tanpa Ongkir</h3>
            <button style="margin-top: 10px; padding: 5px 10px; border-radius: 15px; border: none;">Belanja Sekarang</button>
        </div>

        <h4 style="margin-left: 20px;">Kategori Cepat</h4>
        <div class="kategori-row">
            <div class="kategori-item">
                <div class="kategori-icon">🔬</div>
                <span>Alat Praktikum</span>
            </div>
            <div class="kategori-item">
                <div class="kategori-icon">📚</div>
                <span>Buku & Modul</span>
            </div>
            <div class="kategori-item">
                <div class="kategori-icon">🪑</div>
                <span>Barang Kost</span>
            </div>
            <div class="kategori-item">
                <div class="kategori-icon">👕</div>
                <span>Fashion</span>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; margin: 20px 20px 0 20px;">
            <h4>Rekomendasi Terbaru</h4>
            <a href="produk.php" style="font-size: 12px; text-decoration: none; color: var(--primary-color);">Lihat Semua ></a>
        </div>

        <div class="produk-grid">

            <div class="produk-card">
                <div style="height: 100px; background: #ddd; border-radius: 8px; margin-bottom: 10px;"></div>
                <h5 style="font-size: 13px;">Buku Kalkulus</h5>
                <p style="color: var(--primary-color); font-weight: bold; margin: 5px 0;">Rp 45.000</p>
                <span class="label-status label-jual">Jual</span>
            </div>
            
            <div class="produk-card">
                <div style="height: 100px; background: #ddd; border-radius: 8px; margin-bottom: 10px;"></div>
                <h5 style="font-size: 13px;">Kabel Jumper</h5>
                <p style="color: var(--primary-color); font-weight: bold; margin: 5px 0;">Rp 0</p>
                <span class="label-status label-hibah">Hibah</span>
            </div>
            
            <div class="produk-card">
                <div style="height: 100px; background: #ddd; border-radius: 8px; margin-bottom: 10px;"></div>
                <h5 style="font-size: 13px;">Modul Fisika</h5>
                <p style="color: #666; font-size: 11px; margin: 5px 0;">Cari: Buku Biologi</p>
                <span class="label-status label-barter">Barter</span>
            </div>
        </div>

        <div class="bottom-nav">
            <a href="dashboard.php" class="nav-item">
                <div style="font-size: 20px;">🏠</div>
                <span>Beranda</span>
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
