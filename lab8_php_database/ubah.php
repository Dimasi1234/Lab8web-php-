<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'koneksi.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    echo "ID Buku tidak ditemukan!";
    exit;
}

$sql = "SELECT * FROM data_buku WHERE id_buku = '{$id}'";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    die('Error: Data tidak tersedia');
}
$data = mysqli_fetch_array($result);

if (isset($_POST['submit'])) {
    $id = $_POST['id']; 
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;

    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;
        }
    }

    $sql = "UPDATE data_buku SET ";
    $sql .= "nama = '{$nama}', kategori = '{$kategori}', ";
    $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok = '{$stok}' ";
    if (!empty($gambar)) {
        $sql .= ", gambar = '{$gambar}' ";
    }
    $sql .= "WHERE id_buku = '{$id}'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('Location: index.php'); 
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Ubah Buku</title>
</head>
<body>
    <h1>Ubah Buku</h1>
    <form method="post" action="ubah.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $data['id_buku']; ?>">
        <div>
            <label>Nama Buku</label>
            <input type="text" name="nama" value="<?php echo $data['nama']; ?>">
        </div>
        <div>
            <label>Kategori</label>
            <select name="kategori">
                <option <?php echo ($data['kategori'] == 'Romance') ? 'selected' : ''; ?> value="Romance">Romance</option>
                <option <?php echo ($data['kategori'] == 'Horror') ? 'selected' : ''; ?> value="Horror">Horror</option>
                <option <?php echo ($data['kategori'] == 'Comedy') ? 'selected' : ''; ?> value="Comedy">Comedy</option>
            </select>
        </div>
        <div>
            <label>Harga Jual</label>
            <input type="text" name="harga_jual" value="<?php echo $data['harga_jual']; ?>">
        </div>
        <div>
            <label>Harga Beli</label>
            <input type="text" name="harga_beli" value="<?php echo $data['harga_beli']; ?>">
        </div>
        <div>
            <label>Stok</label>
            <input type="text" name="stok" value="<?php echo $data['stok']; ?>">
        </div>
        <div>
            <label>File Gambar</label>
            <input type="file" name="file_gambar">
        </div>
        <div>
            <button type="submit" name="submit">Simpan</button>
        </div>
    </form>
</body>
</html>
