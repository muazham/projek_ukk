<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Tambah Alumni</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Tambah Data Alumni</h2>
    <div class="form-container">
    <form method="POST">
   
        <input type="text" name="Nama" placeholder="Nama" required>
        <input type="date" name="tahun lulus" placeholder="Tahun Lulus" required>
        <select name="jurusan" required>
    <option value="">Jurusan</option>
    <option value="RPL">RPL</option>
    <option value="TKJ">TKJ</option>
    <option value="TJAT">TJAT</option>
    <option value="ANIMASI">ANIMASI</option>
    </select>
        <input type="text" name="pekerjaan saat ini" placeholder="Pekerjaan Saat Ini" required>
        <input type="text" name="nomor telepon" placeholder="nomor_telepon">
        <input type="text" name="email" placeholder="email">
        <textarea name="alamat" placeholder="alamat" required></textarea>
        </select>
        <button type="submit" name="submit">Simpan</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $Nama = $_POST['Nama'];
        $tahun_lulus = $_POST['tahun_lulus'];
$jurusan = $_POST['jurusan'];
$pekerjaan_saat_ini = $_POST['pekerjaan_saat_ini'];
$nomor_telpon = $_POST ['nomor_telepon'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];

        // 🔍 Cek apakah NIK atau NISN sudah ada
        $cek = mysqli_query($conn, "SELECT * FROM data_alumni WHERE 'nomor telepon'");

        if (mysqli_num_rows($cek) > 0) {
            echo "<p style='color:red;'>nomor telepon sudah digunakan! Silakan periksa kembali.</p>";
        } else {
            // Jika belum ada, simpan data
            $sql = "INSERT INTO data_alumni (Nama, tahun_lulus, jurusan, pekerjaan_saat_ini, nomor_telpon, email, alamat)
        VALUES ('$Nama', '$tahun_lulus', '$jurusan', '$pekerjaan_saat_ini', '$nomor_telpon', '$email', '$alamat')";
            if (mysqli_query($conn, $sql)) {
                echo "<p style='color:green;'>✅ Data berhasil disimpan! <a href='index.php'>Kembali</a></p>";
            } else {
                echo "<p style='color:red;'>Gagal menyimpan data!</p>";
            }
            
        }
    }
    ?>
</body>

</html>