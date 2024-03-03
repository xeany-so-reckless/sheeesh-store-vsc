<?php
    require "session.php";
    require_once "../app/Database.php";
    require_once "../koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);

    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($queryProduk);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .kotak{
        border: solid;
    }

    .summary-kategori{
        background-color: #229135;
        border-radius: 10px;
    }

    .summary-produk{
        background-color: #249793;
        border-radius: 10px;
    }

    .no-decoration{
        text-decoration: none;
    }
</style>

<body>
    <?php require"navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                <i class="fa-solid fa-house"></i>Home</li>
            </ol>
    </nav>
        <h2>Halo <?php echo $_SESSION['username']; ?></h2>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-kategori p-3">
                        <div class="row">
                                <div class="col-6">
                                    <i class="fa-solid fa-align-justify fa-7x text-black-50"></i>
                                </div>
                                 <div class="col-6 text-white">
                                    <h3 class="fs-2">Kategori</h3>
                                    <p class="fs-4"> <?php echo $jumlahKategori; ?> Kategori</p>
                                    <p> <a href="kategori.php" class="text-white no-decoration">Lihat Detail</a></p>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-produk p-3">
                        <div class="row">
                            <div class="col-6">
                            <i class="fa-solid fa-bag-shopping fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Produk</h3>
                                <p class="fs-4"> <?php echo $jumlahProduk; ?> Produk</p>
                                <p> <a href="produk.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>