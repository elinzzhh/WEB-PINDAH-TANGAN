<?php
session_start();
include '../config/koneksi.php';

// Simulasi proteksi sederhana admin
// if(!isset($_SESSION['admin_id'])) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Pindah Tangan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; min-height: 100vh; background-color: #f5efe6; }
        
        /* Sidebar Styles */
        .sidebar { width: 250px; background-color: #1a3626; color: white; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; font-size: 20px; display: flex; align-items: center; gap: 10px;}
        .sidebar ul { list-style: none; }
        .sidebar ul li { margin-bottom: 10px; }
        .sidebar ul li a { color: white; text-decoration: none; display: block; padding: 10px; border-radius: 5px; font-size: 15px;}
        .sidebar ul li a:hover, .sidebar ul li a.active { background-color: #2c4c3b; }
        
        /* Main Content Styles */
        .main-content { flex: 1; padding: 30px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        
        /* Card Stats */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .stat-card h3 { font-size: 14px; color: #666; margin-bottom: 10px; }
        .stat-card p { font-size: 24px; font-weight: bold; color: #1a3626; }
        
        /* Chart Placeholder */
        .chart-container { background: white; padding: 20px; border-radius: 10px; height: 300px; display: flex; align-items: center; justify-content: center; color: #888; border: 1px dashed #ccc;}
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>🛍️ Pindah Tangan</h2>
        <ul>
            <li><a href="dashboard.php" class="active">📊 Dashboard</a></li>
            <li><a href="produk/index.php">📦 Kelola Produk</a></li>
            <li><a href="kategori/index.php">🏷️ Kelola Kategori</a></li>
            <li><a href="user/index.php">👥 Kelola User</a></li>
            <li><a href="pesanan/index.php">🛒 Daftar Pesanan</a></li>
            <li><a href="review/index.php">⭐ Kelola Review</a></li>
            <li style="margin-top: 30px;"><a href="../logout.php" style="color: #ff6b6b;">🚪 Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h2>Dashboard</h2>
            <div>Admin PENS</div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Produk</h3>
                <p>120</p>
            </div>
            <div class="stat-card">
                <h3>Total Pesanan/COD</h3>
                <p>48</p>
            </div>
            <div class="stat-card">
                <h3>Total User</h3>
                <p>32</p>
            </div>
            <div class="stat-card">
                <h3>Barang Ditukar (Barter)</h3>
                <p>15</p>
            </div>
        </div>

        <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
            <h3 style="margin-bottom: 15px;">Tren Transaksi Bulanan</h3>
            <div class="chart-container">
                [ Grafik Garis (Line Chart) Transaksi akan dirender di sini menggunakan Chart.js ]
            </div>
        </div>
    </div>

</body>
</html>