<?php

require_once 'inc/config.php';

  // get value
  $username = mysqli_real_escape_string($conn, $_POST['_username']);
  $password = mysqli_real_escape_string($conn, $_POST['_password']);
        // cek apakah username terdaftar
        $cek = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username'");
        $rows = mysqli_num_rows($cek);
        $data = mysqli_fetch_object($cek);

        if($rows > 0) {
            if(password_verify($password, $data->password)) {
            // password benar
            // cek apakah user mau set kue 7 hari
            if($_POST['_ingat'] == 'ya') {
                setcookie('id', $data->id_akun, time() + (60 * 60 * 24 * 7), '/');
                setcookie('key', hash('sha256', $data->username), time() + (60 * 60 * 24 * 7), '/');
            }
            $_SESSION['id'] = $data->id_akun;
            echo 'berhasil';
            } else {
            echo 'gagal';
            }
        } else {
            echo 'miss';
        }