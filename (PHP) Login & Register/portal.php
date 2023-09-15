<?php

require_once 'inc/config.php';

$_SESSION['noses'] = 'no';

if(!isset($_SESSION['id'])) {
  $_SESSION['noses'] = 'yes';
}

// get data akun
$id = $_SESSION['id'];
$get = mysqli_query($conn, "SELECT * FROM akun WHERE id_akun = '$id'");
$fetch = mysqli_fetch_object($get);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun | Cerita Aja!</title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>public/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
</head>
<body>
<!-- Start Navbar -->
<nav class="navbar navbar-dark">
  <a class="navbar-brand" href="#" data-toggle="modal" data-target="#exampleModal">
    <img src="<?= BASE_URL; ?>public/img/icon.png" width="130" class="d-inline-block align-top" alt="">
  </a>
</nav>
<!-- End -->

<!-- Memberikan container supaya semua element terbungkus dalam wrapper (tidak rata kiri maupun kanan) -->
<div class="container">
    <!-- Responsive bawaan bootstrap dgn teknik Grid -->
    <div class="card" style="text-align: center; font-family: 'Secular One', sans-serif; align-items: center; justify-content: center;">
        <h2 class="mt-3">PROFILE AKUN</h2>
      <div class="card mb-1 mt-2 pt-2" style="max-width: 540px;">
      <div class="row no-gutters">
        <div class="col-md-4">
          <img src="https://i.pinimg.com/originals/2a/df/fb/2adffbee6e939b2bd1e32ffa8c763308.jpg" class="card-img" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><?= strtoupper($fetch->nama) ?></h5>
            <p class="card-text">
            <ul class="list-group">
              <li class="list-group-item">Username : <?= $fetch->username ?></li>
              <li class="list-group-item">Gender : <?= $fetch->gender ?></li>
              <li class="list-group-item">Status : <?= $fetch->status ?></li>
              <li class="list-group-item">IP Adress : <?= $_SERVER['SERVER_ADDR']; ?></li>
              <li class="list-group-item">Device : <?= $_SERVER['HTTP_USER_AGENT'] ?></li>
            </ul>
            </p>
            <p class="card-text"><small class="text-muted">Terdaftar <?= $fetch->waktu_daftar ?></small></p>
          </div>
        </div>
      </div>
    </div><br>
        <a class="btn btn-info keluar mb-4" href="logout.php">Keluar Akun</a>
      </div>
    </div>
  </div>
</body>
    <!-- JS -->
    <script src="<?= BASE_URL; ?>public/js/jquery.min.js"></script>
    <script src="<?= BASE_URL; ?>public/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
    <!-- apakah user sudah login? -->
    <?php

    if($_SESSION['noses'] === 'yes') {
        echo "<script>
        Swal.fire({
            type: 'success',
            title: 'Terdeteksi!',
            text: 'Kamu belum login, tidak bisa mengakses portal!',
            timer: 1000,
            showConfirmButton: true
        })
        .then (function() {
            window.location.href = 'index.php';
        });
        </script>";
    }

    ?>
    <script>
      // pastikan jika logout
      $(document).ready(function() {
        $('.keluar').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        Swal.fire({
            title: 'Yakin ingin keluar dari sesi?',
            text: 'Cokkies akan dihapus permanen jika logout',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Pengen keluar!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value === true) {
              // lempar ke logout.php
              location.href = url;
            }
        });
        })
      })
    </script>
</html>