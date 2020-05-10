<?php

  include "../../config/class.admin.php";
  include_once '../../config/validation.php';
  include "../../config/library.php";
  include "../../config/fungsi_thumbnail.php";
  
  $user = new User();
  $tanggal=new Tanggal();
  $validation=new Validation();
  $gambar=new Gambar();

  $module = $_GET['module'];
  $act    = $_GET['act'];

  // Hapus user
  if ($module=='soal' AND $act=='hapus'){
        $namafile=$user->detail_soal($_GET['id']);
      // hapus file gambar yang berhubungan dengan berita tersebut
      @unlink("../../photo/$namafile[gambar]");   
      @unlink("../../photo/small_$namafile[gambar]"); 
      // hapus data user di database 
     
     $del=$user->delete_soal($_GET['id']);  
      
    
    header("location:../../index.php?module=".$module);
  }

  // Input soal
  elseif ($module=='soal' AND $act=='input'){
    //kelola foto//
    $lokasi_file = $_FILES['fupload']['tmp_name'];
    $tipe_file   = $_FILES['fupload']['type'];
    $nama_file   = $_FILES['fupload']['name'];
    $acak        = rand(1,99);
    $nama_gambar = $acak.$nama_file; 
    $random=$user->random(7);
    //
    $kode_soal       = $user->escape_string($_POST['kode_soal']); 
    $soal            = $user->escape_string($_POST['soal']); 
    $A               = $user->escape_string($_POST['A']);  
    $B               = $user->escape_string($_POST['B']); 
    $C               = $user->escape_string($_POST['C']); 
    $D               = $user->escape_string($_POST['D']); 
    $jawaban         = $user->escape_string($_POST['jawaban']);   
  
    $msg = $validation->check_empty($_POST, array('kode_soal','soal','A','B','C','D','jawaban'));
    
    // checking empty fields
  if($msg != null) {
    echo "<h3 class=text-center>Ada Kesalahan</h3> <p  class=text-center>";
    echo $msg;

    //link to the previous page
    echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    echo "</p>";
  } 
  else {
      // // Apabila tidak ada foto yang di upload
    if (empty($lokasi_file)){
          
      $simpan_soal = $user->simpan_soal($kode_soal, $soal, $A, $B, $C, $D, $jawaban);
    
         header("location:../../index.php?module=".$module);
   }
    //bila ada photo
   else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/gif" ){
        echo "<script>window.alert('Upload Gagal! Pastikan file yang di upload bertipe JPG, Gif, atau Png');
              window.location=('../../index.php?module=soal')</script>";
      }
      else{
//simpan photo baru
        $folder = "../../photo/"; // folder untuk photo
        $ukuran = 60;                     
        $gb=$gambar->UploadFoto($nama_gambar, $folder, $ukuran);

   $simpan_soal = $user->simpan_soal_gb($kode_soal, $soal, $A, $B, $C, $D, $jawaban, $nama_gambar);
   header("location:../../index.php?module=".$module);            
      }
    }
    
  }
}
  // Update user
  elseif ($module=='soal' AND $act=='update'){
       
    $id    = $_POST['id'];
    $user=new User();
    $r=$user->detail_soal($id);
     //kelola foto
    $lokasi_file = $_FILES['fupload']['tmp_name'];
    $tipe_file   = $_FILES['fupload']['type'];
    $nama_file   = $_FILES['fupload']['name'];
    $acak        = rand(1,99);
    $nama_gambar = $acak.$nama_file; 
    $random=$user->random(7);
    //
    $kode_soal       = $user->escape_string($_POST['kode_soal']); 
    $soal            = $user->escape_string($_POST['soal']); 
    $A               = $user->escape_string($_POST['A']);  
    $B               = $user->escape_string($_POST['B']); 
    $C               = $user->escape_string($_POST['C']); 
    $D               = $user->escape_string($_POST['D']); 
    $jawaban         = $user->escape_string($_POST['jawaban']); 

    if (empty($lokasi_file)){
          
      $update_user = $user->update_soal($kode_soal, $soal, $A, $B, $C, $D, $jawaban, $id);
    
         header("location:../../index.php?module=".$module);
   } else { 
          if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/gif" ){
              echo "<script>window.alert('Upload Gagal! Pastikan file yang di upload bertipe *.JPG');
                    window.location=('../../index.php?module=user')</script>";
            } else {

      //hapus photo lama
       $namafile=$user->detail_soal($_GET['id']);
      // hapus file gambar yang berhubungan dengan berita tersebut
      @unlink("../../photo/$namafile");   
      @unlink("../../photo/small_$namafile");
      //simpan photo baru
        $folder = "../../photo/"; // folder untuk photo
        $ukuran = 60;                     // photo diperkecil (thumb)
        $gb=$gambar->UploadFoto($nama_gambar, $folder, $ukuran);


        $update_user = $user->update_soal_gb($kode_soal, $soal, $A, $B, $C, $D, $jawaban, $nama_gambar, $id); 

        header("location:../../index.php?module=".$module);
        }
      }
      
    }
?>
