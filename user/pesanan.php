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
    <title>Pesanan Saya - Pindah Tangan</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .tabs { display: flex; justify-content: space-around; background: var(--white); padding: 10px 0; border-bottom: 1px solid #ddd; }
        .tab { font-size: 14px; font-weight: bold; color: #888; text-decoration: none; padding: 5px 15px; }
        .tab.active { color: var(--white); background: var(--primary-color); border-radius: 20px; }
        .pesanan-card { background: var(--white); padding: 15px; margin-bottom: 10px; border-bottom: 1px solid #eee; display: flex; align-items: center; justify-content: space-between; }
        .status-badge { font-size: 10px; padding: 3px 8px; border-radius: 10px; font-weight: bold; }
        .status-menunggu { background: #fff3cd; color: #856404; }
        .status-selesai { background: #d4edda; color: #155724; }
    </style>
</head>
<body>
    <div class="app-container">
        <div class="header" style="background: var(--white); padding-bottom: 5px;">
            <a href="dashboard.php" style="text-decoration: none; font-size: 20px; color: var(--text-color);">← Pesanan Saya</a>
        </div>

        <div class="tabs">
            <a href="#" class="tab active">Aktif</a>
            <a href="#" class="tab">Selesai</a>
            <a href="#" class="tab">Dibatalkan</a>
        </div>

        <div class="pesanan-card">
            <div style="display:flex; gap: 15px; align-items: center;">
                <div style="width: 50px; height: 50px; background: #ddd; border-radius: 8px;"></div>
                <div>
                    <h5 style="font-size: 14px;">Buku Kalkulus</h5>
                    <p style="color: var(--primary-color); font-weight: bold; font-size: 13px;">Rp 45.000</p>
                    <p style="font-size: 11px; color: #666;">Tenggat transaksi: Hari ini</p>
                </div>
            </div>
            <div style="text-align: right;">
                <span class="status-badge status-menunggu">Menunggu COD</span><br>
                <button style="margin-top: 10px; padding: 5px 10px; background: var(--primary-color); color: white; border: none; border-radius: 5px; font-size: 11px;">Detail</button>
            </div>

        <div class="bottom-nav">
            <a href="dashboard.php" class="nav-item"><div style="font-size: 20px;">🏠</div><span>Beranda</span></a>
            <a href="produk.php" class="nav-item"><div style="font-size: 20px;">📦</div><span>Kategori</span></a>
            <a href="keranjang.php" class="nav-item"><div style="font-size: 20px;">🛒</div><span>Keranjang</span></a>
            <a href="profil.php" class="nav-item"><div style="font-size: 20px;">👤</div><span>Profil</span></a>
        </div>
    </div>
</body>
</html>
