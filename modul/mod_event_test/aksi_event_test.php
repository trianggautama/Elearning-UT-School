<?php

  include "../../config/class.admin.php";
  include_once '../../config/validation.php';
  include "../../config/library.php";
  include "../../config/fungsi_thumbnail.php";
  
  $user = new User();
  $tanggal=new Tanggal();
  $validation=new Validation();

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
  elseif ($module=='event_test' AND $act=='input'){
  
    $periode       = $user->escape_string($_POST['periode']); 
    $tanggal       = $user->escape_string($_POST['tanggal']); 
    $tempat        = $user->escape_string($_POST['tempat']);  
    $instruktur    = $user->escape_string($_POST['instruktur']);  
  
    $msg = $validation->check_empty($_POST, array('periode','tanggal','tempat','instruktur'));
    
    // checking empty fields
  if($msg != null) {
    echo "<h3 class=text-center>Ada Kesalahan</h3> <p  class=text-center>";
    echo $msg;

    //link to the previous page
    echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    echo "</p>";
  } 
  else {
    $aktif = "n";
    $update_status = $user->update_status($aktif);
   $simpan_event = $user->simpan_event($periode, $tanggal, $tempat, $instruktur);
   header("location:../../index.php?module=".$module);            
      }
    }
    
  // Update user
  elseif ($module=='event_test' AND $act=='update'){
       
    $id    = $_POST['id'];
    $user=new User();
    $r=$user->detail_event($id);

    $periode       = $user->escape_string($_POST['periode']); 
    $tanggal       = $user->escape_string($_POST['tanggal']); 
    $tempat        = $user->escape_string($_POST['tempat']);  
    $instruktur    = $user->escape_string($_POST['instruktur']);

          
      $update_event = $user->update_event($periode, $tanggal, $tempat, $instruktur);
    
         header("location:../../index.php?module=".$module);
   
      }
      
?>
