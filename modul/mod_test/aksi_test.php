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
  elseif ($module=='test' AND $act=='input'){
    $id_user      = $user->escape_string($_POST['id_user']); 
    $jumlah       = $user->escape_string($_POST['jumlah']); 
    $id_event     = $user->escape_string($_POST['id_event']);

    $query =" SELECT * from test WHERE id_user ='$id_user' and id_event ='$id_event'";
    $result =$mysqli->query($query);
    $ada =$result->num_rows;    
    if ($ada>0){
      echo "<script>alert('Anda Tidak Dapat Mengikuti Ujian Lagi.');
      window.location = '../../index.php?module=test'</script>";
      
          }
      else {
      // input ke tabel test
      $query =" INSERT INTO test (id_user, id_event) values ('$id_user','$id_event')";
      $result     = $mysqli->query($query);
      $id_test    = mysqli_insert_id($mysqli);
      // input ke tabel hasil test
      $ns=$jumlah;
      for ($i=1; $i <=$ns ; $i++) { 
        $id_soal      = $_POST['id_soal'][$i]; 
        $nomor_soal   = $_POST['nomor_soal'][$i]; 
        $pilihan      = $_POST['pilihan'][$i];

       $simpan_test = $user->simpan_hasil_test($id_test,$id_event,$id_user,$id_soal,$nomor_soal,$pilihan);
        }
      // periksa jawaban
        $hasil_test=$user->tampil_hasil_test($id_test, $id_user);
        foreach ($hasil_test as $key => $ht) {
          $id_soal=$ht['id_soal'];
          $jawaban=$ht['jawaban'];

          $query =" SELECT * from soal WHERE id_soal ='$id_soal'";
          $result =$mysqli->query($query);
          $v=$result->fetch_assoc();
          $kunci=$v['jawaban'];

          if ($kunci==$jawaban) {
                $b_s="B";
              }    
            else {
              $b_s="S";
            }
          $query =" UPDATE hasil_test SET b_s ='$b_s' WHERE id_test='$id_test' and id_soal='$id_soal' and id_user='$id_user'";
          $result =$mysqli->query($query);
        }
      }
  $query =" SELECT * , count(b_s) as benar from hasil_test WHERE b_s ='B' and id_event='$id_event' and id_user='$id_user'";
    $result =$mysqli->query($query);
    $v=$result->fetch_assoc();
    // mncari nilai

    $user=new User();
    $soal=$user->tampil_soal_aktif();
    $jumlah_soal=count($soal);
    $score = 100/$jumlah_soal*$v['benar'];
    
    if ($score>=70) {
        $nilai="l";

    }
    else {
       $nilai="tl";
     }
    $query =" UPDATE test SET nilai_teori = '$score' , status_teori = '$nilai' WHERE id_test='$id_test' and id_user='$id_user'";
          $result =$mysqli->query($query);  

    
    // checking empty fields
       header("location:../../index.php?module=nilai_kelulusan");
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
