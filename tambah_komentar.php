<?php
require "koneksi.php";

$produk_id = htmlspecialchars($_POST['produk_id']);
$nama_pelanggan = htmlspecialchars($_POST['nama_pelanggan']);
$komentar = htmlspecialchars($_POST['komentar']);
$tanggal = date("Y-m-d H:i:s");

$query = "INSERT INTO komentar (produk_id, nama_pelanggan, komentar, tanggal) VALUES ('$produk_id', '$nama_pelanggan', '$komentar', '$tanggal')";
$result = mysqli_query($mysqli, $query);

if ($result) {
    header("Location: produk-detail.php?nama=" . urlencode($_POST['nama']));
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
}
?>
