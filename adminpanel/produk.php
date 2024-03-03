<?php 
    require "session.php";
    require "../koneksi.php";

    $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
    $jumlahProduk = mysqli_num_rows($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    function generateRardomString($lenght = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLenght = strlen($characters);
        $randomstring = '';
        for ($i = 0; $i < $lenght; $i++) {
            $randomstring .= $characters[rand(0, $charactersLenght - 1)];
        }
        return $randomstring;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
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
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
    <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="../adminpanel/" class="no-decoration text-muted">
                            <i class="fa-solid fa-house"></i>Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
                </ol>
        </nav>
        <!-- tambah produk -->
        <div class="my-5 col-12 col-md-6">
        <h4>Tambah Produk</h4>

        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" autocomplete="off">
            </div>
            <div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control">
                    <option value="">Pilih 1</option>
                    <?php 
                        while($data=mysqli_fetch_array($queryKategori)){
                    ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                    <?php
                        }
                    ?>
                </select>
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
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRardomString(20);
                $new_name = $random_name . "." .$imageFileType;

                if($nama=='' || $kategori=='' || $harga==''){
        ?>
                    <div class="alert alert-warning mt-3" role="alert">
                            Nama, Kategori, dan Harga harus diisi!
                    </div>
        <?php
                }
                else{
                    if($nama_file!=''){
                        if($image_size > 1000000){
        ?>
                    <div class="alert alert-warning mt-3" role="alert">
                            Foto tidak boleh lebih dari 1mb
                    </div> 
        <?php
                        }
                        else{
                            if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType !== 'jpeg'){
        ?>
                    <div class="alert alert-warning mt-3" role="alert">
                            File wajib bertipe jpg/jpeg/png
                    </div> 
        <?php
                            }
                            else{
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                            }
                        }
                    }

                    //query insert ke produk table
                    $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok)
                     VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stok')");

                     if($queryTambah){
        ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Produk berhasil tersimpan
                        </div>

                        <meta http-equiv="refresh" content="2; url=produk.php" />
        <?php
                     }
                     else{
                        echo mysqli_error($mysqli);
                     }
                }
            }
        ?>
        </div>

        <div class="mt-3 mb-5">
            <h3>List Produk</h3>

            <div class="table-responsive mt-5">
                <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($jumlahProduk==0){
                            ?>
                                <tr>
                                    <td colspan="6" class="text-center">Data Produk tidak tersedia</td>
                                </tr>
                            <?php
                                }
                                else{
                                    $jumlah =1;
                                    while($data = mysqli_fetch_array($query)){
                            ?>
                                    <tr>
                                        <td><?php echo $jumlah; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td><?php echo $data['nama_kategori']; ?></td>
                                        <td><?php echo $data['harga']; ?></td>
                                        <td><?php echo $data['ketersediaan_stok']; ?></td>
                                        <td>
                                            <a href="produk-detail.php?id=<?php echo $data['id']; ?>"
                                            class="btn btn-info"><i class="fa-solid fa-magnifying-glass"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                    $jumlah++;
                                    }
                                }
                            ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>