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

// Ambil data kategori berdasarkan ID dari database
$query = mysqli_query($conn, "SELECT * FROM kategori WHERE id = $id");
$kategori = mysqli_fetch_assoc($query);

// Jika kategori tidak ditemukan
if (!$kategori) {
    echo "<script>alert('Kategori tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

// Proses jika tombol Simpan Perubahan ditekan
if (isset($_POST['update'])) {
    // Menyesuaikan dengan nama kolom di database (nama_kategori atau nama)
    $nama_kolom = array_key_exists('nama_kategori', $kategori) ? 'nama_kategori' : 'nama';
    $nama_kategori = mysqli_real_escape_string($conn, $_POST['nama_kategori']);

    // Update data ke tabel 'kategori' di database
    $update = mysqli_query($conn, "UPDATE kategori SET $nama_kolom = '$nama_kategori' WHERE id = $id");

    if ($update) {
        echo "<script>alert('Kategori berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui kategori!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori - Admin Pindah Tangan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Data Kategori</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= htmlspecialchars($kategori['nama_kategori'] ?? $kategori['nama']); ?>" required>
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