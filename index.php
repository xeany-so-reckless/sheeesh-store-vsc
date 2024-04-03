<?php 
    require "koneksi.php";
    $queryProduk = mysqli_query($con, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 7");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sheesh Store | Home</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Sheeesh Store</h1>
            <h3>Find your style</h3>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Product Name" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn warna2 text-white">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h4>Best Selling Category</h4>

            <div class="row mt-5">
                <div class="col-md-4 mb-1">
                    <div class="highlighted-kategori kategori-baju-pria d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Baju Pria">Men Clothing</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-1">
                    <div class="highlighted-kategori kategori-baju-wanita d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Baju Wanita">Women Clothing</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-1">
                    <div class="highlighted-kategori kategori-asesoris d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Asesoris">Accesory</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- tentang kami -->
    <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <h4>About Us</h4>
            <p class="fs-9 mt-3">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium quod vero nisi corporis quisquam inventore ipsum expedita nesciunt ab harum deleniti qui voluptatem distinctio ex illo maxime, modi eos. Quibusdam corporis dolorem exercitationem tenetur culpa inventore, modi dicta ullam 
            </p>
        </div>
    </div>

    <!-- produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Product</h3>

            <div class="row mt-5">
                <?php while($data = mysqli_fetch_array($queryProduk)){ ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card">
                        <img src="image/<?php echo $data['foto'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data['nama'] ?></h4>
                            <p class="card-text text-truncate"><?php echo $data['detail'] ?></p>
                            <p class="card-text text-harga"><?php echo $data['harga'] ?></p>
                            <a href="produk-detail.php?nama=<?php echo $data['nama'] ?>" class="btn btn-dark text-white">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawsome/js/all.min.js"></script>
</body>
</html>