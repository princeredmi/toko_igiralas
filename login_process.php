<?php
session_start();
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Query to get the user from the database
    $query = mysqli_query($mysqli, "SELECT * FROM users WHERE email = '$email'");
    $user = mysqli_fetch_array($query);

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, start a session and store user data
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['phone_number'] = $user['phone_number'];
        $_SESSION['address'] = $user['address'];
        $_SESSION['role'] = $user['role'];

        // Store the profile picture path in the session
        $_SESSION['profile_picture'] = $user['profile_picture']; // Assuming the profile picture path is stored in the 'profile_picture' column

        header("Location: index.php"); // Redirect to a protected page
    } else {
        // Invalid credentials
        echo "<script>alert('Email atau password salah'); window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('Permintaan tidak valid'); window.location.href='login.php';</script>";
}
