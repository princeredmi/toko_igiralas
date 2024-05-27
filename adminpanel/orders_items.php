<?php
require "../koneksi.php";
require "session.php"; // Untuk memastikan hanya admin yang bisa mengakses

$queryOrderItems = mysqli_query($mysqli, "
    SELECT oi.order_id, p.nama AS product_name, oi.quantity, oi.price
    FROM order_items oi
    JOIN produk p ON oi.product_id = p.id
    ORDER BY oi.order_id DESC
");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Orders Items</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <h2>Orders Items</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order_items = mysqli_fetch_array($queryOrderItems, MYSQLI_ASSOC)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order_items['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order_items['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($order_items['quantity']); ?></td>
                        <td>Rp<?php echo number_format($order_items['price'], 2); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="../bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
