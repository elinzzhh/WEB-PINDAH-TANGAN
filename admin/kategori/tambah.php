<?php
// Panggil koneksi database (naik 2 tingkat ke folder utama)
include '../../config/koneksi.php';

// Jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $nama_kategori = mysqli_real_escape_string($conn, $_POST['nama_kategori']);

    // Insert data ke database
    $query = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Data kategori berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data kategori!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - Admin</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Data Kategori</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">Kembali</a>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan Kategori</button>
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