<?php 
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<h2 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h2>
        <p class=\"fail\"><a href=\"login.php?auth\">LOGIN</a></p></div>";   
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  // fungsi untuk check box Tag (pegawai Terkait) di form input dan edit pegawai 
 include 'penjabat.php';
 $tanggal =date('d M Y');
  $aksi = "modul/mod_pegawai/aksi_pegawai.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil pegawai
    default:

        echo "
        <section class=\"content-header\">
         <h1>
         Laporan Data Pegawai <br><br>
         <button id=\"formbtn\" class=\"btn btn-success\" onclick=location.href=\"modul/mod_laporan/cetaklaporanpegawai.php\"><i class=\"fa fa-print\"></i> Cetak Laporan</button>
         </h1>
          <ol class=\"breadcrumb\">
           <li><a href=\"index.php?module=beranda\"><i class=\"fa fa-dashboard\"></i> Home</a></li>
           <li class=\"active\">Laporan Data Pegawai</li>
          </ol>
        </section>

        <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-xs-12\">       
            
          <div class=\"box\">
            <!--<div class=\"box-header\">-->              
            <!--</div>-->
            <!-- /.box-header -->
            
            <div class=\"box-body table-responsive\">
              <table  class=\"table table-bordered table-striped\">
                <thead>
                <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th>Umur (th)</th>
                <th>Mulai Bekerja</th>
                </tr>
                </thead>
                <tbody>";

      $user=new User();
      $news=$user->laporan_pegawai();  
      $no = 1;
      if(is_array($news) || is_object($news)){
      foreach ($news as $key => $r) {  
                echo "<tr><td width=10px>$no</td>
                  <td>$r[nik]</td>
                  <td>$r[nama_pegawai]</td>
                  <td>$r[nama_jabatan]</td>
                  <td>$r[usia]</td>
                  <td>$r[mulai_kerja]</td>
		              
              </tr>";
              $no++;
            }
          }
                
                echo "</tbody>  
                            
                </table>
                <div class=\"row\">
                <div class=\"col-xs-3\"></div>
                <div class=\"col-xs-3\"></div>
                <div class=\"col-xs-3\"></div>
                <div class=\"col-xs-3 text-center\"><br>
                Banjarmasin, $tanggal<br>
                $penjabat<br><br><br>
                <b>$nama_penjabat</b>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>";
          
    break;  
  }
}
?>
