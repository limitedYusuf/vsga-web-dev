<?php

session_start();

// set waktu WITA
date_default_timezone_set('Asia/Makassar');

// set URL
define('BASE_URL', 'http://vsga-auth.test/');

// DB
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '75117');
define('DB_NAME', 'vsga-auth');

$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// err db
if(!$conn) {
    echo "<script>alert('Perhatikan konfigurasi database');</script>";
}
?>