<?php

include '../../config/koneksi.php'; 
$query = mysqli_query($conn, "SELECT * FROM produk");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk - Pindah Tangan PENS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Manajemen Data Produk</h4>
                        <a href="tambah.php" class="btn btn-light btn-sm">+ Tambah Produk</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                if($query && mysqli_num_rows($query) > 0) {
                                    while($row = mysqli_fetch_assoc($query)) { 
                                ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['nama_produk']); ?></td>
                                    <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                    <td class="text-center"><?= $row['stok']; ?></td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada data produk atau tabel belum dibuat.</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>