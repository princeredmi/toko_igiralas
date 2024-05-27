<?php
require "../koneksi.php";
require "session.php";

$queryProduk = mysqli_query($mysqli,"SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.
kategori_id = b.id");
$JumlahProduk = mysqli_num_rows($queryProduk);

$queryKategori = mysqli_query($mysqli,"SELECT *FROM kategori");

function generateRandomString ($length = 10){
    $characters = "0123456789abcdevghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .=$characters[rand(0, $charactersLength -1)];
    }
    return $randomString;
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
     <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .no-decoration{
        text-decoration: none;
    }
    form div{
        margin-bottom: 10px;
    }
</style>

<body>
<?php require "navbar.php";?>
<div class="container mt-5">
 <nav aria-label="breadcrumb">
             <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">
            <a href="../adminpanel" class="no-decoration text-muted">
            <i class="fa-solid fa-house"></i> Home </a>
        </li>
             <li class="breadcrumb-item active" aria-current="page">
                <i class="fa-brands fa-product-hunt"></i>Produk</li>
  </ol>
</nav>
<!--tambah produk-->
<div class="ny-5 col-12 col-md-6">
    <h3>Tambah Produk</h3>
<div class="mt-3">
    <h2>List Produk</h2>
    <form action="" method="post"enctype="multipart/form-data">
        <div>
    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" placeholder="input Produk" class="form-control" autocomplete="off" 
    >
</div>
<div>
    <label for="kategori">Kategori</label>
    <select name="kategori" id="kategori" class="form-control">
        <option value="">Pilih Satu</option>
    <?php
    while($data=mysqli_fetch_array($queryKategori)){
        ?>
        <option value="<?php echo $data ['id'];?>"><?php echo $data ['nama'];?></option>
        <?php
    }
    ?>
    </select>
</div>
<div>
    <label for="harga">Harga</label>
    <input type="number" class="form-control" name="harga">
</div>
<div>
    <label for="foto">Foto</label>
    <input type="file" name="foto" id="foto" class="form-control">
</div>
<div>
    <label for="detail">Detail</label>
    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
</div>
<div>
    <label for="ketersediaan_stok">Ketersediaan Stok</label>
    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
        <option value="tersedia">Tersedia</option>
            <option value="habis">Habis</option>
    </select>
</div>
<div>
    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
</div>
    </form>
    <?php
    if(isset($_POST['simpan'])){
        $nama = htmlspecialchars($_POST['nama']);
         $kategori = htmlspecialchars($_POST['kategori']);
          $harga = htmlspecialchars($_POST['harga']);
          $detail = htmlspecialchars($_POST['detail']);
          $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

          $target_dir = "../image/";
          $nama_file =basename($_FILES["foto"]["name"]);
          $target_file = $target_dir . $nama_file;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          $image_size = $_FILES["foto"]["size"] ;
          $random_name = generateRandomString(20);
          $new_name = $random_name . "." . $imageFileType;


        if($nama==''|| $kategori== ''|| $harga== ''){
            ?>
             <div class="alert alert-warning mt-3" role="alert">
         Nama, Kategori dan Harga Wajib Diisi!
        </div>
            <?php
    }
    else{
        if($nama_file !=''){
            if($image_size > 500000){
                ?>
                 <div class="alert alert-warning mt-3" role="alert">
         File Tidak boleh lebih dari 500 kb!
        </div>
        <?php
            }
            else{
                if($imageFileType !='jpg'&& $imageFileType !='png' && $imageFileType !='gif'){
?>
 <div class="alert alert-warning mt-3" role="alert">
         File Wajib bertipe jpg atau png atau gif!
        </div>
<?php
                }
                else{
move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir .$new_name);
        }
            }
        }
        //query insert to produk table
        $queryTambah = mysqli_query($mysqli,"INSERT INTO produk (kategori_id, nama, harga, foto, 
        detail, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga',
         '$new_name', '$detail', '$ketersediaan_stok')");

         if($queryTambah){
            ?>
             <div class="alert alert-success" role="alert">
                Produk Berhasil Tersimpan!
                </div>
                <meta http-equiv="refresh"content="2; url=produk.php" />
            <?php
         }
         else{
            echo mysqli_error($mysqli);
         }
    }
}
    ?>
</div>

    <div class="table-responsive mt-3 mb-5">
        <table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kategori</th>
             <th>Harga</th>
             <th>Ketersediaan Stok</th>
               <th>Action</th>

        </tr>
    </thead>
    <tbody>
    <?php
    if($JumlahProduk==0){
        ?>
         <tr>
            <td colspan=6>Data Produk Tidak Tersedia</td>
        </tr>
        <?php
    }
    else{
          $Jumlah = 1;
           while($data=mysqli_fetch_array($queryProduk)){
             ?>
        <tr>
            <td><?php echo $Jumlah; ?></td>
             <td><?php echo $data['nama']; ?></td>
             <td><?php echo $data['nama_kategori']; ?></td>
             <td><?php echo $data['harga']; ?></td>
             <td><?php echo $data['ketersediaan_stok']; ?></td>
             <td>
                 <a href="produk-detail.php?k=<?php echo $data['id']; ?>"
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