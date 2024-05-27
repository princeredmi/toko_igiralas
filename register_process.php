<?php
session_start();
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $address = htmlspecialchars($_POST['address']);
    $role = htmlspecialchars($_POST['role']);

    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // File upload handling
    $target_directory = "profile_images/";
    $target_file = $target_directory . basename($_FILES["profile_picture"]["name"]);
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $upload_ok = 1;
        } else {
            echo "File is not an image.";
            $upload_ok = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $upload_ok = 0;
    }

    // Check file size
    if ($_FILES["profile_picture"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $upload_ok = 0;
    }

    // Allow certain file formats
    if (
        $image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg"
        && $image_file_type != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $upload_ok = 0;
    }

    // Create directory if it does not exist
    if (!file_exists($target_directory)) {
        mkdir($target_directory, 0755, true); // Create images directory with permissions
    }

    // Check if $upload_ok is set to 0 by an error
    if ($upload_ok == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        // Move uploaded file to "images" directory
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["profile_picture"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Insert the new user into the database
    $query = "INSERT INTO users (name, email, password, phone_number, address, role, profile_picture) 
              VALUES ('$name', '$email', '$hashed_password', '$phone_number', '$address', '$role', '$target_file')";

    if (mysqli_query($mysqli, $query)) {
        echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: Could not register.'); window.location.href='register.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href='register.php';</script>";
}
