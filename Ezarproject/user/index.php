<?php
session_start();
include '../../config/koneksi.php';

// Logika Hapus User
if(isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    
    // Hapus relasi pesanan jika ada, agar tidak terjadi foreign key error
    mysqli_query($conn, "DELETE FROM orders WHERE user_id = $id");
    // Hapus user dari database
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    
    echo "<script>alert('User berhasil dihapus!'); window.location='index.php';</script>";
}

$query_user = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Admin Pindah Tangan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f5efe6;
        }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #1a3626;
            color: white;
            padding: 20px;
        }
        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 20px;
        }
        .sidebar ul {
            list-style: none;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            font-size: 15px;
        }
        .sidebar ul li a:hover, .sidebar ul li a.active {
            background-color: #2c4c3b;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
            vertical-align: middle;
        }
        th {
            background-color: #f9f9f9;
            color: #333;
        }
        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: #e8ded1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #1a3626;
        }
        .badge-role {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }
        .role-admin {
            background-color: #d4edda;
            color: #155724;
        }
        .role-mhs {
            background-color: #cce5ff;
            color: #004085;
        }
        .btn-delete {
            background-color: #e74c3c;
            padding: 6px 12px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            transition: background 0.2s;
        }
        .btn-delete:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

    <!-- Sidebar Admin -->
    <div class="sidebar">
        <h2>🛍️ Pindah Tangan</h2>
        <ul>
            <li><a href="../dashboard.php">📊 Dashboard</a></li>
            <li><a href="../produk/index.php">📦 Kelola Produk</a></li>
            <li><a href="../kategori/index.php">🏷️ Kelola Kategori</a></li>
            <li><a href="index.php" class="active">👥 Kelola User</a></li>
            <li><a href="../pesanan/index.php">🛒 Daftar Pesanan</a></li>
            <li><a href="../review/index.php">⭐ Kelola Review</a></li>
            <li style="margin-top: 30px;"><a href="../../logout.php" style="color: #ff6b6b;">🚪 Logout</a></li>
        </ul>
    </div>

    <!-- Konten Utama -->
    <div class="main-content">
        <div class="header">
            <h2>Kelola User (Mahasiswa PENS)</h2>
            <div>Administrator</div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NIM / NRP</th>
                    <th>Jumlah Posting</th>
                    <th>Peran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while($row = mysqli_fetch_assoc($query_user)): 
                    // Menentukan peran (role) secara dinamis atau default Mahasiswa
                    $role = ($row['id'] == 1) ? 'Admin' : 'Mahasiswa';
                    $role_class = ($role == 'Admin') ? 'role-admin' : 'role-mhs';
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <div class="user-avatar">
                            <?= strtoupper(substr($row['nama'], 0, 1)) ?>
                        </div>
                    </td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['nrp']) ?></td>
                    <td>0</td>
                    <td>
                        <span class="badge-role <?= $role_class ?>"><?= $role ?></span>
                    </td>
                    <td>
                        <a href="index.php?hapus=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus akun mahasiswa ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>