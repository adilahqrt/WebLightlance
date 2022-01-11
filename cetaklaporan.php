<?php
  include('koneksi.php');
  // Memanggil file fpdf yang anda tadi simpan di folder htdoc
  require('fpdf/fpdf.php'); {
  date_default_timezone_set('Asia/Jakarta');// change according timezone
  $currentTime = date( 'd-m-Y h:i:s A', time () );
  }

  // Ukuran kertas PDF
  $pdf = new FPDF("L","cm","A4");

  $pdf->SetMargins(1,1,1,1);
  $pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf->SetFont('Times','B',12);
  $pdf->ln(1);
  $pdf->SetFont('Times','B',12);
  //Format tanggal
  $pdf->Cell(8,0.7,"Printed On : ".date("l, d F Y"),0,0,'C');

  $pdf->ln(1);
  $pdf->SetFont('Times','B',14);
  // from dan edn ini adalah nama dari form star_filter.php yang berfungsi untuk memanggil tanggal yang di atur
  $tgl_mulai = $_POST['tglm'];
  $tgl_selesai = $_POST['tgls'];
  $query=mysqli_query($koneksi,"SELECT * from pemesanan INNER JOIN user ON pemesanan.id_user=user.id_user INNER JOIN paket 
                                ON pemesanan.id_paket=paket.id_paket WHERE tgl_pemesanan BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
  $lihat=mysqli_fetch_array($query);
  if (empty($tgl_mulai) or empty($tgl_selesai)){
    $pdf->Cell(26.5, 2,"Laporan Pemesanan",0,10,'C');
  }else{
    $pdf->Cell(26.5, 2,"Laporan Pemesanan Dari " . $tgl_mulai . " Hingga " . $tgl_selesai,0,10,'C');
  }


  // st font yang ingin anda gunakan
  $pdf->SetFont('Times','B',10);
  // queri yang ingin di tampilkan di tabel sehingga ketika diubah tidak akan berpengaruh
  // Kode 1, 0, 'C' dan banyak kode di bawah adalah ukuran lebar tabel ubah jika tidak sesuai keinginan anda.
  $pdf->Cell(1, 1, 'No', 1, 0, 'C');
  $pdf->Cell(2.5, 1, 'ID Pemesanan', 1, 0, 'C');
  $pdf->Cell(4.5, 1, 'Nama Pemesan', 1, 0, 'C');
  $pdf->Cell(4, 1, 'Tanggal Pemesanan', 1, 0, 'C');
  $pdf->Cell(4, 1, 'Alamat Pemesanan', 1, 0, 'C');
  $pdf->Cell(4, 1, 'Paket', 1, 0, 'C');
  $pdf->Cell(4, 1, 'Status Pemesanan', 1, 1, 'C');
  $pdf->SetFont('Arial','',10);
  
  
  // memanggil database
  if (empty($tgl_mulai) or empty($tgl_selesai)){
        // memanggil database
        $no = 1;
        $query=mysqli_query($koneksi,"SELECT * from pemesanan INNER JOIN user ON pemesanan.id_user=user.id_user INNER JOIN paket 
                                      ON pemesanan.id_paket=paket.id_paket ");
        while($lihat=mysqli_fetch_array($query)){
          $semuadata[] = $lihat;
        }
      
        foreach($semuadata as $no => $value) {
        // st font yang ingin anda gunakan
        $pdf->SetFont('Times','',10);
        // Queri yang ingin ditampilkan yang berada di database
        
        $pdf->Cell(1, 1, $no+1, 1, 0, 'C');
        $pdf->Cell(2.5, 1, $value['id_pemesanan'], 1, 0,'C');
        $pdf->Cell(4.5, 1, $value['fullname'], 1, 0,'C');
        $pdf->Cell(4, 1, $value['tgl_pemesanan'], 1, 0,'C');
        $pdf->Cell(4, 1, $value['alamat'], 1, 0,'C');
        $pdf->Cell(4, 1, $value['nama_paket'], 1, 0,'C');
        $pdf->Cell(4, 1, $value['status_pemesanan'], 1, 1,'C');
      }
        $pdf->ln(1);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(40.5, 0.7,"Disetujui Oleh, " ,0,10,'C');

        $pdf->ln(2);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(40.5,0.7,"Owner Lightlance",0,10,'C');
        // Nama file ketika di print
        $pdf->Output("Laporan Pemesanan.pdf","I");
  }else{
  $query=mysqli_query($koneksi,"SELECT * from pemesanan INNER JOIN user ON pemesanan.id_user=user.id_user INNER JOIN paket 
                                ON pemesanan.id_paket=paket.id_paket WHERE tgl_pemesanan BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
  while($lihat=mysqli_fetch_array($query)){
    $semuadata[] = $lihat;
  }
 
  foreach($semuadata as $no => $value) {
 
  // st font yang ingin anda gunakan
  $pdf->SetFont('Times','',10);
  // Queri yang ingin ditampilkan yang berada di database
  
  $pdf->Cell(1, 1, $no+1, 1, 0, 'C');
  $pdf->Cell(2.5, 1, $value['id_pemesanan'], 1, 0,'C');
  $pdf->Cell(4.5, 1, $value['fullname'], 1, 0,'C');
  $pdf->Cell(4, 1, $value['tgl_pemesanan'], 1, 0,'C');
  $pdf->Cell(4, 1, $value['alamat'], 1, 0,'C');
  $pdf->Cell(4, 1, $value['nama_paket'], 1, 0,'C');
  $pdf->Cell(4, 1, $value['status_pemesanan'], 1, 1,'C');
  }

  //total harga

  $pdf->ln(1);
  $pdf->SetFont('Times','B',12);
  $pdf->Cell(40.5, 0.7,"Disetujui Oleh, " ,0,10,'C');

  $pdf->ln(2);
  $pdf->SetFont('Times','B',12);
  $pdf->Cell(40.5,0.7,"Owner Lightlance",0,10,'C');
  // Nama file ketika di print
  $pdf->Output("Laporan Pemesanan.pdf","I");
  }
?>