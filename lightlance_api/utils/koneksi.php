<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "lightlance";
    $koneksi = mysqli_connect($server, $username, $password, $db);
    //pastikan urutan pemanggilannya sama

    //untuk cek jika koneksi gagal ke database
    if(mysqli_connect_error()) {
        echo "Koneksi gagal : ".mysqli_connect_error();
    }
