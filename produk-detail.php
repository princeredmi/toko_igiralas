<?php
require "koneksi.php";
$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($mysqli, "SELECT * FROM produk WHERE nama = '$nama'");
$produk = mysqli_fetch_array($queryProduk);
$queryProdukTerkait = mysqli_query($mysqli, "SELECT * FROM produk WHERE kategori_id ='$produk[kategori_id]' AND id != '$produk[id]' LIMIT 4");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Detail Produk</title>
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <!--detail Produk-->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-3">
                    <img src="image/<?php echo $produk['foto']; ?>" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $produk['nama']; ?></h1>
                    <p><?php echo $produk['detail']; ?></p>
                    <p class="text-harga">Rp<?php echo $produk['harga']; ?></p>
                    <p>Status Ketersediaan: <strong><?php echo $produk['ketersediaan_stok']; ?></strong></p>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Jumlah</span>
                        <input type="number" class="form-control" id="quantity" value="1" min="1" max="<?php echo $produk['ketersediaan_stok']; ?>">
                    </div>
                    <button class="btn warna4 text-white" data-nama="<?php echo $produk['nama']; ?>">
                        <i class="fas fa-shopping-cart"></i> Masukan Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Keranjang Belanja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Produk telah ditambahkan ke keranjang belanja Anda.</p>
                    <p>Nama Produk: <strong><?php echo $produk['nama']; ?></strong></p>
                    <p>Harga: <strong>Rp<?php echo $produk['harga']; ?></strong></p>
                </div>
                <div class="modal-footer">
                    <button class="btn warna4 text-white" data-nama="<?php echo $produk['nama']; ?>">
                        <i class="fas fa-shopping-cart"></i> Masukan Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--Produk Terkait-->
    <div class="container-fluid py-5 warna1">
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk Terkait</h2>
            <div class="row">
                <?php while ($data = mysqli_fetch_array($queryProdukTerkait)) { ?>
                    <div class="col-md-6 col-lg-2 mb-3">
                        <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
                            <img src="image/<?php echo $data['foto']; ?>" class="img-fluid img-thumbnail" alt="">
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!--footer-->
    <?php require "footer.php"; ?>

    <script src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var cartButtons = document.querySelectorAll('.btn.warna4');

            cartButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    var nama = this.getAttribute('data-nama');
                    var quantity = document.getElementById('quantity').value;

                    fetch('add_to_cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ nama: nama, quantity: quantity })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            window.location.href = 'keranjang.php';
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
</body>
</html>