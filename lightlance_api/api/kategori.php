<?php
require_once "../utils/koneksi.php";
   if(function_exists($_GET['function'])) {
         $_GET['function']();
      }   
   function get_kategori()
   {
      global $koneksi;      
      $query = $koneksi->query("SELECT * FROM kategori");            
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
   
   function get_kategori_id()
   {
      global $koneksi;
      $myArray = array();
      if(isset($_GET['id'])){
         $id=$_GET['id'];
      
         if($result = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori=$id")){
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
   
   function insert_kategori()
      {
         global $koneksi;
            //Mendapatkan variabel POST
            $nama_kategori  = isset($_POST["nama_kategori"]) ? $_POST["nama_kategori"] : "";
            $image_kategori = isset($_POST["image_kategori"]) ? $_POST["image_kategori"] : "";

            //Query menambahkan data
            $sql = "INSERT INTO `kategori` (`nama_kategori`, `image_kategori`) VALUES ('".$nama_kategori."', '".$image_kategori."')";

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