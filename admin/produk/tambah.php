<?php
// Panggil koneksi database (naik 2 tingkat ke folder utama)
include '../../config/koneksi.php';

// Ambil data kategori untuk pilihan dropdown
$query_kategori = mysqli_query($conn, "SELECT * FROM kategori");

// Jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $kategori_id = mysqli_real_escape_string($conn, $_POST['kategori_id']);
    $harga       = mysqli_real_escape_string($conn, $_POST['harga']);
    $stok        = mysqli_real_escape_string($conn, $_POST['stok']);
    $deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    // Proses Upload Gambar
    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    
    $gambar_db = "";

    if (!empty($nama_file)) {
        $ekstensi_diizinkan = array('png', 'jpg', 'jpeg', 'webp');
        $x = explode('.', $nama_file);
        $ekstensi = strtolower(end($x));
        
        if (in_array($ekstensi, $ekstensi_diizinkan) === true) {
            $gambar_db = time() . '_' . $nama_file;
            $folder_tujuan = "../../assets/img/";
    
            if (!is_dir($folder_tujuan)) {
                mkdir($folder_tujuan, 0777, true);
            }

            move_uploaded_file($tmp_file, $folder_tujuan . $gambar_db);
        } else {
            echo "<script>alert('Ekstensi gambar harus png, jpg, jpeg, atau webp!'); window.location='tambah.php';</script>";
            exit;
        }
    }

    $query = "INSERT INTO produk (nama_produk, kategori_id, harga, stok, deskripsi, gambar) 
              VALUES ('$nama_produk', '$kategori_id', '$harga', '$stok', '$deskripsi', '$gambar_db')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Data produk berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data produk!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Admin</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Data Produk</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                            </div>

                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori_id" name="kategori_id" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php while($kat = mysqli_fetch_assoc($query_kategori)): ?>
                                        <option value="<?= $kat['id']; ?>"><?= htmlspecialchars($kat['nama_kategori'] ?? $kat['nama']); ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="harga" class="form-label">Harga (Rp)</label>
                                    <input type="number" class="form-control" id="harga" name="harga" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="gambar" class="form-label">Foto Produk</label>
                                <input type="file" class="form-control" id="gambar" name="gambar">
                                <div class="form-text">Format yang diizinkan: JPG, JPEG, PNG, WEBP.</div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">Kembali</a>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan Produk</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>