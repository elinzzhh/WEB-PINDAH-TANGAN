<?php
session_start();
include '../../config/koneksi.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    
    $id_order = (int)$_GET['id'];
    $status_baru = mysqli_real_escape_string($conn, $_GET['status']);
    
    $status_diizinkan = ['Menunggu', 'Selesai', 'Dibatalkan'];
    
    if (in_array($status_baru, $status_diizinkan)) {
        
        $query_update = "UPDATE orders SET status = '$status_baru' WHERE id = $id_order";
        
        $eksekusi = mysqli_query($conn, $query_update);
        
        if ($eksekusi) {
            echo "<script>
                    alert('Status pesanan berhasil diperbarui menjadi: $status_baru');
                    window.location.href = 'index.php';
                  </script>";
        } else {
   
            echo "<script>
                    alert('Gagal memperbarui status pesanan! Error: " . mysqli_error($conn) . "');
                    window.location.href = 'index.php';
                  </script>";
        }
        
    } else {
        echo "<script>
                alert('Status tidak valid atau tidak dikenali.');
                window.location.href = 'index.php';
              </script>";
    }
    
} else {
    header("Location: index.php");
    exit;
}
?>