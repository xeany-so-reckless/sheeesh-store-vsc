<?php

class Database
{
  private $host = 'localhost';
  private $username = 'root';
  private $password = '';
  private $db_name = 'toko_online';
  private $admin_pass = 'rahasia';
  public $conn;

  public function getConnection()
  {
    $this->conn = new mysqli($this->host, $this->username, $this->password);

    if (!$this->conn) {
      die('Koneksi error:' . mysqli_connect_error());
    }

    $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$this->db_name'";
    $result = $this->conn->query($query);

    if ($result->num_rows > 0) {
      $this->conn->select_db($this->db_name);
      return $this->conn;
    } else {
      header('Location:http://localhost/tokoonline/database/database-not-found.php');
    }
    
    return $this->conn;
  }

  public function generate() {
    $createDb = "CREATE DATABASE IF NOT EXISTS $this->db_name";
    $this->conn->query($createDb);

    $this->conn->select_db($this->db_name);

    $createKategori = "CREATE TABLE IF NOT EXISTS `kategori` (
      `id` int(11) PRIMARY KEY AUTO_INCREMENT,
      `nama` varchar(100)
    )";
    $this->conn->query($createKategori);

    $createProduk = "CREATE TABLE IF NOT EXISTS `produk` (
      `id` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
      `kategori_id` int(11),
      `nama` VARCHAR(255),
      `harga` double NOT NULL,
      `foto` varchar(255) DEFAULT NULL,
      `detail` text,
      `ketersediaan_stok` enum('habis', 'tersedia') DEFAULT 'tersedia',
      FOREIGN KEY (kategori_id) REFERENCES kategori(id)
    )";
    $this->conn->query($createProduk);

    $createUsers = "CREATE TABLE IF NOT EXISTS `users` (
      `id` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
      `username` varchar(30),
      `password` VARCHAR(255)
    )";
    $this->conn->query($createUsers);


    $hash = password_hash($this->admin_pass, PASSWORD_BCRYPT);
    $createAdminAccount = "INSERT INTO `users`(`username`, `password`) 
                          VALUES ('admin','$hash')";
    $this->conn->query($createAdminAccount);
  }

}