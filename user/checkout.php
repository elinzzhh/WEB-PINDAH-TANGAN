<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}

if(isset($_POST['buat_pesanan'])) {
    $lokasi_cod = $_POST['lokasi_cod'];
    $metode_bayar = $_POST['metode_pembayaran'];
    $total_harga = 120000; 
    

    $nomor_wa_admin = "6281234567890"; 
    $pesan = "Halo Admin Pindah Tangan,%0A";
    $pesan .= "Saya mau mengkonfirmasi pesanan thrift dengan detail:%0A";
    $pesan .= "- Pemesan: " . $_SESSION['nama'] . " (" . $_SESSION['nrp'] . ")%0A";
    $pesan .= "- Lokasi COD: " . $lokasi_cod . "%0A";
    $pesan .= "- Metode Pembayaran: " . $metode_bayar . "%0A";
    $pesan .= "- Total: Rp " . number_format($total_harga, 0, ',', '.') . "%0A%0A";
    $pesan .= "Mohon segera diproses, terima kasih.";

    $link_wa = "https://api.whatsapp.com/qr/BGMT2DRQMP3FP1?autoload=1&app_absent=0";
    

    echo "<script>window.location.href = '$link_wa';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Pindah Tangan</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .box-section { background: var(--white); padding: 15px 20px; margin-bottom: 10px; border-bottom: 1px solid #ddd; }
        .radio-group { margin-top: 10px; }
        .radio-group label { display: block; margin-bottom: 10px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="app-container">
        <div class="header" style="background: var(--white);">
            <a href="keranjang.php" style="text-decoration: none; font-size: 20px; color: var(--text-color);">← Checkout</a>
        </div>

        <form action="" method="POST">
            <div class="box-section">
                <h4 style="margin-bottom: 10px;">Detail Mahasiswa (Pembeli)</h4>
                <p style="font-weight: bold; font-size: 14px;"><?= $_SESSION['nama'] ?></p>
                <p style="font-size: 12px; color: #666;">NRP: <?= $_SESSION['nrp'] ?></p>
            </div>

            <div class="box-section">
                <h4 style="margin-bottom: 10px;">Metode Pertemuan (COD Kampus)</h4>
                <div style="background: #f9f9f9; padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
                    <select name="lokasi_cod" style="width: 100%; border: none; background: transparent; outline: none; font-size: 14px; font-weight: bold;">
                        <option value="Lobi Gedung D4 (Dekat Kantin)">📍 Lobi Gedung D4 (Dekat Kantin)</option>
                        <option value="Perpustakaan PENS">📍 Perpustakaan PENS</option>
                        <option value="Kantin Lama PENS">📍 Kantin Lama PENS</option>
                    </select>
                </div>
                <p style="font-size: 11px; color: #888; margin-top: 5px;">📅 Waktu pertemuan akan disepakati via WhatsApp</p>
            </div>

            <div class="box-section">
                <h4 style="margin-bottom: 10px;">Metode Pembayaran</h4>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="metode_pembayaran" value="Cash on Delivery (COD)" checked> Cash on Delivery (COD) <br>
                        <span style="font-size: 11px; color: #888; margin-left: 25px;">Bayar saat bertemu</span>
                    </label>
                    <label>
                        <input type="radio" name="metode_pembayaran" value="Barter"> Barter <br>
                        <span style="font-size: 11px; color: #888; margin-left: 25px;">Tukar barang sesuai kesepakatan</span>
                    </label>
                    <label>
                        <input type="radio" name="metode_pembayaran" value="E-Wallet"> E-Wallet (Gopay/Dana/Shopeepay)
                    </label>
                </div>
            </div>

            <div style="padding: 20px;">
                <p style="font-size: 13px; text-align: center; margin-bottom: 15px; color: #666;">
                    Menekan tombol di bawah akan mengarahkan Anda untuk mengirim pesan ke admin via WhatsApp.
                </p>
                <button type="submit" name="buat_pesanan" class="btn-primary" style="background-color: var(--primary-color);">
                    Konfirmasi & Hubungi Penjual (WA)
                </button>
            </div>
        </form>
    </div>
</body>
</html>
