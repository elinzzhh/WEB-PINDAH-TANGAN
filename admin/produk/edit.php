<?php
session_start();
include '../../config/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query_produk = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
$data = mysqli_fetch_assoc($query_produk);

if(isset($_POST['update'])) {
    $nama = $_POST['nama_produk'];
    $kategori = $_POST['kategori_id'];
    $harga = $_POST['harga'];
    $ukuran = $_POST['ukuran'];
    $kondisi = $_POST['kondisi'];
    
    // Cek apakah ada gambar baru yang diupload
    if($_FILES['gambar']['name'] != '') {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $path = "../../uploads/produk/" . $gambar;
        move_uploaded_file($tmp, $path);
        
        $query = "UPDATE products SET kategori_id='$kategori', nama_produk='$nama', harga='$harga', ukuran='$ukuran', kondisi='$kondisi', gambar='$gambar' WHERE id=$id";
    } else {
        $query = "UPDATE products SET kategori_id='$kategori', nama_produk='$nama', harga='$harga', ukuran='$ukuran', kondisi='$kondisi' WHERE id=$id";
    }
    
    mysqli_query($conn, $query);
    echo "<script>alert('Produk berhasil diupdate!'); window.location='index.php';</script>";
}

$query_kat = mysqli_query($conn, "SELECT * FROM categories");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk - Admin</title>
    <style>
        body { font-family: sans-serif; background: #f5efe6; padding: 40px; }
        .form-container { background: white; padding: 30px; border-radius: 8px; max-width: 600px; margin: auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"], select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .btn-submit { background-color: #f39c12; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 style="margin-bottom: 20px;">Edit Produk</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" value="<?= $data['nama_produk'] ?>" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_id" required>
                    <?php while($k = mysqli_fetch_assoc($query_kat)): ?>
                        <option value="<?= $k['id'] ?>" <?= ($data['kategori_id'] == $k['id']) ? 'selected' : '' ?>><?= $k['nama_kategori'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" value="<?= $data['harga'] ?>" required>
            </div>
            <div class="form-group">
                <label>Ukuran</label>
                <input type="text" name="ukuran" value="<?= $data['ukuran'] ?>">
            </div>
            <div class="form-group">
                <label>Kondisi</label>
                <select name="kondisi" required>
                    <option value="Bekas (Layak Pakai)" <?= ($data['kondisi'] == 'Bekas (Layak Pakai)') ? 'selected' : '' ?>>Bekas (Layak Pakai)</option>
                    <option value="Baru" <?= ($data['kondisi'] == 'Baru') ? 'selected' : '' ?>>Baru</option>
                    <option value="Barter" <?= ($data['kondisi'] == 'Barter') ? 'selected' : '' ?>>Barter</option>
                </select>
            </div>
            <div class="form-group">
                <label>Gambar Produk (Biarkan kosong jika tidak diganti)</label>
                <img src="../../assets/img/produk/<?= $data['gambar'] ?>" width="100" style="margin-bottom: 10px; display:block;">
                <input type="file" name="gambar" accept="image/*">
            </div>
            <button type="submit" name="update" class="btn-submit">Update Produk</button>
            <a href="index.php" style="margin-left: 10px; color: #666; text-decoration: none;">Batal</a>
        </form>
    </div>
</body>
</html>
