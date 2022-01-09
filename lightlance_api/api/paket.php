<?php
require_once "../utils/koneksi.php";
   if(function_exists($_GET['function'])) {
         $_GET['function']();
      }   
   function get_paket()
   {
      global $koneksi;      
      $query = $koneksi->query("SELECT * FROM paket INNER JOIN kategori ON paket.id_kategori=kategori.id_kategori");            
      while($row=mysqli_fetch_object($query))
      {
         $data[] =$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Success',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }   
   
   function get_paket_id()
   {
      global $koneksi;
      $myArray = array();
      if(isset($_GET['id'])){
         $id=$_GET['id'];
      
         if($result = mysqli_query($koneksi, "SELECT * FROM paket WHERE id_paket=$id")){
            while ($row = $result->fetch_array(MYSQLI_ASSOC)){
                  $myArray[] = $row;
            }
         }
      }

      if($myArray)
      {
      $response = array(
                     'status' => 1,
                     'message' =>'Success',
                     'data' => $myArray
                  );               
      }else {
         $response=array(
                     'status' => 0,
                     'message' =>'No Data Found'
                  );
      }

      header('Content-Type: application/json');
      echo json_encode($response);
   }

   function get_paket_by_kategori() {
      global $koneksi;
      $myArray = array();
      if(isset($_GET['id'])){
         $id=$_GET['id'];
      
         if($result = mysqli_query($koneksi, "SELECT * FROM paket WHERE id_kategori=$id")){
            while ($row = $result->fetch_array(MYSQLI_ASSOC)){
                  $myArray[] = $row;
            }
         }
      }

      if($myArray)
      {
      $response = array(
                     'status' => 1,
                     'message' =>'Success',
                     'data' => $myArray
                  );               
      }else {
         $response=array(
                     'status' => 0,
                     'message' =>'No Data Found'
                  );
      }

      header('Content-Type: application/json');
      echo json_encode($response);
   }

   function insert_paket()
      {
         global $koneksi;
            //Mendapatkan variabel POST
            $nama_paket = isset($_POST["nama_paket"]) ? $_POST["nama_paket"] : "";
            $harga_paket = isset($_POST["harga_paket"]) ? $_POST["harga_paket"] : "";
            $deskripsi   = isset($_POST["deskripsi"]) ? $_POST["deskripsi"] : "";
            $id_kategori = isset($_POST["id_kategori"]) ? $_POST["id_kategori"] : "";

            //Query menambahkan data
            $sql = "INSERT INTO `paket` (`nama_paket`, `harga_paket`, `deskripsi`, `id_kategori`) 
                     VALUES ('".$nama_paket."', '".$harga_paket."', '".$deskripsi."', '".$id_kategori."')";

            //Running Query
            $query = mysqli_query($koneksi, $sql);

            if($query)
            {
            $response = array(
                           'status' => 1,
                           'message' =>'Simpan Data Berhasil',
                        );               
            }else {
               $response=array(
                           'status' => 0,
                           'message' =>'Simpan Data Gagal'
                        );
            }

            header('Content-Type: application/json');
            echo json_encode($response);
      }
 ?>