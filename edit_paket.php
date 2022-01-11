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

<div class="container" style="margin-top:20px">
    <title>Edit Data</title>
    <h2>Edit Data Paket</h2>

    <hr>

    <?php
    if(isset($_GET['id_paket'])){
        $id = $_GET['id_paket'];
        $select = mysqli_query($koneksi, "SELECT * FROM paket WHERE id_paket='$id'") or die(mysqli_error($koneksi));

        if(mysqli_num_rows($select) == 0){
            echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
            exit();
        }else{
            $data = mysqli_fetch_assoc($select);
        }
    }
    ?>

    <?php
    if(isset($_POST['submit'])){

        $sql =  $koneksi->query("UPDATE paket SET nama_paket='$_POST[nama_paket]', harga_paket='$_POST[harga_paket]', deskripsi='$_POST[deskripsi]', id_kategori='$_POST[id_kategori]' WHERE id_paket='$_GET[id_paket]'");
        
        if($sql){
            echo '<script>alert("Berhasil menyimpan data."); document.location="paket.php";</script>';
        }else{
            echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
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
    <title>EDIT DATA ADMIN</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">

    

<!-- Bootstrap core CSS -->
<link href="../lightlance/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="sidebars.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
  </head>
  <body>

<div class="container">
<h1 class="text-center mt-3">EDIT DATA ADMIN</h1>

<!--Awal card form-->
    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
        Form Edit Data Admin
        </div>
        <div class="card-body">
            <form action="edit_paket.php?id_paket=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Paket</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" name="nama_paket" class="form-control" value="<?php echo $data['nama_paket']; ?>" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Harga Paket</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="number" name="harga_paket" class="form-control" value="<?php echo $data['harga_paket']; ?>" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Deskripsi</label>
                    <div class="col-md-6 col-sm-6">
                        <textarea style="width:600px; height:300px "name="deskripsi" class="form-control" required><?php echo $data['deskripsi']; ?></textarea>
                    </div>
                </div>
                <div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">Kategori</label>
					<div class="col-md-6 col-sm-6">
					<select name="id_kategori" id="" class="form-control">
						<option value="id_kategori"> -Pilih- </option>
						<?php foreach($datakategori as $key => $value): ?>
						<option value="<?= $value['id_kategori'] ?>"><?= $value['nama_kategori']; ?></option>
						<?php endforeach; ?>
					</select>
				</div><br>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                        <a href="paket.php" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </form>
        
        </div>
    </div>
<!--Akhir card form-->
</div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="sidebars.js"></script>
</body>
</div>