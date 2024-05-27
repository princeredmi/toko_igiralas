<?php
require "../koneksi.php";
require "session.php";

$id = $_GET['k'];

$query = mysqli_query($mysqli,"SELECT *FROM kategori WHERE id='$id'");
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
     <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>
<body>
    <?php require "navbar.php";?>
    <div class="container">
    <h2>Detail Kategori</h2>
<div class="col-12 col-md-6">
    <form action="" method="post">
        <div>
        <label for="kategori">Kategori</label>
        <input type="text" name="kategori" id="kategori" class="form-control"
        value ="<?php echo $data['nama'];?>"></input>
</div>
<div class="mt-5 d-flex justify-content-between">
<button type="submite" class="btn btn-primary" name="editBtn">Edit</button>
<button type="submite" class="btn btn-danger" name="deleteBtn">Delete</button>
</div>
    </form>
    <?php
    if(isset($_POST['editBtn'])){
        $kategori = htmlspecialchars($_POST['kategori']);

        if($data['nama']==$kategori){
            ?>
            <meta http-equiv="refresh"content="0; url=kategori.php" />
            <?php
        }
        else{
             $query = mysqli_query($mysqli,"SELECT *FROM kategori WHERE nama='$kategori'");
             $jumlahData = mysqli_num_rows($query);
        if($jumlahData > 0){
            ?>
              <div class="alert alert-warning mt-3" role="alert">
                Kategori Sudah Ada!
        </div>
            <?php
        }
          else{
             $querySimpan = mysqli_query($mysqli,"UPDATE kategori SET nama='$kategori' WHERE id='$id'");
            if($querySimpan){
                ?>
                <div class="alert alert-success" role="alert">
                success!
                </div>
                <meta http-equiv="refresh"content="2; url=kategori.php" />
                <?php
            }
            else{
                echo mysqli_error($mysqli);
            }
        }
    }
}
if(isset($_POST['deleteBtn'])){
    $queryCheck = mysqli_query($mysqli, "SELECT *FROM produk WHERE kategori_id='$id'");
    $dataCount = mysqli_num_rows($queryCheck);
    if($dataCount>0){
        ?>
        <div class="alert alert-warning" role="alert">
                Kategori Tidak Bisa dihapus Karna Sudah digunakan di Produk!
                </div>
        <?php
         die();
    }

    $queryDelete = mysqli_query($mysqli,"DELETE FROM kategori WHERE id='$id'");
    if($queryDelete){
          ?>
                <div class="alert alert-success" role="alert">
                success Delete!
                </div>
                <meta http-equiv="refresh"content="2; url=kategori.php" />
                <?php
    }
    else{
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