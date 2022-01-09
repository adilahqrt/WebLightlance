<?php 
session_start();

if(!isset($_SESSION["login"])){
  header("Location: index.php");
  exit;
}

include('koneksi.php'); 
?>
		<title>Tambah Data Kategori</title>
		<?php
		if(isset($_POST['submit'])){
			$nama_kategori	= $_POST['nama_kategori'];
			$sumber         = $_FILES['image_kategori']['tmp_name'];
            $target         = 'img/';
            $nama_gambar    = $_FILES['image_kategori']['name'];


                $pindah = move_uploaded_file($sumber, $target.$nama_gambar);
                if($pindah){
                    $sql = mysqli_query($koneksi, "INSERT INTO kategori VALUES('NULL','$nama_kategori', '$nama_gambar')") 
                                                or die(mysqli_error($koneksi));

				    if($sql){
					echo '<script>alert("Berhasil menambahkan data."); document.location="kategori.php";</script>';
				    }else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				    }
                }else{
                    echo '<div class="alert alert-warning">Gagal menambahkan gambar.</div>';
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
    <title>TAMBAH DATA KATEGORI</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">

    

    <!-- Bootstrap core CSS -->
<link href="../lightlance/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="sidebars.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
  </head>
  <body>

<div class="container">
<h1 class="text-center mt-3">TAMBAH DATA KATEGORI</h1>

<!--Awal card form-->
    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
        Form Tambah Data Kategori
        </div>
        <div class="card-body">
            <form action="tambah_kategori.php" method="post" enctype="multipart/form-data">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Kategori</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" name="nama_kategori" class="form-control" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Image Kategori</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" name="image_kategori" class="form-control" required>
                    </div>
                </div><br>
                <div class="item form-group">
                    <div  class="col-md-6 col-sm-6 offset-md-3">
                        <input type="submit" name="submit" class="btn btn-Success" value="Simpan">
                        <a href="kategori.php" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
        
        </div>
    </div>
<!--Akhir card form-->
</div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="sidebars.js"></script>
</body>