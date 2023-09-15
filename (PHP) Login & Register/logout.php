<?php

require_once 'inc/config.php';

session_destroy();
setcookie('key', '', 0, '/');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Secular One', sans-serif;
        }
    </style>
</head>
<body>
    <script>
    Swal.fire({
        type: 'success',
        title: 'Berhasil Keluar',
        text: 'Cookie / Session milikmu sudah lenyap.',
        timer: 2500,
        showConfirmButton: true
    })
    .then (function() {
        window.location.href = 'index.php';
    });
    </script>
</body>
</html>