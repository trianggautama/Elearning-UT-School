<?php 
  
  $user=new User();
  $peserta=$user->detail_peserta_test($_SESSION['email']);
  $event=$user->detail_event_aktif();
  $soal=$user->tampil_soal_aktif();
    $id_user=$peserta['id_user'];
    $id_event=$event['id_event'];
    $jumlah_soal=count($soal);

    //jawaban benar
  $query =" SELECT count(b_s) as benar from hasil_test WHERE b_s ='B' and id_event='$id_event' and id_user='$id_user'";
  $result =$mysqli->query($query);
  $v=$result->fetch_assoc();
  // mncari nilai
  $score = 100/$jumlah_soal*$v['benar']; 
  $salah = $jumlah_soal-$v['benar'];

//note test 
 $query =" SELECT * from test WHERE id_user ='$id_user' and id_event='$id_event'";
  $result =$mysqli->query($query);
  $ada =$result->num_rows;
  if ($ada) { ?>
    <?php 
      if ($score >=70) { ?>
      <div class="alert alert-success" role="alert">
      Selamat Anda  Telah Lulus <b>Tes Teori</b>. Silahkan melakukan tes selanjutnya...
      </div>

      <?php }
      else {

      ?>
       <div class="alert alert-danger" role="alert">
        Maaf Anda Tidak Lulus, Silahkan Ikut DI next Event :)
      </div>

  <?php 
   }
    }
  else { ?>
   <div class="alert alert-secondary" role="alert">
    Anda Belum Mengikuti Test! <a href="index.php?module=test">Tes Teori</a>
    </div>
   
 <?php }
  ?>
<h2>Nilai Teori</h2>
  <div class="box-body table-responsive">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Periode</th>
                <th>Nama</th>
                <th>Jumlah Benar</th>
                <th>Jumlah Salah</th>
                <th>Nilai</th>
                <th>Status</th>
                </tr>
                </thead>
                <tbody>
                

                <?php 
      $user=new User();
      $news=$user->tampil_test_nilai($id_user); 
       if(is_array($news) || is_object($news)){
      foreach ($news as $key => $r) {
        $e=$user->detail_event($r['id_event']); 
        if ($score>="70") {
          $status="Lulus";
        } else {
          $status="Tidak Lulus";
        }

        $query =" SELECT count(b_s) as benar from hasil_test WHERE b_s ='B' and id_event='$r[id_event]' and id_user='$id_user'";
        $result =$mysqli->query($query);
        $v=$result->fetch_assoc();
        // mncari nilai
        $score = 100/$jumlah_soal*$v['benar']; 
        $salah = $jumlah_soal-$v['benar'];

        ?> <tr>
                  <td><?= $e['periode'] ?></td>
                  <td><?= $_SESSION['nama'] ?></td>
                  <td><?= $v['benar'] ?></td>
                  <td><?= $salah ?></td>
                  <td><?= $r['nilai_teori'] ?></td>
                  <td><?= $status ?></td>
                </tr>

<?php 
}
} 
?>
</tbody>
</table>
</div>

<br>

<h2>Nilai Praktek</h2>
  <div class="box-body table-responsive">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Periode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Nilai</th>
                <th>Status</th>
                </tr>
                </thead>
                <tbody>
                

                <?php 
      $user=new User();
      $news=$user->tampil_test_nilai($id_user); 
       if(is_array($news) || is_object($news)){
      foreach ($news as $key => $r) {
        $e=$user->detail_event($r['id_event']); 
        if ($r['status_praktek']=="l") {
          $status="Lulus";
        } else {
          $status="Tidak Lulus";
        }

        $query =" SELECT count(b_s) as benar from hasil_test WHERE b_s ='B' and id_event='$r[id_event]' and id_user='$id_user'";
        $result =$mysqli->query($query);
        $v=$result->fetch_assoc();
        // mncari nilai
        $score = 100/$jumlah_soal*$v['benar']; 
        $salah = $jumlah_soal-$v['benar'];

        ?> <tr>
                  <td><?= $e['periode'] ?></td>
                  <td><?= $_SESSION['nama'] ?></td>
                  <td><?= $r['kategori'] ?></td>
                  <td><?= $r['nilai_praktek'] ?></td>
                  <td><?= $status ?></td>
                </tr>

<?php 
}
} 
?>
</tbody>
</table>
</div>