<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}

$metode = isset($_GET['metode']) ?$_GET['metode'] : 'Cash on Delivery (COD)';
$lokasi = isset($_GET['lokasi']) ? $_GET['lokasi'] : 'Lobi Gedung D4 (Dekat Kantin)';$total = isset($_GET['total']) ? (int)$_GET['total'] : 120000;
$barter_item = isset($_GET['barter']) ?$_GET['barter'] : '';

$nomor_wa_admin = "6281234567890"; 
$pesan = "Halo Admin Pindah Tangan,%0A";
$pesan .= "Saya ingin menyelesaikan pesanan saya:%0A";
$pesan .= "- Nama: " . $_SESSION['nama'] . " (" . $_SESSION['nrp'] . ")%0A";
$pesan .= "- Lokasi COD: " . $lokasi . "%0A";
$pesan .= "- Metode: " . $metode . "%0A";
if($metode == 'Barter') {$pesan .= "- Barang Barter: " . $barter_item . "%0A";
} else {
    $pesan .= "- Total Tagihan: Rp " . number_format($total, 0, ',', '.') . "%0A";
}
$pesan .= "%0AMohon info jadwal pertemuannya. Terima kasih.";

$link_wa = "https://api.whatsapp.com/send?phone=$nomor_wa_admin&text=$pesan";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran & COD - Pindah Tangan</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .payment-box {
            background-color: var(--white);
            margin: 20px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            text-align: center;
        }
        .total-amount {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
            margin: 10px 0;
        }
        .instruction-box {
            background-color: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            text-align: left;
        }
        .instruction-box h4 {
            margin-bottom: 10px;
            color: var(--primary-color);
        }
        .instruction-box p {
            font-size: 13px;
            color: #555;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <div class="header" style="background: var(--white);">
            <a href="checkout.php" style="text-decoration: none; font-size: 20px; color: var(--text-color);">← Pembayaran & COD</a>
        </div>

        <div class="payment-box">
            <p style="font-size: 14px; color: #666;">Total yang harus dibayar/ditukar</p>
            
            <?php if($metode == 'Barter'): ?>
                <div class="total-amount">Barter Barang</div>
                <p style="font-size: 14px; font-weight:bold;">Ditukar dengan: <?= $barter_item ?: 'Menunggu Kesepakatan' ?></p>
            <?php else: ?>
                <div class="total-amount">Rp <?= number_format($total, 0, ',', '.') ?></div>
                <p style="font-size: 12px; color: #888;">(Tanpa Ongkos Kirim)</p>
            <?php endif; ?>
            
            <div class="instruction-box">
                <h4>Instruksi <?= $metode ?></h4>
                <?php if($metode == 'Barter'): ?>
                    <p>1. Silakan klik tombol di bawah untuk menghubungi admin via WhatsApp.</p>
                    <p>2. Kirimkan foto barang yang ingin Anda barter kepada admin.</p>
                    <p>3. Jika sepakat, temui penjual di <b><?= $lokasi ?></b> untuk menukar barang.</p>
                <?php else: ?>
                    <p>1. Silakan hubungi penjual via WhatsApp melalui tombol di bawah.</p>
                    <p>2. Sepakati jam pertemuan dengan penjual.</p>
                    <p>3. Temui penjual di <b><?= $lokasi ?></b>.</p>
                    <p>4. Lakukan pengecekan barang dan bayar langsung (Cash) kepada penjual.</p>
                <?php endif; ?>
            </div>
        </div>

        <div style="padding: 20px; position: absolute; bottom: 0; width: 100%; box-sizing: border-box;">
            <a href="<?= $link_wa ?>" target="_blank" style="text-decoration: none;">
                <button class="btn-primary" style="
