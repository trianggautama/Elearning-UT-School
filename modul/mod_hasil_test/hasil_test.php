  <div class="box-body table-responsive">
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Nama</th>
                <th>Jumlah Benar</th>
                <th>Jumlah Salah</th>
                <th>Nilai</th>
                <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>

                <?php 
      $user=new User();
      $e=$user->detail_event_aktif(); 
      $news=$user->tampil_hasil_teori($e['id_event']); 
       if(is_array($news) || is_object($news)){
      foreach ($news as $key => $r) {
        if ($r['status_teori']=="l") {
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

        ?>
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