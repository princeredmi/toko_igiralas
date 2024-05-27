<?php
session_start();
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $nama = htmlspecialchars($data['nama']);
    $quantity = (int)htmlspecialchars($data['quantity']); // Get the quantity from the input

    // Get product details
    $queryProduk = mysqli_query($mysqli, "SELECT * FROM produk WHERE nama = '$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    if ($produk) {
        $id = $produk['id'];
        $nama = $produk['nama'];
        $harga = $produk['harga'];

        // Create cart item
        $item = [
            'id' => $id,
            'nama' => $nama,
            'harga' => $harga,
            'quantity' => $quantity
        ];

        // Add item to session cart
        if (isset($_SESSION['keranjang'][$id])) {
            $_SESSION['keranjang'][$id]['quantity'] += $quantity; // Increment quantity
        } else {
            $_SESSION['keranjang'][$id] = $item;
        }

        echo json_encode(['status' => 'success', 'message' => 'Product added to cart']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Product not found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
