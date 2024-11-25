<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'koneksi.php';

$sql = "SELECT * FROM data_buku";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Daftar Buku</title>
</head>
<body>
    <h1>Daftar Buku</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Buku</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['kategori']; ?></td>
                <td><?php echo $row['harga_jual']; ?></td>
                <td><?php echo $row['harga_beli']; ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td>
                    <form method="post" action="ubah.php" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?php echo $row['id_buku']; ?>">
                        <button type="submit">Edit</button>
                    </form>

                    <form method="post" action="hapus.php" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        <input type="hidden" name="id" value="<?php echo $row['id_buku']; ?>">
                        <button type="submit" style="background-color: red; color: white;">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
