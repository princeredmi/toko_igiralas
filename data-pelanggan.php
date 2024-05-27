<?php
require "koneksi.php";


$id = $_GET['id'];

$query = mysqli_query($mysqli, "SELECT * FROM pelanggan WHERE id='$id'");
$data = mysqli_fetch_array($query, MYSQLI_ASSOC);

if (!$data) {
    echo "<script>alert('Data pelanggan tidak ditemukan'); window.location.href='pelanggan.php';</script>";
    exit();
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pelanggan</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <style>
        form div {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php require "navbar.php"; ?>
<div class="container mt-5">
    <h2>Detail Pelanggan</h2>
    <div class="col-12 col-md-6 mb-5">
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" class="form-control" autocomplete="off" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" class="form-control" autocomplete="off" required>
            </div>
            <div>
                <label for="telephone">Telephone</label>
                <input type="text" id="telephone" name="telephone" value="<?php echo htmlspecialchars($data['telephone']); ?>" class="form-control" autocomplete="off" required>
            </div>
            <div>
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
            </div>
            <div>
                <label for="currentFoto">Foto Sekarang</label>
                <img src="../images/<?php echo htmlspecialchars($data['foto']); ?>" alt="Foto Pelanggan" width="300px">
            </div>
            <div>
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-primary" name="update">Update</button>
                <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
            </div>
        </form>
        <?php
        if (isset($_POST['update'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $email = htmlspecialchars($_POST['email']);
            $telephone = htmlspecialchars($_POST['telephone']);
            $alamat = htmlspecialchars($_POST['alamat']);

            $target_dir = "../images/";
            $nama_file = basename($_FILES["foto"]["name"]);
            $target_file = $target_dir . $nama_file;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $image_size = $_FILES["foto"]["size"];
            $random_name = generateRandomString(20);
            $new_name = $random_name . "." . $imageFileType;

            if ($nama == '' || $email == '' || $telephone == '' || $alamat == '') {
                echo '<div class="alert alert-warning mt-3" role="alert">Nama, Email, Telephone, dan Alamat wajib diisi!</div>';
            } else {
                $queryUpdate = mysqli_query($mysqli, "UPDATE pelanggan SET nama='$nama', email='$email', telephone='$telephone', alamat='$alamat' WHERE id=$id");

                if ($nama_file != '') {
                    if ($image_size > 500000) {
                        echo '<div class="alert alert-warning mt-3" role="alert">File tidak boleh lebih dari 500 KB!</div>';
                    } else {
                        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif') {
                            echo '<div class="alert alert-warning mt-3" role="alert">File wajib bertipe jpg, png, atau gif!</div>';
                        } else {
                            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                            $queryUpdate = mysqli_query($mysqli, "UPDATE pelanggan SET foto='$new_name' WHERE id='$id'");

                            if ($queryUpdate) {
                                echo '<div class="alert alert-success" role="alert">Data pelanggan berhasil diperbarui!</div>';
                                echo '<meta http-equiv="refresh" content="2; url=pelanggan.php" />';
                            }
                        }
                    }
                }
            }
        }

        if (isset($_POST['hapus'])) {
            $queryHapus = mysqli_query($mysqli, "DELETE FROM pelanggan WHERE id='$id'");

            if ($queryHapus) {
                echo '<div class="alert alert-primary mt-3" role="alert">Data pelanggan berhasil dihapus!</div>';
                echo '<meta http-equiv="refresh" content="2; url=pelanggan.php" />';
            } else {
                echo mysqli_error($mysqli);
            }
        }
        ?>
    </div>
</div>
<script src="../bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
<script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
