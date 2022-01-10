<?php
    $server = "localhost";
    $username = "u1694897_c_reg_4";
    $password = "jtipolije";
    $db = "u1694897_c_reg_4_db";
    $koneksi = mysqli_connect($server, $username, $password, $db);
    //pastikan urutan pemanggilannya sama

    //untuk cek jika koneksi gagal ke database
    if(mysqli_connect_error()) {
        echo "Koneksi gagal : ".mysqli_connect_error();
    }
