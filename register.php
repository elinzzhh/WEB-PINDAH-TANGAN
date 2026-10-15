<?php
session_start();
include 'config/koneksi.php';

if(isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nrp = mysqli_real_escape_string($conn, $_POST['nrp']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE nrp = '$nrp'");
    if(mysqli_num_rows($cek) > 0) {
        $error = "NRP sudah terdaftar!";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO users (nama, nrp, password) VALUES ('$nama', '$nrp', '$password')");
        if($insert) {
            echo "<script>alert('Registrasi Berhasil! Silakan Login.'); window.location='login.php';</script>";
        } else {
            $error = "Registrasi gagal!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pindah Tangan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="app-container">
        <div class="auth-container">
            <h2>Pindah Tangan</h2>
            <p>Daftar Akun Baru Mahasiswa PENS</p>

            <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

            <form action="" method="POST" style="width: 100%;">
                <div class="form-group">
                    <input type="text" name="nama" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                    <input type="text" name="nrp" placeholder="Masukkan NRP" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Kampus (@student.pens.ac.id)" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Kata Sandi" required>
                </div>
                <button type="submit" name="register" class="btn-primary">Daftar</button>
            </form>
            
            <p style="margin-top: 20px;">Sudah punya akun? <a href="login.php" style="color: var(--primary-color);">Login di sini</a></p>
        </div>
    </div>
</body>
</html>
