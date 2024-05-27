<?php
require "../koneksi.php";
require "session.php"; // Untuk memastikan hanya admin yang bisa mengakses

$queryOrders = mysqli_query($mysqli, "SELECT * FROM orders ORDER BY order_date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Orders</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <h2>Orders</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = mysqli_fetch_array($queryOrders, MYSQLI_ASSOC)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['id']); ?></td>
                        <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                         <td><?php echo htmlspecialchars($order['customer_address']); ?></td>
                          <td><?php echo htmlspecialchars($order['customer_email']); ?></td>
                           <td><?php echo htmlspecialchars($order['customer_phone']); ?></td>
                        <td>
                            <a href="orders_items.php?id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-info">View</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="../bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
