<?php
include 'koneksi.php';

// Pastikan ada parameter id
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hapus data
    mysqli_query($conn, "DELETE FROM data_alumni WHERE id = $id");

    // Menyusun ulang ID agar urut lagi dari 1
    mysqli_query($conn, "SET @num := 0");
    mysqli_query($conn, "UPDATE data_alumni SET id = @num := @num + 1 ORDER BY id");

    // Reset auto increment agar lanjut dari ID terakhir
    mysqli_query($conn, "ALTER TABLE data_alumni AUTO_INCREMENT = 1");
}

// Kembali ke halaman utama
header("Location: index.php");
exit;