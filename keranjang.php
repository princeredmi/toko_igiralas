<?php
session_start();
require "koneksi.php";

// Handle product removal from cart
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['keranjang'][$id])) {
        unset($_SESSION['keranjang'][$id]);
    }
    header("Location: keranjang.php");
    exit;
}

// Handle clearing the cart
if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    unset($_SESSION['keranjang']);
    header("Location: keranjang.php");
    exit;
}

// Handle checkout
if (isset($_POST['checkout'])) {
    $keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : [];

    if (!empty($keranjang)) {
        $userId = $_SESSION['user_id']; // Assuming user_id is stored in session
        $orderDate = date("Y-m-d H:i:s");

        // Insert order into orders table
        $queryOrder = "INSERT INTO orders (user_id, order_date) VALUES ('$userId', '$orderDate')";
        mysqli_query($mysqli, $queryOrder);
        $orderId = mysqli_insert_id($mysqli);

        // Insert each item into order_items table
        foreach ($keranjang as $item) {
            $productId = $item['id'];
            $quantity = $item['quantity'];
            $price = $item['harga'];

            $queryOrderItem = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$orderId', '$productId', '$quantity', '$price')";
            mysqli_query($mysqli, $queryOrderItem);
        }

        // Clear the cart
        unset($_SESSION['keranjang']);

        header("Location: checkout.php");
        exit;
    }
}

// Display cart contents
$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : [];
$totalPembelian = 0;
foreach ($keranjang as $item) {
    $totalPembelian += $item['harga'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container py-5">
        <h1>Keranjang Belanja</h1>
        <?php if (!empty($keranjang)) { ?>
        <form method="post" action="">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($keranjang as $item) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nama']); ?></td>
                        <td>Rp<?php echo number_format($item['harga'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>Rp<?php echo number_format($item['harga'] * $item['quantity'], 2); ?></td>
                        <td>
                            <a href="keranjang.php?action=remove&id=<?php echo $item['id']; ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="mt-3">
                <h4>Total Pembelian: Rp<?php echo number_format($totalPembelian, 2); ?></h4>
                <button type="submit" name="checkout" class="btn btn-success">Checkout</button>
                <a href="keranjang.php?action=clear" class="btn btn-warning">Kosongkan Keranjang</a>
            </div>
        </form>
        <?php } else { ?>
        <p>Keranjang belanja Anda kosong.</p>
        <a href="index.php" class="btn btn-primary">Lanjutkan Belanja</a>
        <?php } ?>
    </div>

    <script src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
