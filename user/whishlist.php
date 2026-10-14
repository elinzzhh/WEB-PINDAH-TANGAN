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
    <title>Wishlist - Pindah Tangan</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="app-container">
        <div class="header">
            <a href="dashboard.php" style="text-decoration: none; font-size: 20px; color: var(--text-color);">← Wishlist Saya (2)</a>
        </div>

        <div class="produk-grid">
            <div class="produk-card">
                <div style="height: 100px; background: #ddd; border-radius: 8px; position: relative;">
                    <span style="position: absolute; top: 5px; right: 5px; color: red;">❤️</span>
                </div>
                <h5 style="font-size: 13px; margin-top:5px;">Jas Laboratorium</h5>
                <p style="color: var(--primary-color); font-weight: bold; margin: 5px 0;">Rp 50.000</p>
                <button class="btn-primary" style="padding: 5px; font-size: 11px;">+ Keranjang</button>
            </div>
            
            <div class="produk-card">
                <div style="height: 100px; background: #ddd; border-radius: 8px; position: relative;">
                    <span style="position: absolute; top: 5px; right: 5px; color: red;">❤️</span>
                </div>
                <h5 style="font-size: 13px; margin-top:5px;">Tote Bag PENS</h5>
                <p style="color: var(--primary-color); font-weight: bold; margin: 5px 0;">Rp 20.000</p>
                <button class="btn-primary" style="padding: 5px; font-size: 11px;">+ Keranjang</button>
            </div>
        </div>

        <div class="bottom-nav">
            <a href="dashboard.php" class="nav-item"><div style="font-size: 20px;">🏠</div><span>Beranda</span></a>
            <a href="keranjang.php" class="nav-item"><div style="font-size: 20px;">🛒</div><span>Keranjang</span></a>
            <a href="profil.php" class="nav-item"><div style="font-size: 20px;">👤</div><span>Profil</span></a>
        </div>
    </div>
</body>
</html>
