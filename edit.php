<?php
include 'koneksi.php';

// Pastikan ID ada di URL sebelum memproses
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID alumni tidak valid.");
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM data_alumni WHERE id=$id"));

// Cek jika data tidak ditemukan
if (!$data) {
    die("Data alumni tidak ditemukan.");
}

// Proses Update Data
if (isset($_POST['update'])) {
    // ⚠️ Keamanan: Gunakan mysqli_real_escape_string untuk mencegah SQL Injection
    $nama = mysqli_real_escape_string($conn, $_POST['Nama']);
    $tahun_lulus = mysqli_real_escape_string($conn, $_POST['tahun_lulus']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
    $pekerjaan_saat_ini = mysqli_real_escape_string($conn, $_POST['pekerjaan_saat_ini']);
    $nomor_telpon = mysqli_real_escape_string($conn, $_POST['nomor_telpon']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    // Perbaikan: Pastikan nama kolom 'nomor_telpon' konsisten
    $sql = "UPDATE data_alumni SET
        Nama='$nama',
        tahun_lulus='$tahun_lulus',
        jurusan='$jurusan',
        pekerjaan_saat_ini='$pekerjaan_saat_ini',
        nomor_telpon='$nomor_telpon', 
        email='$email',
        alamat='$alamat'
        WHERE id=$id";
        
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('✅ Data berhasil diupdate!'); window.location.href='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('❌ Gagal mengupdate data! Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Alumni</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Data Alumni</h2>
    
    <div class="form-container">
        <form method="POST">
            <input type="text" name="Nama" placeholder="Nama" value="<?= htmlspecialchars($data['Nama']) ?>" required>
            
            <input type="number" name="tahun_lulus" placeholder="Tahun Lulus" value="<?= htmlspecialchars($data['tahun_lulus']) ?>" required>
            
            <select name="jurusan" required>
                <option value="">Jurusan</option>
                <option value="RPL" <?= $data['jurusan'] == 'RPL' ? 'selected' : '' ?>>RPL</option>
                <option value="TKJ" <?= $data['jurusan'] == 'TKJ' ? 'selected' : '' ?>>TKJ</option>
                <option value="TJAT" <?= $data['jurusan'] == 'TJAT' ? 'selected' : '' ?>>TJAT</option>
                <option value="ANIMASI" <?= $data['jurusan'] == 'ANIMASI' ? 'selected' : '' ?>>ANIMASI</option>
            </select>
            
            <input type="text" name="pekerjaan_saat_ini" placeholder="Pekerjaan Saat Ini" value="<?= htmlspecialchars($data['pekerjaan_saat_ini']) ?>" required>
            
            <input type="text" name="nomor_telpon" placeholder="Nomor Telepon" value="<?= htmlspecialchars($data['nomor_telpon']) ?>" required>
            
            <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($data['email']) ?>" required>
            
            <textarea name="alamat" placeholder="Alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea>
            
            <button type="submit" name="update">Update Data</button>
            
        </form>
    </div>
    <a href="index.php" class="form-link-action">Batal</a>
</body>
</html>