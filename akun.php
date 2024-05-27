<?php
session_start();
require "koneksi.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user data from session
$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$phone_number = $_SESSION['phone_number'];
$address = $_SESSION['address'];
$role = $_SESSION['role'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya</title>
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="CSS/style.css">

</head>

<body>
    <?php require "navbar.php"; ?>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Akun Saya</h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <!-- Tampilkan foto profil menggunakan path yang disimpan dalam session -->
                        <img src="<?php echo htmlspecialchars($_SESSION['profile_picture'] ?? 'default.png'); ?>" alt="Profile Picture" width="200" height="200" class="img-thumbnail">
                    </div>
                    <form>
                        <div class="mb-3">
                            <label for="id" class="form-label">ID</label>
                            <input type="text" class="form-control" id="id" value="<?php echo htmlspecialchars($user_id); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" value="<?php echo htmlspecialchars($name); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Telephone</label>
                            <input type="text" class="form-control" id="phone_number" value="<?php echo htmlspecialchars($phone_number); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" rows="3" readonly><?php echo htmlspecialchars($address); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="role" value="<?php echo htmlspecialchars($role); ?>" readonly>
                        </div>
                        <a href="edit_akun.php" class="btn btn-edit">Edit</a>
                        <a href="logout.php" class="btn btn-primary">Logout</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--footer-->
    <?php require "footer.php"; ?>

    <script src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>