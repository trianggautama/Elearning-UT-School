<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<h2 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h2>
        <p class=\"fail\"><a href=\"index.php\">LOGIN</a></p></div>";   
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
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
  if ($module=='user' AND $act=='hapus'){
        $namafile=$user->detail_user($_GET['id']);
      // hapus file gambar yang berhubungan dengan berita tersebut
      @unlink("../../photo/$namafile");   
      @unlink("../../photo/small_$namafile"); 
      // hapus data user di database 
     
     $del=$user->delete_users($_GET['id']);  
      
    
    header("location:../../index.php?module=".$module);
  }

  // Input user
  elseif ($module=='user' AND $act=='input'){
    //kelola foto
    $lokasi_file = $_FILES['fupload']['tmp_name'];
    $tipe_file   = $_FILES['fupload']['type'];
    $nama_file   = $_FILES['fupload']['name'];
    $acak        = rand(1,99);
    $nama_gambar = $acak.$nama_file; 
    $random      =$user->random(7);
    //
    $nrp           = $user->escape_string($_POST['nrp']); 
    $pass          = md5($_POST['pass']); 
    $nama          = $user->escape_string($_POST['nama']);            
    $tempat_lahir  = $user->escape_string($_POST['tempat_lahir']);             
    $tanggal_lahir = $user->escape_string($_POST['tanggal_lahir']);            
    $jk            = $user->escape_string($_POST['jk']);            
    $email         = $user->escape_string($_POST['email']);
    $asal          = $user->escape_string($_POST['asal']); 
    $jabatan       = $user->escape_string($_POST['jabatan']);                 
    $level         = $user->escape_string($_POST['level']);    
    $status        = "Aktif"; 
 
    
    $msg = $validation->check_empty($_POST, array('nrp','pass','nama', 'tempat_lahir','tanggal_lahir','jk','email', 'asal','jabatan', 'level'));
    $check_email = $user->check_email($email);
    $check_nrp = $user->check_nrp($nrp);

    // checking empty fields
  if($msg != null) {
    echo "<h3 class=text-center>Ada Kesalahan</h3> <p  class=text-center>";
    echo $msg;

    //link to the previous page
    echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    echo "</p>";
  } 
  elseif (!$check_email) {
    echo "<script>window.alert('Email Sudah Terdaftar');
              window.location=('../../index.php?module=user')</script>";
  }
  elseif (!$check_nrp) {
    echo "<script>window.alert('NRP Sudah Terdaftar');
              window.location=('../../index.php?module=user')</script>";
  }

  else {
      // // Apabila tidak ada foto yang di upload
    if (empty($lokasi_file)){
          
      $simpan_user = $user->simpan_user($nrp, $pass, $nama, $tempat_lahir, $tanggal_lahir, $jk, $email, $asal, $jabatan, $level);
    
         // header("location:../../index.php?module=".$module);
   }
    //bila ada photo
   else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/gif" ){
        echo "<script>window.alert('Upload Gagal! Pastikan file yang di upload bertipe JPG, Gif, atau Png');
              window.location=('../../index.php?module=user')</script>";
      }
      else{
//simpan photo baru
        $folder = "../../photo_user/"; // folder untuk photo
        $ukuran = 60;                     
        $gb=$gambar->UploadFoto($nama_gambar, $folder, $ukuran);

   $simpan_user = $user->simpan_user_gb($nrp, $pass, $nama, $tempat_lahir, $tanggal_lahir, $jk, $email, $asal, $jabatan, $level, $nama_gambar);
   header("location:../../index.php?module=".$module);            
      }
    }
    
  }
}
  // Update user
  elseif ($module=='profile' AND $act=='update'){
       
    $id    = $_POST['id'];
    $user=new User();
    $r=$user->detail_user($id);
     //kelola foto
    $lokasi_file = $_FILES['fupload']['tmp_name'];
    $tipe_file   = $_FILES['fupload']['type'];
    $nama_file   = $_FILES['fupload']['name'];
    $acak        = rand(1,99);
    $nama_gambar = $acak.$nama_file; 
    $random      =$user->random(7);
    //
    $nrp            = $user->escape_string($_POST['nrp']); 
    $nama           = $user->escape_string($_POST['nama']); 
    $tempat_lahir   = $user->escape_string($_POST['tempat_lahir']);            
    $tanggal_lahir  = $user->escape_string($_POST['tanggal_lahir']);
    $jk             = $user->escape_string($_POST['jk']);  
    $email          = $user->escape_string($_POST['email']); 
    $pass           = $user->escape_string($_POST['pass']);           
    $asal           = $user->escape_string($_POST['asal']); 
    $jabatan        = $user->escape_string($_POST['jabatan']);

    if($pass==""){
      $pass="$r[pass]";
    } else{
      $pass=md5($_POST['pass']);
    }

   if (empty($lokasi_file)){
          
      $update_user = $user->update_user($nrp, $nama, $tempat_lahir, $tanggal_lahir, $jk, $email, $pass, $asal, $jabatan ,$id);
    
         header("location:../../index.php?module=home");
   } else { 
          if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/gif" ){
              echo "<script>window.alert('Upload Gagal! Pastikan file yang di upload bertipe *.JPG');
                    window.location=('../../index.php?module=user')</script>";
            } else {

      //hapus photo lama
       $namafile=$user->detail_user($_GET['id']);
      // hapus file gambar yang berhubungan dengan berita tersebut
      @unlink("../../photo_user/$namafile");   
      @unlink("../../photo_user/small_$namafile");
      //simpan photo baru
        $folder = "../../photo_user/"; // folder untuk photo
        $ukuran = 60;                     // photo diperkecil (thumb)
        $gb=$gambar->UploadFoto($nama_gambar, $folder, $ukuran);


        $update_user = $user->update_user_gb($nrp, $nama, $tempat_lahir, $tanggal_lahir, $jk, $email, $pass, $asal, $jabatan, $nama_gambar, $id); 

        header("location:../../index.php?module=home");
        }
      }
      
    }
  }
?>
