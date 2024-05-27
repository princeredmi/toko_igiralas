<?php
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = htmlspecialchars($_POST['customer_name']);
    $customer_email = htmlspecialchars($_POST['customer_email']);
    $customer_phone = htmlspecialchars($_POST['customer_phone']);
    $customer_address = htmlspecialchars($_POST['customer_address']);
    $total_amount = htmlspecialchars($_POST['total_amount']);
    $products = $_POST['products']; // Array of product_id and quantity

    // Insert order into orders table
    $queryOrder = "INSERT INTO orders (customer_name, customer_email, customer_phone, customer_address, total_amount)
                   VALUES ('$customer_name', '$customer_email', '$customer_phone', '$customer_address', '$total_amount')";
    mysqli_query($mysqli, $queryOrder);
    $order_id = mysqli_insert_id($mysqli);

    // Insert order items into order_items table
    foreach ($products as $product) {
        $product_id = $product['product_id'];
        $quantity = $product['quantity'];
        $price = $product['price']; // Retrieve price from product info

        $queryOrderItems = "INSERT INTO order_items (order_id, product_id, quantity, price)
                            VALUES ('$order_id', '$product_id', '$quantity', '$price')";
        mysqli_query($mysqli, $queryOrderItems);
    }

    // Send notification to admin (you can use email or other methods)
    $admin_email = "admin@example.com";
    $subject = "New Order Received";
    $message = "You have received a new order from $customer_name. Order ID: $order_id";
    mail($admin_email, $subject, $message);

    // Redirect to a thank you page
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Checkout</h2>
        <form action="checkout.php" method="post">
            <div class="mb-3">
                <label for="customer_name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
            </div>
            <div class="mb-3">
                <label for="customer_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="customer_email" name="customer_email" required>
            </div>
            <div class="mb-3">
                <label for="customer_phone" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
            </div>
            <div class="mb-3">
                <label for="customer_address" class="form-label">Alamat</label>
                <textarea class="form-control" id="customer_address" name="customer_address" rows="3" required></textarea>
            </div>
            <input type="hidden" name="total_amount" value="123.45"> <!-- Total amount should be calculated based on cart -->
            <input type="hidden" name="products" value='[{"product_id":1,"quantity":2,"price":50.00},{"product_id":2,"quantity":1,"price":23.45}]'>
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>

    <script src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
