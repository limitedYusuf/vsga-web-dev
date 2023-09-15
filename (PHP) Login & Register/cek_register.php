<?php

require_once 'inc/config.php';

  // get value
  $nama = $_POST['_nama'];
  $gender = $_POST['_gender'];
  $username = $_POST['_username'];
  // mengubah string password dalam 1 arah (tidak bisa dibajak)
  $password = password_hash($_POST['_password'], PASSWORD_DEFAULT);
  $pass = $_POST['_password'];
  $waktu = date('Y-m-d');

      // saya ingin memastikan bahwa username dia belum ada yang tersimpan di db
      $username_cek = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username'");
      $erow = mysqli_num_rows($username_cek);
      if($erow > 0) {
        echo 'terpakai';
      } else {
        // add unique id
        $uniq = mysqli_query($conn, "SELECT MAX(id_akun) AS kode FROM akun");
        $gets = mysqli_fetch_object($uniq);
        $kodes = $gets->kode;
        $end = (int) substr($kodes, 4, 4);
        $end++;

        $str = 'AC-';
        $kode = $str . sprintf("%04s", $end);

        // post ke tb akun
        $input = mysqli_query($conn, "INSERT INTO akun(id_akun,nama,gender,username,password,waktu_daftar) VALUES ('$kode','$nama', '$gender', '$username', '$password', '$waktu')");
        if($input) {
          $_SESSION['id'] = $kode;
          echo 'mantep';
        } else {
          echo 'gagal';
        }
      }