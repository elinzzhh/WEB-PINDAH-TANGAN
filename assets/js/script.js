document.addEventListener("DOMContentLoaded", function() {
    
    // 1. Logika Tombol Plus & Minus Kuantitas (Halaman Detail Produk)
    const btnMinus = document.querySelector('.btn-minus');
    const btnPlus = document.querySelector('.btn-plus');
    const inputQty = document.querySelector('.input-qty');

    if (btnMinus && btnPlus && inputQty) {
        btnMinus.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah reload halaman
            let currentValue = parseInt(inputQty.value);
            if (currentValue > 1) {
                inputQty.value = currentValue - 1;
            }
        });

        btnPlus.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah reload halaman
            let currentValue = parseInt(inputQty.value);
            // Anda bisa menambahkan batas maksimal stok di sini jika ada (misal: if currentValue < stok)
            inputQty.value = currentValue + 1;
        });
        
        // Mencegah input nilai negatif atau huruf secara manual
        inputQty.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value === '' || parseInt(this.value) < 1) {
                this.value = 1;
            }
        });
    }

    // 2. Logika Preview Gambar (Halaman Admin: Tambah & Edit Produk)
    const inputGambar = document.querySelector('input[type="file"][name="gambar"]');
    const imgPreview = document.querySelector('.img-preview'); // Pastikan Anda menambahkan class ini di tag <img> preview

    if (inputGambar && imgPreview) {
        inputGambar.addEventListener('change', function() {
            const file = this.files[0];
            
            if (file) {
                // Membaca file yang diupload dan menampilkannya sebagai preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    imgPreview.setAttribute('src', e.target.result);
                    imgPreview.style.display = 'block'; // Tampilkan gambar jika sebelumnya disembunyikan
                }
                reader.readAsDataURL(file);
            } else {
                // Jika file dibatalkan, kembalikan ke gambar default
                imgPreview.setAttribute('src', '../../assets/img/produk/default.jpg');
            }
        });
    }

    // 3. Auto-hide Alert Messages (Menyembunyikan notifikasi setelah 3 detik)
    // Berlaku jika Anda menggunakan elemen alert di HTML, bukan alert() bawaan browser
    const alertBox = document.querySelector('.alert-message');
    if (alertBox) {
        setTimeout(() => {
            alertBox.style.transition = "opacity 0.5s ease";
            alertBox.style.opacity = "0";
            setTimeout(() => alertBox.remove(), 500);
        }, 3000);
    }
});
