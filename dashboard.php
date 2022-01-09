<?php 
session_start();

if(!isset($_SESSION["login"])){
  header("Location: index.php");
  exit;
}

include ('koneksi.php');
$sql1 = "SELECT * FROM admin";
$sql2 = "SELECT * FROM user";
$sql3 = "SELECT * FROM pemesanan";
$sql4 = "SELECT * FROM paket";
$sql5 = "SELECT * FROM kategori";
$data1 = mysqli_query($koneksi, $sql1);
$data2 = mysqli_query($koneksi, $sql2);
$data3 = mysqli_query($koneksi, $sql3);
$data4 = mysqli_query($koneksi, $sql4);
$data5 = mysqli_query($koneksi, $sql5);
$admin     = mysqli_num_rows($data1);
$pelanggan = mysqli_num_rows($data2);
$pemesanan = mysqli_num_rows($data3);
$paket     = mysqli_num_rows($data4);
$kategori  = mysqli_num_rows($data5);
$admin2 = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin");
$row = mysqli_fetch_array($admin2);

?>

<!doctype html>
<html>
    <head>
        <title>Dashboard</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">

        <!-- Bootstrap core CSS -->
        <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Custom styles for this template -->
        <link href="admin.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>

        <!-- Menu Bar -->
        <div class="row no-gutters">
            <div class="col-md-2 pr-3 pt-4" style="background-color: #32AF85; height: wrap-content;">
                <ul class="nav flex-column ml-3 mb-5">
                    <h2 style="text-align: center; color:white; font-family:'Pacifico', sans serif;">LightLance</h2>

                    <li>
                        </br>
                        <a class="navbar-brand" href="#" style="margin-left: 30px;">
                          <img src="img/<?php echo $row['foto']; ?>" width="50" style="margin-left: 50px; border-radius: 100%;">
                        </a>
                        <a class="nav-link" align="center" style="color: white;">Selamat Datang <?php echo $row['user_fullname']; ?></a>
                        <a class="nav-link" style="color: white; margin-bottom: -30px;" href="edit_profil.php" align="center"><u>Edit Profil</u></a>
                    </li>

                    <a class="nav-link active text-white mt-5" aria-current="page" href="dashboard.php">Dashboard</a><hr style="background-color: #ffffff;">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-white" href="pelanggan.php">Pelanggan</a><hr style="background-color: #ffffff;">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-white" href="paket.php">Paket</a><hr style="background-color: #ffffff;">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-white" href="kategori.php">Kategori</a><hr style="background-color: #ffffff;">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-white" href="laporan.php">Laporan Pemesanan</a><hr style="background-color: #ffffff;">
                    </li>
                    <a href="logout.php"><button style="background-color: red; color: white; width: 180px; border-radius: 5px; border-color: white; 
                                         margin-left: 15px; margin-top: 10px">Logout</button></a>
                </ul>
            </div> 

<!-- Isi Menu -->
<div class="col-md-10 p-5" style="margin-top: 6;">
        <h3>DASHBOARD</h3><hr>
        <div class="row"></div>
          <div class="card bg-white text-black ml-3" style="width: 16rem; border-radius: 15%; border-color: #32AF85; margin-top: 0.5cm; border-width: 3px; margin-left: 100px; ">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-user"></i>
              </div>
              <h5 class="card-title text-black">Jumlah Kategori</h5>
              <div class="display-4"><?php echo $kategori?></div>
              <a href="kategori.php"><p class="card-text mr-2 text-black">Lihat Detail</p></a>
            </div>
          </div>

        <div class="row"></div>
          <div class="card bg-white text-black ml-3" style="width: 16rem; border-radius: 15%; border-color: #32af85; margin-top: 2cm; border-width: 3px; margin-left: 100px;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-user"></i>
              </div>
              <h5 class="card-title text-black">Jumlah Paket</h5>
              <div class="display-4"><?php echo $paket?></div>
              <a href="paket.php"><p class="card-text mr-2 text-black">Lihat Detail</p></a>
            </div>
          </div>
          
        <div class="row"></div>
          <div class="card bg-white text-black ml-3" style="width: 16rem; height: 155px; border-radius: 15%; border-color: #32af85; margin-left: 10cm; margin-top: -10.5cm; border-width: 3px; margin-left: 500px;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-user"></i>
              </div>
              <h5 class="card-title text-black">Jumlah Pelanggan</h5>
              <div class="display-4"><?php echo $pelanggan?></div>
              <a href="pelanggan.php"><p class="card-text mr-2 text-black">Lihat Detail</p></a>
            </div>

        <div class="row"></div>
          <div class="card bg-white text-black ml-3" style="width: 16rem; border-radius: 15%; border-color: #32af85; margin-top: 2cm; border-width: 3px ">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-user"></i>
              </div>
              <h5 class="card-title text-black">Jumlah Laporan</h5>
              <div class="display-4"><?php echo $pemesanan?></div>
              <a href="laporan.php"><p class="card-text mr-2 text-black">Lihat Detail</p></a>
            </div>
           
      </div>
    </div>

        
        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="sidebars.js"></script>
    </body>
</html>