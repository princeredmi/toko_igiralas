<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
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
    <div class="container">
        <div class="card">
            <div class="card-header">
                Login
            </div>
            <div class="card-body">
                <form action="login_process.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
