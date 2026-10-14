<?php
session_start();
include '../../config/koneksi.php';

if(isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $kategori = (int)$_POST['kategori_id'];
    $harga = (int)$_POST['harga'];
    $ukuran = mysqli_real_escape_string($conn, $_POST['ukuran']);
    $kondisi = mysqli_real_escape_string($conn, $_POST['kondisi']);
    
    // Proses Upload Gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    
    if(!empty($gambar)) {
        $ext = pathinfo($gambar, PATHINFO_EXTENSION);
        $nama_gambar_baru = uniqid('prod_') . '.' . $ext;
        $path = "../../uploads/produk/" . $nama_gambar_baru;
        
        if(move_uploaded_file($tmp, $path)) {
            $query = "INSERT INTO products (kategori_id, nama_produk, harga, ukuran, kondisi, gambar) 
                      VALUES ('$kategori', '$nama', '$harga', '$ukuran', '$kondisi', '$nama_gambar_baru')";
            mysqli_query($conn, $query);
            echo "<script>alert('Produk berhasil ditambahkan!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal mengupload gambar!');</script>";
        }
    } else {
        $query = "INSERT INTO products (kategori_id, nama_produk, harga, ukuran, kondisi, gambar) 
                  VALUES ('$kategori', '$nama', '$harga', '$ukuran', '$kondisi', '')";
        mysqli_query($conn, $query);
        echo "<script>alert('Produk berhasil ditambahkan tanpa gambar!'); window.location='index.php';</script>";
    }
}

$query_kat = mysqli_query($conn, "SELECT * FROM categories");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk - Admin Pindah Tangan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background: #f5efe6; padding: 40px; }
        .form-container { background: white; padding: 30px; border-radius: 8px; max-width: 600px; margin: auto; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        input[type="text"], input[type="number"], select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; }
        input[type="file"] { margin-top: 5px; }
        .btn-submit { background-color: #1a3626; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-cancel { margin-left: 10px; color: #666; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 style="margin-bottom: 20px; color: #1a3626;">Tambah Produk Baru</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" placeholder="Contoh: Buku Kalkulus / Jas Lab" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_id" required>
                    <option value="">Pilih Kategori</option>
                    <?php while($k = mysqli_fetch_assoc($query_kat)): ?>
                        <option value="<?= $k['id'] ?>"><?= $k['nama_kategori'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Harga (Isi 0 jika Hibah/Barter)</label>
                <input type="number" name="harga" placeholder="Contoh: 45000" required>
            </div>
            <div class="form-group">
                <label>Ukuran (Opsional)</label>
                <input type="text" name="ukuran" placeholder="Contoh: L / All Size / -">
            </div>
            <div class="form-group">
                <label>Kondisi</label>
                <select name="kondisi" required>
                    <option value="Bekas (Layak Pakai)">Bekas (Layak Pakai)</option>
                    <option value="Baru">Baru</option>
                    <option value="Barter">Barter</option>
                </select>
            </div>
            <div class="form-group">
                <label>Gambar Produk</label>
                <input type="file" name="gambar" accept="image/*" required>
            </div>
            <button type="submit" name="simpan" class="btn-submit">Simpan Produk</button>
            <a href="index.php" class="btn-cancel">Batal</a>
        </form>
    </div>
</body>
</html>