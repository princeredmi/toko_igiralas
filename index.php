<?php
require "koneksi.php";
$queryProduk = mysqli_query($mysqli, "SELECT id, nama, harga, foto,detail FROM produk LIMIT 3");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Igir Alas | HOME </title>

    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<?php require "navbar.php"; ?>

<!--Banner-->
<div class="container-fluid benner d-flex align-items-center">
    <div class="container text-center text-white">
        <h1>IGIR ALAS</h1>
        <h3>Mau Cari Apa?</h3>
        <div class="col-md-8 offset-md-2">
            <form method="get" action="produk.php">
                <div class="input-group input-group-lg my-4">
                    <input type="text" class="form-control" placeholder="Igir Alas" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                    <button type="submit" class="btn warna2 text-white">Telusuri</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Highligted Kategori-->
<div class="container-fluid py-5">
    <div class="container text-center">
        <h3>Produk Terlaris</h3>
        <div class="row mt-5">
            <div class="col-md-4 mb-3">
                <div class="highlighted-kategori kategori-produk-kopi d-flex justify-content-center 
            align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?produk=Kopi Igir Alas">Kopi Igir Alas</a></h4>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="highlighted-kategori kategori-produk-Gula d-flex justify-content-center 
            align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?produk=Gula Aren Igir Alas">Gula Aren Igir Alas</a></h4>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="highlighted-kategori kategori-produk-edukasi  d-flex justify-content-center 
            align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?produk=Edukasi Wisata">Edukasi Wisata</a></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Tentang kami-->
<div class="container-fluid warna1 py-5">
    <div class="container text-center">
        <h3 class="text-white">Tentang kami</h3>
        <p class="fs-5 text-white">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic deleniti fugiat praesentium esse culpa minima nemo voluptas veniam quibusdam. Consequuntur, aliquam officia sunt cum doloribus nemo tempore nostrum labore reiciendis error fugit magni iusto earum facere quas aut, dolor, voluptate obcaecati necessitatibus unde! Cum doloribus magnam corporis accusamus repudiandae cumque, voluptatibus aperiam iusto debitis nulla hic dolore earum molestias quos nesciunt expedita at dicta laborum ducimus illum molestiae,
            consequatur, nihil possimus. Voluptatibus sint soluta saepe maiores esse consequatur eligendi id.
        </p>
    </div>
</div>
<!--Produk-->
<div class="container-fluid py-5">
    <div class="container text-center">
        <h3>Produk</h3>
        <div class="row mt-5">
            <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="image-box">
                            <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data['nama']; ?></h5>
                            <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                            <p class="card-text text-harga">Rp<?php echo $data['harga']; ?></p>
                            <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn warna4 text-white">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <a class="btn btn-outline-success mt-3" href="produk.php">See More</a>
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