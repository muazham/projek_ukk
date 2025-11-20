<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Alumni</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data Alumni Sekolah</h2>
    
    <a href="tambah.php" id="tambahdata">+ Tambah Data</a>
    
    <div class="search-form">
        <form method="GET" style="margin-bottom: 20px;">
            <input type="text" name="cari" placeholder="Cari nama / jurusan / pekerjaan..."
                value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
            <button type="submit">Cari</button>
        </form>
    </div>

    <?php if (isset($_GET['cari']) && $_GET['cari'] != ''): ?>
    <a href="index.php" id="tambahdata" style="margin-bottom: 20px;">
        Kembali ke Semua Data
    </a>
    <?php endif; ?>

    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Tahun Lulus</th>
                <th>Jurusan</th>
                <th>Pekerjaan Saat Ini</th>
                <th>Nomor Telepon</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Perubahan</th>
            </tr>
            <?php
            // PENCARIAN
            $where_clause = "";
            if (isset($_GET['cari'])) {
                $cari = mysqli_real_escape_string($conn, $_GET['cari']);
                $where_clause = " WHERE Nama LIKE '%$cari%' 
                    OR jurusan LIKE '%$cari%' 
                    OR pekerjaan_saat_ini LIKE '%$cari%' 
                    OR tahun_lulus LIKE '%$cari%' ";
            }
            
            $sql = "SELECT * FROM data_alumni" . $where_clause;
            $result = mysqli_query($conn, $sql);
            
            // TAMPILKAN DATA
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['Nama']}</td>
                        <td>{$row['tahun_lulus']}</td>
                        <td>{$row['jurusan']}</td>
                        <td>{$row['pekerjaan_saat_ini']}</td>
                        <td>{$row['nomor_telpon']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['alamat']}</td>
                        <td>
                            <a href='edit.php?id={$row['id']}'>Edit</a> |
                            <a href='hapus.php?id={$row['id']}' onclick=\"return confirm('Yakin ingin hapus data ini?')\">Hapus</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='10' style='text-align:center;'>Tidak ada data alumni ditemukan.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>