<?php
session_start();
// Naik 2 tingkat ke root lalu masuk ke config/koneksi.php
include '../../config/koneksi.php';

// Pastikan parameter ID ada di URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];

// Ambil data produk berdasarkan ID dari database
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($query);

// Jika produk tidak ditemukan
if (!$produk) {
    echo "<script>alert('Produk tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

// Ambil data kategori untuk pilihan dropdown
$query_kategori = mysqli_query($conn, "SELECT * FROM kategori");

// Proses jika tombol Simpan Perubahan ditekan
if (isset($_POST['update'])) {
    $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $kategori_id = mysqli_real_escape_string($conn, $_POST['kategori_id']);
    $harga       = mysqli_real_escape_string($conn, $_POST['harga']);
    $stok        = mysqli_real_escape_string($conn, $_POST['stok']);
    $deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    
    $gambar_lama = $produk['gambar'];
    $nama_gambar = $gambar_lama;

    // Cek apakah ada file gambar baru yang di-upload
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $file_tmp   = $_FILES['gambar']['tmp_name'];
        $file_name  = $_FILES['gambar']['name'];
        $ekstensi   = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $ekstensi_valid = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($ekstensi, $ekstensi_valid)) {
            $nama_gambar = time() . '_' . $file_name;
            $folder_tujuan = '../../assets/img/';

            // Pindahkan file gambar baru ke folder assets/img/
            if (move_uploaded_file($file_tmp, $folder_tujuan . $nama_gambar)) {
                // Hapus gambar lama dari folder jika ada
                if (!empty($gambar_lama) && file_exists($folder_tujuan . $gambar_lama)) {
                    unlink($folder_tujuan . $gambar_lama);
                }
            }
        }
    }

    // Update data ke tabel 'produk' di database
    $update = mysqli_query($conn, "UPDATE produk SET 
                nama_produk = '$nama_produk', 
                kategori_id = '$kategori_id', 
                harga = '$harga', 
                stok = '$stok', 
                deskripsi = '$deskripsi', 
                gambar = '$nama_gambar' 
              WHERE id = $id");

    if ($update) {
        echo "<script>alert('Produk berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Admin Pindah Tangan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Data Produk</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= htmlspecialchars($produk['nama_produk']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori_id" name="kategori_id" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php while($kat = mysqli_fetch_assoc($query_kategori)): ?>
                                        <option value="<?= $kat['id']; ?>" <?= ($produk['kategori_id'] == $kat['id']) ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($kat['nama_kategori'] ?? $kat['nama']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="harga" class="form-label">Harga (Rp)</label>
                                    <input type="number" class="form-control" id="harga" name="harga" value="<?= $produk['harga']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok" value="<?= $produk['stok']; ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required><?= htmlspecialchars($produk['deskripsi']); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar Produk</label>
                                <div class="mb-2">
                                    <?php if(!empty($produk['gambar'])): ?>
                                        <img src="../../assets/img/<?= $produk['gambar']; ?>" alt="Preview" width="120" class="img-thumbnail">
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada gambar saat ini</span>
                                    <?php endif; ?>
                                </div>
                                <input type="file" class="form-control" id="gambar" name="gambar">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar produk.</small>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">Kembali</a>
                                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
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