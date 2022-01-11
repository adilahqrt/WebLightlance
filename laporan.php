<?php 
session_start();

if(!isset($_SESSION["login"])){
  header("Location: index.php");
  exit;
}
include('koneksi.php');
$admin2 = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin");
$row = mysqli_fetch_array($admin2);

  $tgl_mulai = "-";
  $tgl_selesai = "-";
  if(isset($_POST['cetak'])){
    $tgl_mulai = $_POST['tglm'];
    $tgl_selesai = $_POST['tgls'];
}
?>


<!doctype html>
<html>
    <head>
        <title>Laporan Pemesanan</title>
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
                    <a href="logout.php" onclick="return confirm('Apakah yakin anda akan logout?')">
                    <button style="background-color: red; color: white; width: 180px; border-radius: 5px; border-color: white; 
                                    margin-left: 15px; margin-top: 10px">Logout</button></a>
                </ul>
            </div> 

            <!-- Menu Admin -->
                <div class="col-md-10 p-5" style="margin-top: 50px;">
                    <h3>Laporan Pemesanan</h3><hr>

                    <form action="" method="post">
                        <input type="text" name="pencarian" size="30" autofocus placeholder="Pencarian..." autocomplete="off"
                        style="border-radius:5px; margin-right: 5px;">
                        <button type="submit" name="cari" style="border-radius:5px;">Cari</button>
                    </form><br>

                    <form action="cetaklaporan.php" method="post" style="margin-bottom: 15px;">
                        <p style="padding-top:5px;"><b>Pilih Data Pemesanan untuk Dicetak</b></p>
                        <div class="row">
                            <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tanggal Mulai</label>
                                <input type="date" class="form-control" name="tglm" value="<?= $tgl_mulai; ?>">
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tanggal Selesai</label>
                                <input type="date" class="form-control" name="tgls" value="<?= $tgl_selesai; ?>">
                            </div>
                            </div>
                            <div class="col-md-2">
                            <label for="">&nbsp;</label><br>
                            <button class="btn btn-secondary active" name="cetak" style="border-radius:10px;">Cetak</button>
                            </div>
                            
                        </div>
                    </form>

                    <table class="table" style="text-align: center">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Pemesanan</th>
                            <th scope="col">Nama Pemesan</th>
                            <th scope="col">Tanggal Pemesanan</th>
                            <th scope="col">Alamat Pemesanan</th>
                            <th scope="col">Paket</th>
                            <th scope="col">Status Pemesanan</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        $batas = 5;
                        $hal   = @$_GET['page'];
                        if(empty($hal)){
                            $posisi = 0;
                            $hal = 1;
                        } else {
                            $posisi = ($hal - 1) * $batas;
                        }
                        $no = 1;
                        if($_SERVER['REQUEST_METHOD'] == "POST"){
                            $pencarian = trim(mysqli_real_escape_string($koneksi, $_POST['pencarian']));
                            if($pencarian != ''){
                                $sql = "SELECT * FROM pemesanan INNER JOIN user ON pemesanan.id_user=user.id_user INNER JOIN paket 
                                        ON pemesanan.id_paket=paket.id_paket WHERE fullname LIKE '%$pencarian%' OR id_pemesanan 
                                        LIKE '%$pencarian%' OR tgl_pemesanan LIKE '%$pencarian%' OR alamat LIKE '%$pencarian%' OR nama_paket
                                        LIKE '%$pencarian%' OR status_pemesanan LIKE '%$pencarian%'";
                                $query = $sql;
                                $queryJml = $sql;
                            }else{
                                $query = "SELECT * FROM pemesanan INNER JOIN user ON pemesanan.id_user=user.id_user INNER JOIN paket 
                                        ON pemesanan.id_paket=paket.id_paket ORDER BY id_pemesanan DESC LIMIT $posisi, $batas";
                                $queryJml = "SELECT * FROM pemesanan";
                                $no = $posisi + 1;
                            }
                        }else{
                            $query = "SELECT * FROM pemesanan INNER JOIN user ON pemesanan.id_user=user.id_user INNER JOIN paket 
                            ON pemesanan.id_paket=paket.id_paket ORDER BY id_pemesanan DESC LIMIT $posisi, $batas";
                            $queryJml = "SELECT * FROM pemesanan";
                            $no = $posisi + 1;
                        }
                        //query ke database SELECT tabel admin berdasarkan id yang terkecil
                        $sql_pemesanan = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
                            //melakukan perulangan while dengan dari query $sql
                            while($data = mysqli_fetch_array($sql_pemesanan)){
                                //menampilkan data perulangan
                                echo '
                                <tr style="text-align: center">
                                    <td>'.$no++.'</td>
                                    <td>'.$data['id_pemesanan'].'</td>
                                    <td>'.$data['fullname'].'</td>
                                    <td>'.$data['tgl_pemesanan'].'</td>
                                    <td>'.$data['alamat'].'</td>
                                    <td>'.$data['nama_paket'].'</td>
                                    <td>'.$data['status_pemesanan'].'</td>
                                    <td>
                                        <a href="delete_paket.php?id_paket='.$data['id_pemesanan'].'" class="btn btn-danger btn-sm" onclick=" return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
                                    </td>
                                </tr>
                                ';
                            }
                        ?>
            </tbody>
        </table>
        <?php
        if(@$_POST['pencarian'] == ''){ ?>
            <div style ="float:left;">
                <?php
                $jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
                echo "Jumlah Data : <b>$jml</b>";
                ?>
            </div>
            <div>
                    <?php
                    $jml_hal = ceil($jml / $batas);
                    ?>
                    </li>
                </ul>
            </div>
        <nav aria-label="Page navigation example">
		<ul class="pagination" style="justify-content: right;">
			<!-- Awal Tombol sebelumnya -->
			<?php if ($hal <= 1) { ?>
				<li class="page-item disabled">
					<a class="page-link" href="?page=<?php echo $hal - 1; ?>">Previous</a>
				</li>
			<?php } else { ?>
				<li class="page-item">
					<a class="page-link" href="?page=<?php echo $hal - 1; ?>">Previous</a>
				</li>
			<?php } ?>
			<!-- Akhir Tombol sebelumnya -->

			<?php
				for ($i=1; $i <= $jml_hal; $i++) { 
			?>
			<li class="page-item">
              <?php if ( $i == $hal) :?>
                <a class="page-link" style="font-weight: bold;" href="?page=<?php echo $i ?>"><?php echo $i; ?></a>
              <?php else :?>
                <a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i; ?></a>
              <?php endif?>
            </li>
			<?php } ?>

			<!-- Awal Tombol Sesudah -->
			<?php if ($hal >= $jml_hal) { ?>
				<li class="page-item disabled">
					<a class="page-link" href="?page=<?php echo $hal + 1; ?>">Next</a>
				</li>
			<?php } else { ?>
				<li class="page-item">
					<a class="page-link" href="?page=<?php echo $hal + 1; ?>">Next</a>
				</li>
			<?php } ?>
			<!-- Akhir Tombol Sesudah -->
			
		</ul>
	</nav>
            <?php
        } else {
            echo "<div style=\"float:left;\">";
            $jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
            echo "Data Hasil Pencarian : <b>$jml</b>";
            echo "</div>";
        }
        ?>
        </div>
        
        </div>
    </div>

        
        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="sidebars.js"></script>
    </body>
</html>