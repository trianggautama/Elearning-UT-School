<?php    
// Apabila user belum login
if (empty($_SESSION['email']) AND empty($_SESSION['password'])){
  echo "<h2 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h2>
        <p class=\"fail\"><a href=\"login.php?auth\">LOGIN</a></p></div>";   
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  

  $aksi = "modul/mod_test/aksi_test.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil user
    default:
    $user=new User();
    $soal=$user->tampil_test();
    $jumlah=count($soal);
    $peserta=$user->detail_peserta_test($_SESSION['email']);
    $event=$user->detail_event_aktif();
    $id_user=$peserta['id_user'];
    $id_event=$event['id_event'];

    $pem=$user->detail_pembayaran($id_user,$id_event);
    if ($pem['pembayaran']=="l") {
      $query =" SELECT * from test WHERE id_user ='$id_user' and id_event ='$id_event'";
        $result =$mysqli->query($query);
        $ada =$result->num_rows;    
        if ($ada>0){ echo "
          <div class=\"alert alert-danger\" role=\"alert\">
      Maaf Anda Sudah  Mengikuti Test!!!
      </div> ";
      }
      else {



    ?>
          <header class='page-header'>
        <h2>Tes </h2>
            <div class='right-wrapper text-right'>
            <ol class='breadcrumbs'>
              <li>
                <a href='#'>
                  <i class='fas fa-file'></i>
                </a>
              </li>
              <li><span>Tes</span></li>
            </ol> 
              <a class='sidebar-right-toggle'><i class='fas fa-chevron-left'></i></a>
            </div>
          </header>
  <div class="card">
    <div class="card-header">
      <h2>Test Soal</h2> 
    </div>
    <div class="card-body">
    Selamat Datang <b> <?= $peserta['nama'] ?> </b>. <p> Jawablah pertanyaan-pertanyan berikut dengan benar, dan jangan lupa berdoa sebelum memulai tes :) </p><hr> 
    <form method="post" enctype="multipart/form-data" action="<?php echo $aksi?>?module=test&act=input">
    <input type="hidden" name="id_user" value="<?= $id_user ?>">
    <input type="hidden" name="jumlah" value="<?= $jumlah ?>">
    <input type="hidden" name="id_event" value="<?= $id_event ?>">
    <?php 
    $no=1;
    foreach ($soal as $key => $s) {
    $id_soal=$s['id_soal'];
    $kode_soal=$s['kode_soal'];
    $pertanyaan=$s['soal'];
    $pilihan_a=$s['a'];
    $pilihan_b=$s['b'];
    $pilihan_c=$s['c'];
    $pilihan_d=$s['d'];


     ?>
        <div class="form-group">
            <label for="inputNama" class=" control-label">
            <?php if ($s['gambar']!="") {
              echo "<img src=\"photo/$s[gambar]\" width=\"230px\" hight=\"230px\"> <br>";
            } ?>
             <?=$no ?>.  <?=$pertanyaan ?></label>
            <input type="hidden" name="id_soal[<?= $no ?>]" value="<?= $id_soal ?>">
            <input type="hidden" name="kode_soal[<?= $no ?>]" value="<?= $kode_soal ?>">
            <input type="hidden" name="nomor_soal[<?= $no ?>]" value="<?= $no ?>">
              <div class="col-sm-9">
                <div class="form-check">
                <input class="form-check-input" type="radio" name="pilihan[<?=$no ?>]" id="exampleRadios1" value="A" > 
                <b> A. </b>
                <label class="form-check-label" for="exampleRadios1">
                  <?=$pilihan_a ?>
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="pilihan[<?=$no ?>]" id="exampleRadios2" value="B">
                <b> B. </b>
                <label class="form-check-label" for="exampleRadios2">
                  <?=$pilihan_b ?>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="pilihan[<?=$no ?>]" id="exampleRadios2" value="C">
                <b> C. </b>
                <label class="form-check-label" for="exampleRadios2">
                  <?=$pilihan_c ?>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="pilihan[<?=$no ?>]" id="exampleRadios2" value="D">
                <b> D. </b>
                <label class="form-check-label" for="exampleRadios2">
                  <?=$pilihan_d ?>
                </label>
              </div>
              </div>
              </div>
              <hr>
              <?php 
              $no++;
              }
               ?>
      <div class="form-group">
          <input  onclick="return confirm('yakin sudah?')" type="submit" name="input" value="Simpan" class="btn btn-warning" style="color:white;">
      </div>
    </form>
  </div>
    </div>
  
<?php
}
  }
else { echo "
  <div class=\"alert alert-danger\" role=\"alert\">
        Mohon Maaf Anda Belum Melakukan Registrasi Pembayaran, Silahkan Menghubungi Admin.
      </div> ";

} 
break;
}}
 ?>