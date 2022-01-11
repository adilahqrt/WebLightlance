<?php
    session_start();

    if(!isset($_SESSION["login"])){
      header("Location: index.php");
      exit;
    }
    
  include('koneksi.php');
  $admin  = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin");
  $row = mysqli_fetch_array($admin);
    
    if(isset($_POST['ubah'])){
        $user_email      = $_POST['user_email'];
        $user_password   = $_POST['user_password'];
        $user_fullname   = $_POST['user_fullname'];
        $sumber          = $_FILES['foto']['tmp_name'];
        $target          = 'img/';
        $nama_gambar     = $_FILES['foto']['name'];

        if($nama_gambar == ""){
            $sql1 = mysqli_query($koneksi, "UPDATE admin SET user_email='$user_email', user_password='$user_password', user_fullname='$user_fullname'
                                            WHERE id_admin") or die(mysqli_error($koneksi));
            if($sql1){
                echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php";</script>';
                }else{
                echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
                }
        } else {
            $pindah = move_uploaded_file($sumber, $target.$nama_gambar);
            if($pindah)
            $sql = mysqli_query($koneksi, "UPDATE admin SET user_email='$user_email', user_password='$user_password', user_fullname='$user_fullname', foto ='$nama_gambar' WHERE id_admin") or die(mysqli_error($koneksi));
                if($sql){
                echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php";</script>';
                }else{
                echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
                }
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>EDIT PROFIL</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">

    

    <!-- Bootstrap core CSS -->
<link href="../lightlance/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="sidebars.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
  </head>
  <body>

<div class="container">
<h1 class="text-center mt-3">EDIT DATA PROFIL</h1>

<!--Awal card form-->
    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
        Form Edit Profil
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $row['id_admin']; ?>" name="id_admin" class="form-control">
                <div class="form-group" style="padding: 10px;">
                <label for="">Email</label>
                <input type="text" class="form-control" value="<?php echo $row['user_email']; ?>" name="user_email">
                </div>
                <div class="form-group" style="padding: 10px;">
                <label for="">Password</label>
                <input type="text" class="form-control" value="<?php echo $row['user_password']; ?>" name="user_password">
                </div>
                <div class="form-group" style="padding: 10px;">
                <label for="">Nama Lengkap</label>
                <input type="text" class="form-control" value="<?php echo $row['user_fullname']; ?>" name="user_fullname">
                </div>
                <div class="form-group" style="padding: 10px;">
                <label for="">Foto Profil</label><br>
                <img src="img/<?php echo $row['foto']; ?>" width="200">
                </div>
                <div class="form-group" style="padding: 10px;">
                <label for="">Ganti Foto</label>
                <input type="file" name="foto" class="form-control">
                </div>
                <button name="submit" class="btn btn-danger" style="margin-top: 20px; margin-left: 10px; border-radius:10px">
                        <a href="dashboard.php" style="color: white; text-decoration: none;">Batal</a></button>
                <button name="ubah" class="btn btn-primary" style="margin-top: 20px; margin-left: 10px; border-radius:10px">Ubah</button>
            </form>
           </div>
<!--Akhir card form-->
</div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="sidebars.js"></script>
</body>