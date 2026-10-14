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
    <title>Keranjang Belanja - Pindah Tangan</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .cart-item { display: flex; padding: 15px 20px; border-bottom: 1px solid #eee; background: #fff;}
        .cart-img { width: 60px; height: 60px; background: #ddd; border-radius: 8px; margin-right: 15px;}
        .cart-details { flex: 1; }
    </style>
</head>
<body>
    <div class="app-container">
        <div class="header" style="background: var(--white);">
            <a href="dashboard.php" style="text-decoration: none; font-size: 20px; color: var(--text-color);">←</a>
            <h4>Keranjang Belanja (3)</h4>
            <div>🗑️</div>
        </div>

        <div class="cart-item">
            <div class="cart-img"></div>
            <div class="cart-details">
                <h5 style="font-size: 14px;">Buku Kalkulus</h5>
                <p style="font-size: 11px; color: #888;">BUKU</p>
                <p style="color: var(--primary-color); font-weight: bold; margin: 5px 0;">Rp 45.000</p>
            </div>
        </div>
        
        <div class="cart-item">
            <div class="cart-img"></div>
            <div class="cart-details">
                <h5 style="font-size: 14px;">Kipas Angin Kost</h5>
                <p style="font-size: 11px; color: #888;">BARANG KOST</p>
                <p style="color: var(--primary-color); font-weight: bold; margin: 5px 0;">Rp 75.000</p>
            </div>
        </div>

        <div style="position: absolute; bottom: 65px; width: 100%; background: #fff; padding: 15px 20px; border-top: 1px solid #ddd; border-radius: 20px 20px 0 0;">
            <div style="display:flex; justify-content: space-between; margin-bottom: 5px;">
                <span style="font-size: 13px;">Subtotal</span>
                <span style="font-size: 13px; font-weight: bold;">Rp 120.000</span>
            </div>
            <div style="display:flex; justify-content: space-between; margin-bottom: 15px;">
                <span style="font-size: 13px;">Ongkir</span>
                <span style="font-size: 13px; font-weight: bold;">Rp 0 (COD Kampus)</span>
            </div>
            <div style="display:flex; justify-content: space-between; margin-bottom: 15px;">
                <span style="font-size: 16px; font-weight:bold;">Total</span>
                <span style="font-size: 18px; font-weight: bold; color: var(--primary-color);">Rp 120.000</span>
            </div>
            <a href="checkout.php" style="text-decoration:none;"><button class="btn-primary">Checkout →</button></a>
        </div>

        <div class="bottom-nav">
            <a href="dashboard.php" class="nav-item">
                <div style="font-size: 20px;">🏠</div><span>Beranda</span>
            </a>
            <a href="keranjang.php" class="nav-item" style="color: var(--primary-color);">
                <div style="font-size: 20px;">🛒</div><span>Keranjang</span>
            </a>
            <a href="profil.php" class="nav-item">
                <div style="font-size: 20px;">👤</div><span>Profil</span>
            </a>
        </div>
    </div>
</body>
</html>
