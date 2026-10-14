<?php
session_start();
include '../../config/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = mysqli_query($conn, "SELECT * FROM categories WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if(!$data) {
    echo "<script>alert('Kategori tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

if(isset($_POST['update'])) {
    $nama_kategori = mysqli_real_escape_string($conn, $_POST['nama_kategori']);
    $slug = strtolower(str_replace(' ', '-', $nama_kategori)); // Update slug otomatis
    
    $update_query = "UPDATE categories SET nama_kategori = '$nama_kategori', slug = '$slug' WHERE id = $id";
    mysqli_query($conn, $update_query);
    echo "<script>alert('Kategori berhasil diupdate!'); window.location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori - Admin Pindah Tangan</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background: #f5efe6; padding: 40px; }
        .form-container { background: white; padding: 30px; border-radius: 8px; max-width: 400px; margin: auto; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; }
        .btn-submit { background-color: #f39c12; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-cancel { margin-left: 10px; color: #666; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 style="margin-bottom: 20px; color: #1a3626;">Edit Kategori</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" value="<?= htmlspecialchars($data['nama_kategori']) ?>" required>
            </div>
            <button type="submit" name="update" class="btn-submit">Update Kategori</button>
            <a href="index.php" class="btn-cancel">Batal</a>
        </form>
    </div>
</body>
</html>