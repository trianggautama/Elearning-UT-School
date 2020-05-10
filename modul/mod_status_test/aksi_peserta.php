<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['email']) AND empty($_SESSION['password'])){
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
  if ($module=='peserta' AND $act=='hapus'){
        $namafile=$user->detail_user($_GET['id']);
      // hapus file gambar yang berhubungan dengan berita tersebut
      @unlink("../../photo/$namafile");   
      @unlink("../../photo/small_$namafile"); 
      // hapus data user di database 
     
     $del=$user->delete_peserta($_GET['id']);      
      
    
    header("location:../../index.php?module=".$module);
  }

  // Input user
  elseif ($module=='peserta' AND $act=='input'){                        
    $id_user       = $user->escape_string($_POST['id_user']);            
    $pembayaran    = $user->escape_string($_POST['pembayaran']); 
    $event=$user->detail_event_aktif();
    $id_event=$event['id_event'];
    
    $msg = $validation->check_empty($_POST, array('id_user','pembayaran'));
    
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
          
      $simpan_user = $user->simpan_peserta($id_event,$id_user,$pembayaran);
    
         header("location:../../index.php?module=".$module);
   }    
  }
}
  // Update user
  elseif ($module=='peserta' AND $act=='update'){
       
    $id    = $_POST['id'];
    $user=new User();
    $r=$user->detail_peserta($id);
        
    $id_user       = $user->escape_string($_POST['id_user']);            
    $pembayaran    = $user->escape_string($_POST['pembayaran']); 
 
   if (empty($lokasi_file)){
          
      $update_user = $user->update_peserta($id_user,$pembayaran,$id);
    
         header("location:../../index.php?module=".$module);
   }      
    }
  }
?>
