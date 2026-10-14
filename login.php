<?php
session_start();
include 'config/koneksi.php';

if(isset($_POST['login'])) {
    $nrp = mysqli_real_escape_string($conn, $_POST['nrp']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE nrp = '$nrp'");
    if(mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        if(password_verify($password, $data['password'])) {
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['nrp'] = $data['nrp'];
            header("Location: user/dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "NRP/NIM tidak terdaftar!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pindah Tangan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="app-container">
        <div class="auth-container">
            <h2 style="margin-top: 50px;">Pindah Tangan</h2>
            <p>Masuk ke Akun Kampus Anda</p>
            
            <button class="btn-google">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" width="20" style="margin-right: 10px;">
                Masuk dengan akun @student.pens.ac.id
            </button>
            <p>atau masuk dengan NIM</p>

            <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

            <form action="" method="POST" style="width: 100%;">
                <div class="form-group">
                    <input type="text" name="nrp" placeholder="NIM / NRP Mahasiswa" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Kata Sandi" required>
                </div>
                <button type="submit" name="login" class="btn-primary">Login</button>
            </form>

            <p style="margin-top: 20px;">Belum punya akun? <a href="register.php" style="color: var(--primary-color);">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>
