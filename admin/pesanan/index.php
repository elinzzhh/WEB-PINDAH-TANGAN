<?php
// Panggil koneksi database (naik 2 tingkat ke folder utama)
include '../../config/koneksi.php';

// Ambil data pesanan dari database
$query = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Data Pesanan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Manajemen Data Pesanan</h4>
                        <a href="../dashboard.php" class="btn btn-light btn-sm">Kembali ke Dashboard</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">No</th>
                                    <th>Nama Pemesan</th>
                                    <th>No. Telepon</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                if($query && mysqli_num_rows($query) > 0) {
                                    while($row = mysqli_fetch_assoc($query)) { 
                                        // Badge warna berdasarkan status
                                        $status = $row['status'];
                                        $badge = 'bg-secondary';
                                        if($status == 'Pending') $badge = 'bg-warning text-dark';
                                        elseif($status == 'Diproses') $badge = 'bg-info text-dark';
                                        elseif($status == 'Selesai') $badge = 'bg-success';
                                        elseif($status == 'Dibatalkan') $badge = 'bg-danger';
                                ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['nama_pemesan']); ?></td>
                                    <td><?= htmlspecialchars($row['no_telepon']); ?></td>
                                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                    <td class="text-center">
                                        <span class="badge <?= $badge; ?>"><?= $status; ?></span>
                                    </td>
                                    <td class="text-center"><?= $row['tanggal']; ?></td>
                                    <td class="text-center">
                                        <a href="ubah_status.php?id=<?= $row['id']; ?>" class="btn btn-info btn-sm">Status</a>
                                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Hapus</a>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada data pesanan.</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>