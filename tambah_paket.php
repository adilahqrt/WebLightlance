<?php
session_start();

if(!isset($_SESSION["login"])){
  header("Location: index.php");
  exit;
}

include('koneksi.php'); 
$datakategori = [];
$ambil = $koneksi->query("SELECT * FROM kategori");
while($tiap = $ambil->fetch_assoc()){
	$datakategori[] = $tiap;
}
?>

		<center><font size="6">Tambah Data</font></center>
		<title>Tambah Data Paket</title>
		<hr>
		<?php
		if(isset($_POST['submit'])){

				$sql = $koneksi->query("INSERT INTO paket VALUES ('', '$_POST[nama_paket]', '$_POST[harga_paket]', '$_POST[deskripsi]', '$_POST[id_kategori]')");

				if($sql){
					echo '<script>alert("Berhasil menambahkan data."); document.location="paket.php";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
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
    <title>TAMBAH DATA ADMIN</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">

    

    <!-- Bootstrap core CSS -->
<link href="../lightlance/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="sidebars.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
  </head>
  <body>

<div class="container">
<h1 class="text-center mt-3">TAMBAH DATA ADMIN</h1>

<!--Awal card form-->
    <div class="card mt-3">
        <div class="card-header bg-primary text-white" enctype="multipart/form-data">
        Form Tambah Data Admin
        </div>
        <div class="card-body">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Paket</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" name="nama_paket" class="form-control" required>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">Harga Paket</label>
					<div class="col-md-6 col-sm-6">
						<input type="number" name="harga_paket" class="form-control" required>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">Deskripsi</label>
					<div class="col-md-6 col-sm-6">
					<textarea style="width:600px; height:300px " name="deskripsi" class="form-control" required></textarea>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">Kategori</label>
					<div class="col-md-6 col-sm-6">
					<select name="id_kategori" id="" class="form-control">
						<option value="">Pilih kategori</option>
						<?php foreach($datakategori as $key => $value): ?>
						<option value="<?= $value['id_kategori'] ?>"><?= $value['nama_kategori']; ?></option>
						<?php endforeach; ?>
					</select>
				</div><br>
				</div>
				<div class="item form-group">
					<div  class="col-md-6 col-sm-6 offset-md-3">
						<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
						<a href="paket.php" class="btn btn-danger">Kembali</a>
				</div>
			</form>
        </div>
    </div>
<!--Akhir card form-->
</div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="sidebars.js"></script>
</body>