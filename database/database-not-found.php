<?php
require_once '../app/Database.php';

$db = new Database();
if (isset($_POST['btn-generate'])) {
  $db->getConnection();
  $db->generate();
  header('Location:../adminpanel/login.php');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Database Tidak Ditemukan</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
  <div class="modal modal-signin position-static d-block py-5">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
          <div class="p-5 pb-4 border-bottom-0">
            <h3 class="fw-bold mb-0">
              Tidak Ada Database
            </h3>
            <p>Generate database beserta beberapa table sekarang?</p>
          </div>

          <form action="" method="post">
              <div class="modal-body p-5 pt-0">
                  <button type="submit" name="btn-generate" class="w-100 btn btn-lg rounded-3 btn-dark">
                      Generate
                  </button>
              </div>
          </form>
      </div>
    </div>
  </div>
</body>
</html>