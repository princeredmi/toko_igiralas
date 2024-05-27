<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize session variables
$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$phone_number = $_SESSION['phone_number'];
$address = $_SESSION['address'];
$role = $_SESSION['role'];
$profile_picture = $_SESSION['profile_picture'] ?? 'default.png';

// Process update profile data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve updated data from the form
    $updated_name = htmlspecialchars($_POST['name']);
    $updated_email = htmlspecialchars($_POST['email']);
    $updated_phone_number = htmlspecialchars($_POST['phone_number']);
    $updated_address = htmlspecialchars($_POST['address']);

    // Update session variables with the new data
    $_SESSION['name'] = $updated_name;
    $_SESSION['email'] = $updated_email;
    $_SESSION['phone_number'] = $updated_phone_number;
    $_SESSION['address'] = $updated_address;

    // File upload handling for profile picture
    if ($_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['profile_picture']['name'];
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_type = $_FILES['profile_picture']['type'];

        // Move uploaded file to a permanent location
        $target_dir = "images/";
        $target_file = $target_dir . basename($file_name);
        move_uploaded_file($file_tmp, $target_file);

        // Update session variable with the new profile picture path
        $_SESSION['profile_picture'] = $target_file;
    }

    // Redirect to profile page or any other desired page after update
    header("Location: akun.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun</title>
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
                    <h3 class="mb-0">Edit Akun</h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <!-- Display profile picture -->
                        <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" width="200" height="200" class="img-thumbnail">
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Telephone</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($phone_number); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required><?php echo htmlspecialchars($address); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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