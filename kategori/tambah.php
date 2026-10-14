<?php
session_start();
include '../../config/koneksi.php';

if(isset($_POST['simpan'])) {
    $nama_kategori = $_POST['nama_kategori'];
    $slug = strtolower(str_replace(' ', '-', $nama_kategori)); // Membuat slug otomatis
    
    $query = "INSERT INTO categories (nama_kategori, slug) VALUES ('$nama_kategori', '$slug')";
    mysqli_query($conn, $query);
    echo "<script>alert('Kategori ditambahkan!'); window.location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
    <style>
        body { font-family: sans-serif; background: #f5efe6; padding: 40px; }
        .form-container { background: white; padding: 30px; border-radius: 8px; max-width: 400px; margin: auto; }
        input[type="text"] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; }
        .btn-submit { background-color: #1a3626; color: white; padding: 10px 20px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah Kategori</h2>
        <form action="" method="POST">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" required>
            <button type="submit" name="simpan" class="btn-submit">Simpan</button>
            <a href="index.php" style="margin-left: 10px; color: #666; text-decoration: none;">Batal</a>
        </form>
    </div>
</body>
</html>