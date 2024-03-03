<?php
// require_once '../../apps/config/url_config.php';
require_once '../../apps/init.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Database Tidak Ditemukan</title>
  <link rel="stylesheet" href="<?= STYLE_URL ?>/bootstrap.min.css">
</head>
<body>
  <div class="modal modal-signin position-static d-block py-5">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
          <div class="p-5 pb-4 border-bottom-0">
            <h3 class="fw-bold mb-0">
              Behasil digenerate!
            </h3>
            <p>Database <?= DB_NAME ?> dan beberapa table berhasil digenerate</p>
          </div>

          <div class="modal-body p-5 pt-0">
              <a href="<?= BASE_URL ?>/index.php" class="w-100 btn btn-lg rounded-3 btn-dark">
                  Kembali ke beranda
              </a>
          </div>
      </div>
    </div>
  </div>
</body>
</html>