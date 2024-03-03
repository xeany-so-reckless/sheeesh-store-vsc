<?php
    session_start();
    require_once '../app/Database.php';
    require_once '../koneksi.php';

    $db = new Database();
    $db->getConnection();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>
<style>
    .main{
        height: 100vh;
    }

    .login-box{
        width: 500px;
        height: 300px;
        box-sizing: border-box;
        border-radius: 10px;
    }

    body {
        background-color: #DCF2F1;
    }
    
</style>
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 mt-3 shadow" style="background-color: #7FC7D9;">
            <div>
                <a class="nav-link text-center">Shees Store <i class="fa-solid fa-ghost"></i></a>
            </div>
            <form action="" method="post">
                <div>
                    <label for="username">username</label>
                    <input type="text" class="form-control mt-3" name="username" id="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control mt-3" name="password" id="password">
                </div>
                <div>
                    <button class="btn btn-dark form-control mt-3" type="submit" name="loginbtn">login</button>
                </div>
            </form>
        </div>

        <div class="mt-3" style="width: 500px;">
            <?php
                if(isset($_POST['loginbtn'])){
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);

                    $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);
                    

                    if($countdata>0){
                        if (password_verify($password, $data['password'])) {
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['login'] = true;
                            header('location: ../adminpanel');
                        }
                        else{
                            ?>
                            <div class="alert alert-warning" role="alert">
                                 password salah !
                            </div>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <div class="alert alert-warning" role="alert">
                            username atau password tidak valid !
                        </div>
                        <?php
                    }

                }
            ?>
        </div>
    </div>

<script src="../fontawesome/js/all.min.js"></script>
</body>
</html>