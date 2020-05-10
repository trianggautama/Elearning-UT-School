<?php

  include "../../config/class.user.php";
  include_once '../../config/validation.php';
  include "../../config/library.php";
  include "../../config/fungsi_thumbnail.php";
  
  $user = new User();
  $tanggal=new Tanggal();
  $validation=new Validation();

  $module = $_GET['module'];
  $act    = $_GET['act'];

  // Hapus user
  if ($module=='registrasi' AND $act=='hapus'){
        $namafile=$user->detail_user($_GET['id']);
      // hapus file gambar yang berhubungan dengan berita tersebut
      @unlink("../../photo/$namafile");   
      @unlink("../../photo/small_$namafile"); 
      // hapus data user di database 
     
     $del=$user->delete_users($_GET['id']);  
      
    
    header("location:../../index.php?module=".$module);
  }

  // Input user
  elseif ($module=='registrasi' AND $act=='input'){
    //kelola foto
    //
    $nama       = $user->escape_string($_POST['nama']); 
    $password   = $user->escape_string(md5($_POST['password'])); 
    $email      = $user->escape_string($_POST['email']);  
 
    
    $msg = $validation->check_empty($_POST, array('nama','password','email'));
    
    // checking empty fields
  if($msg != null) {
    echo "<h3 class=text-center>Ada Kesalahan</h3> <p  class=text-center>";
    echo $msg;

    //link to the previous page
    echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    echo "</p>";
  } 
  else {
 //simpan user
   $simpan_user = $user->simpan_user($nama, $password, $email);
   header("location:../../login.php");            
      }

}
  // Update user
  elseif ($module=='user' AND $act=='update'){
       
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
    $username  = $user->escape_string($_POST['username']); 
    $password  = $user->escape_string($_POST['password']); 
    $nama_user = $user->escape_string($_POST['nama_user']);            
    $posisi    = $user->escape_string($_POST['posisi']); 
    $status    = "Aktif";

    if($password==""){
      $password="$r[password]";
    } else{
      $password=md5($_POST['password']);
    }

   if (empty($lokasi_file)){
          
      $update_user = $user->update_user($username, $password, $nama_user, $posisi, $status, $id);
    
         header("location:../../index.php?module=".$module);
   } else { 
          if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/gif" ){
              echo "<script>window.alert('Upload Gagal! Pastikan file yang di upload bertipe *.JPG');
                    window.location=('../../index.php?module=user')</script>";
            } else {

      //hapus photo lama
       $namafile=$user->detail_user($_GET['id']);
      // hapus file gambar yang berhubungan dengan berita tersebut
      @unlink("../../photo/$namafile");   
      @unlink("../../photo/small_$namafile");
      //simpan photo baru
        $folder = "../../photo/"; // folder untuk photo
        $ukuran = 60;                     // photo diperkecil (thumb)
        $gb=$gambar->UploadFoto($nama_gambar, $folder, $ukuran);


        $update_user = $user->update_user_gb($username, $password, $nama_user, $posisi, $nama_gambar, $status, $id); 

        header("location:../../index.php?module=".$module);
        }
      }
      
    }
?>
