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
    <title>Profil - Pindah Tangan</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .profile-header { text-align: center; padding: 20px; background: var(--white); margin-bottom: 10px; }
        .profile-pic { width: 80px; height: 80px; background: #ccc; border-radius: 50%; margin: 0 auto 10px auto; }
        .menu-list { background: var(--white); }
        .menu-item { display: flex; justify-content: space-between; padding: 15px 20px; border-bottom: 1px solid #eee; text-decoration: none; color: var(--text-color); font-size: 14px; }
    </style>
</head>
<body>
    <div class="app-container">
        <div class="header" style="background: var(--white);">
            <a href="dashboard.php" style="text-decoration: none; font-size: 20px; color: var(--text-color);">← Profil</a>
        </div>

        <div class="profile-header">
            <div class="profile-pic"></div>
            <h3 style="font-size: 16px;"><?= $_SESSION['nama'] ?></h3>
            <p style="font-size: 12px; color: #666;"><?= $_SESSION['nrp'] ?>@student.pens.ac.id</p>
            
            <div style="display: flex; justify-content: center; gap: 20px; margin-top: 15px;">
                <div style="text-align: center;">
                    <h4 style="color: var(--primary-color);">3</h4>
                    <p style="font-size: 11px;">Barang Diposting</p>
                </div>
                <div style="text-align: center;">
                    <h4 style="color: var(--primary-color);">12</h4>
                    <p style="font-size: 11px;">Barang Didapat</p>
                </div>
            </div>
        </div>

        <div class="menu-list">
            <a href="#" class="menu-item"><span>👤 Data Diri</span> <span>></span></a>
            <a href="#" class="menu-item"><span>📍 Lokasi COD Favorit</span> <span>></span></a>
            <a href="pesanan.php" class="menu-item"><span>📦 Pesanan Saya</span> <span>></span></a>
            <a href="wishlist.php" class="menu-item"><span>❤️ Wishlist</span> <span>></span></a>
            <a href="#" class="menu-item"><span>📞 Hubungi Bantuan</span> <span>></span></a>
            <a href="../logout.php" class="menu-item" style="color: red;"><span>🚪 Keluar</span></a>
        </div>

        <div class="bottom-nav">
            <a href="dashboard.php" class="nav-item"><div style="font-size: 20px;">🏠</div><span>Beranda</span></a>
            <a href="keranjang.php" class="nav-item"><div style="font-size: 20px;">🛒</div><span>Keranjang</span></a>
            <a href="profil.php" class="nav-item" style="color: var(--primary-color);"><div style="font-size: 20px;">👤</div><span>Profil</span></a>
        </div>
    </div>
</body>
</html>
