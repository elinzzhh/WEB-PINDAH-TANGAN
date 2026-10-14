<?php
session_start();
include '../../config/koneksi.php';

// Logika Hapus Kategori
if(isset($_GET['hapus'])) {
    $id_hapus = (int)$_GET['hapus'];
    mysqli_query($conn, "DELETE FROM categories WHERE id = $id_hapus");
    echo "<script>alert('Kategori dihapus!'); window.location='index.php';</script>";
}

// Menghitung jumlah produk per kategori menggunakan LEFT JOIN
$query_kat = mysqli_query($conn, "SELECT c.id, c.nama_kategori, COUNT(p.id) as jumlah_barang FROM categories c LEFT JOIN products p ON c.id = p.kategori_id GROUP BY c.id");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kategori - Admin Pindah Tangan</title>
    <style>
        /* Menggunakan style yang sama dengan Admin Produk */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { display: flex; min-height: 100vh; background-color: #f5efe6; }
        .sidebar { width: 250px; background-color: #1a3626; color: white; padding: 20px; }
        .sidebar ul { list-style: none; margin-top: 30px; }
        .sidebar ul li a { color: white; text-decoration: none; display: block; padding: 10px; border-radius: 5px; margin-bottom: 10px;}
        .sidebar ul li a:hover, .sidebar ul li a.active { background-color: #2c4c3b; }
        .main-content { flex: 1; padding: 30px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn-add { background-color: #1a3626; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f9f9f9; }
        .action-btn { text-decoration: none; padding: 5px 10px; border-radius: 4px; font-size: 12px; margin-right: 5px; color: white; }
        .btn-edit { background-color: #f39c12; }
        .btn-delete { background-color: #e74c3c; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>🛍️ Pindah Tangan</h2>
        <ul>
            <li><a href="../dashboard.php">📊 Dashboard</a></li>
            <li><a href="../produk/index.php">📦 Kelola Produk</a></li>
            <li><a href="index.php" class="active">🏷️ Kelola Kategori</a></li>
            <li><a href="../user/index.php">👥 Kelola User</a></li>
            <li><a href="../pesanan/index.php">🛒 Daftar Pesanan</a></li>
            <li><a href="../../logout.php" style="color: #ff6b6b;">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h2>Kelola Kategori</h2>
            <a href="tambah.php" class="btn-add">+ Tambah Kategori</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Jumlah Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while($row = mysqli_fetch_assoc($query_kat)): 
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_kategori'] ?></td>
                    <td><?= $row['jumlah_barang'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="action-btn btn-edit">Edit</a>
                        <a href="index.php?hapus=<?= $row['id'] ?>" class="action-btn btn-delete" onclick="return confirm('Hapus kategori ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>