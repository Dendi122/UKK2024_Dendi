<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';
session_start();

	// membuat variabel untuk menampung data dari form
  $fotoid = $_POST['fotoid'];
  $judulfoto  = $_POST['judulfoto'];
  $deskripsifoto = $_POST['deskripsifoto'];
  $albumid = $_POST['albumid'];
  $lokasifile = $_FILES['lokasifile']['name'];
  //cek dulu jika merubah gambar produk jalankan coding ini
  if($lokasifile != "") {
    $ekstensi_diperbolehkan = array('png','jpg','jpeg','gif'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $lokasifile); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['lokasifile']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$lokasifile; //menggabungkan angka acak dengan nama file sebenarnya
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                      
                    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                   $query  = "UPDATE foto SET judulfoto = '$judulfoto', deskripsifoto = '$deskripsifoto', lokasifile = '$nama_gambar_baru', albumid = '$albumid'";
                    $query .= "WHERE fotoid = '$fotoid'";
                    $result = mysqli_query($conn, $query);
                    // periska query apakah ada error
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
                    } else {
                      //tampil alert dan akan redirect ke halaman index.php
                      //silahkan ganti index.php sesuai halaman yang akan dituju
                      echo "<script>alert('Data berhasil diubah.');window.location='foto.php';</script>";
                    }
              } else {     
               //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='foto.php';</script>";
              }
    } else {
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE foto set judulfoto='$judulfoto',deskripsifoto='$deskripsifoto',albumid='$albumid'";
      $query .= "WHERE fotoid = '$fotoid'";
      $result = mysqli_query($conn, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='foto.php';</script>";
      }
    }

 

