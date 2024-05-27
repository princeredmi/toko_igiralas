<?php
require "../koneksi.php";
require "session.php";

$queryKategori = mysqli_query($mysqli,"SELECT *FROM kategori");
$JumlahKategori = mysqli_num_rows($queryKategori);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
     <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>
<style>
    .no-decoration{
        text-decoration: none;
    }
</style>
<body>
       <?php require "navbar.php"; ?>
       <div class="container mt-5">
          <nav aria-label="breadcrumb">
             <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">
            <a href="../adminpanel" class="no-decoration text-muted">
            <i class="fa-solid fa-house"></i> Home </a>
        </li>
             <li class="breadcrumb-item active" aria-current="page">
             <i class="fa-solid fa-list"></i> Kategori</li>
  </ol>
</nav>
<div class="ny-5 col-12 col-md-6">
<h3>Tambah Kategori</h3>

<form action="" method="post">
<div>
    <label for="kategori">Kategori</label>
    <input type="text" id="kategori" name="kategori" placeholder="input nama kategori" class="form-control">
</div>
<div class="mt-2">
    <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
</div>
</form>

<?php
if(isset($_POST['simpan_kategori'])){
    $kategori = htmlspecialchars($_POST['kategori']);

    $queryExist = mysqli_query($mysqli,"SELECT nama FROM kategori WHERE nama='$kategori'");
    $jumlahDatakategoriBaru = mysqli_num_rows($queryExist);

        if($jumlahDatakategoriBaru > 0){
        ?>
        <div class="alert alert-warning mt-3" role="alert">
         Kategori Sudah Ada!
        </div>
        <?php
        }
        else{
            $querySimpan = mysqli_query($mysqli,"INSERT INTO kategori (nama) VALUES ('$kategori')");
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
?>

</div>
<div class="mt-3">
<h2>List Kategori</h2>
<div class="table-responsive mt-3">
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
             <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($JumlahKategori ==0){
            ?>
        
        <tr>
            <td colspan=3>Data Kategori Tidak Tersedia</td>
        </tr>
        <?php
        }
        else{
            $Jumlah = 1;
            while($data=mysqli_fetch_array($queryKategori)){
        
        ?>
        <tr>
            <td><?php echo $Jumlah; ?></td>
             <td><?php echo $data['nama']; ?></td>
             <td>
                <a href="kategori-detail.php?k=<?php echo $data['id']; ?>"
                    class="btn btn-info"><i class="fas fa-search"></i>
                </a>
             </td>
        </tr>
        <?php
        $Jumlah++;
            }
        }
        ?>
    </tbody>
</table>
</div>
</div>
       </div>
    <script src="../bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
<script src="../fontawesome/js/all.min.js"></script>
</body>
</html>