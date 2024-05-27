<?php
require "koneksi.php";

$queryKategori = mysqli_query($mysqli,"SELECT *FROM kategori");

// Get Produk by nama Produk/Keyword
if(isset($_GET['keyword'])){
$queryProduk = mysqli_query ($mysqli,"SELECT *FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
}
// Get Produk by Kategori
else if(isset($_GET['kategori'])){
$queryGetKategoriId = mysqli_query($mysqli,"SELECT id FROM kategori WHERE nama='$_GET[kategori]' ");
$kategoriId = mysqli_fetch_array($queryGetKategoriId);

$queryProduk = mysqli_query($mysqli,"SELECT *FROM produk WHERE kategori_id='$kategoriId[id]'");
}
// Get Produk Default
else{
$queryProduk = mysqli_query($mysqli,"SELECT *FROM produk");
}
$countData = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Igir Alas | Produk</title>
      
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="CSS/style.css">

</head>
<body>
   <?php require  "navbar.php";?>
   <!--Banner-->
   <div class ="container-fluid benner-produk d-flex align-items-center">
    <div class ="container">
    <h1 class = "text-white text-center">Produk</h1>
    </div>
   </div>

   <!--body-->
<div class="container-py-5">
<div class="row">
    <div class="col-lg-3 mb-5">
        <h3>Kategori</h3>
        <ul class="list-group">
            <?php while ($kategori = mysqli_fetch_array($queryKategori)){?>
            <a class= "no-decoration" href="produk.php?kategori=<?php echo $kategori['nama'];?>">
            <li class="list-group-item"><?php echo $kategori['nama'];?></li>
            </a>
            <?php }?>
</ul>
    </div>
    <div class="col-lg-9">
        <h3 class="text-center mb-3">Produk</h3>
        <div class="row">
            <?php 
            if($countData<1){
                ?>
                <h4 class="text-center my-5">Produk Yang anda cari tidak tersedia</h4>
<?php
            }
            ?>
            


            <?php while ($produk = mysqli_fetch_array($queryProduk)){?>
            <div class="col-md-4 mb-3">
                   <div class="card h-100">
            <div class="image-box">
                <img src="image/<?php echo $produk['foto'];?>" class="card-img-top" alt="...">
            </div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $produk['nama'];?></h5>
    <p class="card-text text-truncate"><?php echo $produk['detail'];?></p>
    <p class="card-text text-harga">Rp<?php echo $produk['harga'];?></p>
    <a href="produk-detail.php?nama=<?php echo $produk['nama'];?>"
    class="btn warna4 text-white"><i class="fas fa-shopping-cart"></i>Lihat Detail</a>

  </div>
</div>
            </div>
            <?php }?>
            
        </div>
    </div>
</div>
</div>
 <!--footer-->
    <?php
    require "footer.php";
    ?>

<script src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
<script src="fontawesome/js/all.min.js"></script>  
</body>
</html>