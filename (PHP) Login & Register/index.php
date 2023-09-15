<?php

require_once 'inc/config.php';

// cek apakah kue masih ada
if(isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    // samakan
    $query = mysqli_query($conn, "SELECT * FROM akun WHERE id_akun = $id");
    $rows = mysqli_fetch_object($query);
    if($key === hash('sha256', $rows->username)) {
        $_SESSION['id'] = $rows->id_akun;
        $_SESSION['active'] = 'ya';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Cerita Aja!</title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>public/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
        <div class="row px-3">
            <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
                <div class="img-kiri d-none d-md-flex"></div>
                <!-- Wrapper login -->
                <div class="card-body">
                    <h4 class="title text-center mt-4">
                        Silahkan login untuk melihat Portal
                    </h4>
                    <div class="form-box px-3">
                        <div class="form-input">
                            <span><i class="fa fa-user-secret"></i></span>
                            <input type="text" name="_username" id="user" placeholder="Username" autocomplete="off" tabindex="10"
                              >
                        </div>
                        <div class="form-input">
                            <span><i class="fa fa-key"></i></span>
                            <input type="password" name="_password" id="pass" placeholder="Password">
                        </div>

                        <div class="mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input ingat" value="ya" id="cb1" name="_ingat">
                                <label class="custom-control-label" for="cb1">Ingat aku (1 minggu)</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="masuk" class="btn btn-block text-uppercase join">
                                Login
                            </button>
                        </div>

                        <div class="text-right">
                            <a href="#" class="lupa">
                                Lupa Password?
                            </a>
                        </div>

                        <div class="my-3"></div>

                        <div class="text-center mb-1">
                            Belum punya akun?
                            <a href="register.php" class="daftar">
                                Daftar Sekarang
                            </a>
                        </div>

                        <hr class="my-2">
                        <div class="text-center mb-2">
                            <p>"Berani menceritakan masalahmu merupakan suatu tantangan yang berat."</p>
                        </div>
                    </div>
                </div>
                <!-- End Wrapper login -->
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">INFO TERSEMBUNYI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Jika kamu sering post dan terdeteksi aman maka admin akan memberimu lencana "Star"</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Mantap</button>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- JS -->
<script src="<?= BASE_URL; ?>public/js/jquery.min.js"></script>
<script src="<?= BASE_URL; ?>public/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

<!-- Cek Cookies -->
<?php

if($_SESSION['active'] == 'ya') {
    echo "<script>
    Swal.fire({
        type: 'success',
        title: 'Terdeteksi!',
        text: 'Remember me masih tersedia, Enjoy :)',
        timer: 2500,
        showConfirmButton: true
    })
    .then (function() {
        window.location.href = 'portal.php';
    });
    </script>";
}

?>

<!-- AJAX -->
<script>
    $(document).ready(function() {
        // jika tombol submit yes
        $('.join').click(function() {
            var user = $('#user').val();
            var pass = $('#pass').val();
            var ingat = $('.ingat').val();
        // validasi input kosong
            if(user.length == '' && pass.length == '') {
              Swal.fire({
              type: 'warning',
              title: 'Terciduk!',
              text: 'Username & Password tidak boleh kosong :('
            });
            } else if(user.length == '') {
              Swal.fire({
              type: 'warning',
              title: 'Terciduk!',
              text: 'Username tidak boleh kosong :('
            });
            } else if(pass.length == '') {
              Swal.fire({
              type: 'warning',
              title: 'Terciduk!',
              text: 'Password tidak boleh kosong :('
            });
            } else {
                // execute ke query pake ajax
                $.ajax({
                url: 'cek_login.php',
                type: 'POST',
                data: {
                    '_username': user,
                    '_password': pass,
                    '_ingat': ingat
                },
                success:function(response){

                if (response == 'berhasil') {
                    Swal.fire({
                    type: 'success',
                    title: 'Login Berhasil!',
                    text: 'Menuju tak terbatas dan melampaui nya.',
                    timer: 2000,
                    showConfirmButton: true
                    })
                    .then (function() {
                        window.location.href = 'portal.php';
                    });
                } else if(response == 'gagal') {
                    Swal.fire({
                    type: 'error',
                    title: 'Login Gagal!',
                    text: 'Password yang kamu input salah.'
                    });
                } else {
                    Swal.fire({
                    type: 'error',
                    title: 'Login Gagal!',
                    text: 'Username tidak tersedia di Database.'
                    });
                }
                console.log(response);
                },
                error:function(response){

                    Swal.fire({
                    type: 'error',
                    title: 'Hmmm.....',
                    text: 'Seperti nya ada masalah pada AJAX'
                    });

                    console.log(response);
                }
                });
            }
        })
    });
</script>


</html>