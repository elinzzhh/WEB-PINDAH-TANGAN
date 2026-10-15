<?php
include '../../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM pesanan WHERE id = '$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $status = $_POST['status'];
    $update = mysqli_query($conn, "UPDATE pesanan SET status = '$status' WHERE id = '$id'");

    if ($update) {
        echo "<script>alert('Status pesanan berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui status!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Status Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Ubah Status Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nama Pemesan</label>
                                <input type="text" class="form-control" value="<?= $row['nama_pemesan']; ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Pesanan</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="Pending" <?= ($row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Diproses" <?= ($row['status'] == 'Diproses') ? 'selected' : ''; ?>>Diproses</option>
                                    <option value="Selesai" <?= ($row['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                                    <option value="Dibatalkan" <?= ($row['status'] == 'Dibatalkan') ? 'selected' : ''; ?>>Dibatalkan</option>
                                </select>
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
</body>
</html>