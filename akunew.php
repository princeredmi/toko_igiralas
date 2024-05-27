

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya</title>
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        body {
            background: url('image/kopi.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.9);
            max-width: 400px;
            width: 100%;
            margin: auto;
        }

        .card-header {
            background: #343a40;
            color: white;
            text-align: center;
            padding: 1rem 0;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 500;
            color: #343a40;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #343a40;
        }

        .btn-primary {
            background: #343a40;
            border: none;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 50px;
        }

        .btn-primary:hover {
            background: #23272b;
        }

        .input-group-text {
            background: #343a40;
            color: white;
            border: none;
        }

        .input-group-text i {
            font-size: 1.2rem;
        }

        .forgot-password {
            display: block;
            text-align: right;
            margin-top: 10px;
            font-size: 0.875rem;
            color: #343a40;
        }

        .forgot-password:hover {
            color: #23272b;
            text-decoration: underline;
        }
    </style>
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
                        <img src="images/<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" class="profile-img" style="border-radius: 50%; width: 150px; height: 150px;">
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