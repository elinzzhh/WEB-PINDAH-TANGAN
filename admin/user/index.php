<?php
// Panggil koneksi database (naik 2 tingkat ke root lalu ke config/koneksi.php)
include '../../config/koneksi.php';

// Ambil data user dari database
$query = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen User</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Manajemen Data Pengguna (User)</h4>
                        <a href="../dashboard.php" class="btn btn-light btn-sm">Kembali ke Dashboard</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Tanggal Daftar</th>
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
    <td><?= htmlspecialchars($row['nama'] ?? '-'); ?></td>
    <td><?= htmlspecialchars($row['email'] ?? 'Tidak ada email'); ?></td>
    <td class="text-center"><?= isset($row['tanggal_daftar']) ? $row['tanggal_daftar'] : '-'; ?></td>
    <td class="text-center">
        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
    </td>
</tr>
                                <?php 
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada user yang terdaftar.</td>
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