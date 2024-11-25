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

$sql = "DELETE FROM data_buku WHERE id_buku = '{$id}'";
$result = mysqli_query($conn, $sql);

if ($result) {
    header('Location: index.php');
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
