<?php
session_start();
include '../../config/koneksi.php';

// Jika admin sudah login, langsung arahkan ke dashboard
if(isset($_SESSION['admin_logged'])) {
    header("Location: dashboard.php");
    exit;
}

if(isset($_POST['login_admin'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Validasi login admin (Bisa disesuaikan dengan database jika Anda membuat tabel khusus admin)
    // Default kredensial admin: username = admin, password = admin123
    if($username == 'admin' && $password == 'admin123') {
        $_SESSION['admin_logged'] = true;
        $_SESSION['admin_user'] = 'Administrator PENS';
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau Password Admin salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Pindah Tangan PENS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f5efe6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-card h2 {
            color: #1a3626;
            margin-bottom: 5px;
        }
        .login-card p {
            font-size: 13px;
            color: #666;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: bold;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }
        .form-group input:focus {
            border-color: #1a3626;
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #1a3626;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-login:hover {
            background-color: #2c4c3b;
        }
        .error-msg {
            color: #e74c3c;
            font-size: 13px;
            margin-bottom: 15px;
            background: #fde8e8;
            padding: 10px;
            border-radius: 6px;
        }
        .back-link {
            margin-top: 20px;
            display: block;
            font-size: 12px;
            color: #666;
            text-decoration: none;
        }
        .back-link:hover {
            color: #1a3626;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>🛍️ Pindah Tangan</h2>
        <p>Panel Login Administrator Kampus PENS</p>

        <?php if(isset($error)) echo "<div class='error-msg'>$error</div>"; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Username Admin</label>
                <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Kata Sandi</label>
                <input type="password" name="password" placeholder="Masukkan kata sandi" required>
            </div>
            <button type="submit" name="login_admin" class="btn-login">Masuk Dashboard</button>
        </form>

        <a href="../login.php" class="back-link">← Kembali ke Halaman Login Mahasiswa</a>
    </div>

</body>
</html>