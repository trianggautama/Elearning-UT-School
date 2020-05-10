<?php    
// Apabila user belum login
if (empty($_SESSION['email']) AND empty($_SESSION['password'])){
  echo "<h2 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h2>
        <p class=\"fail\"><a href=\"login.php?auth\">LOGIN</a></p></div>";   
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  

  $aksi = "modul/mod_event_test/aksi_event_test.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil user
    default:
    $user=new User();
    $event=$user->tampil_event_test();
    ?>

<!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Instruktur</h1>

        <button id="formbtn" class="btn btn-success" onclick=location.href="?module=event_test&act=tambahevent"><i class="fa fa-plus">
          
        </i> Tambah Event</button>     
        <br><br>   
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Periode</th>
                      <th>Tanggal</th>
                      <th>Tempat</th>
                      <th>Instruktur</th>
                      <th>Aktif</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $no=1;
                      if(is_array($event) || is_object($event)){
                        foreach ($event as $key => $r) {
                          if ($r['aktif']=="y") {
                            $aktif="Aktif";
                          } else {
                            $aktif="Nonaktif";
                          } 
                          echo "
                          <td> $no </td>
                          <td> $r[periode] </td>
                          <td> $r[tanggal] </td>
                          <td> $r[tempat] </td>
                          <td> $r[instruktur] </td>
                          <td> $aktif </td>
                          <td>
                          <a href=\"$aksi?module=event_test&act=hapus&id=$r[id_event]\" class=\"btn btn-danger btn-xs\" title=\"Delete Data\" onclick=\"return confirm('Yakin akan Menghapus Data $r[id_event]?')\"><i class=\"fa fa-trash\"></i></a>
                          </td>
                          </tr>";
                           $no++;
                        }
                      }
                   
                   ?>
                    
                  </tbody>
                </table>
                <a href="modul/mod_laporan/cetakinstruktur.php" target="_blank">
                <button id="formbtn" class="btn btn-success" ><i class="fa fa-print"></i> Cetak </button> </a>
              </div>
            </div>
          </div>

<?php 
  break;
   case "tambahevent":
   $user= new User();
?>
<!-- isi dengan form tambah soal -->

<div class="container">
    <h2>Tambah Event</h2> <hr>
    <form method="post" enctype="multipart/form-data" action="<?php echo $aksi?>?module=event_test&act=input">
      <div class="row">
        <div class="col-md-2 col-sm-6" style="line-height: 32px;">
          <div class="form-group">
            <label>Periode</label>
            </div>
          <div class="form-group">
            <label>Tanggal</label>
          </div>
          <div class="form-group">
            <label>Tempat</label>
          </div>
          <div class="form-group">
            <label>Instruktur</label>
          </div>
        </div>

        <div class="col-md-10 col-sm-2 col">
          <div class="form-group">
              <input type="text" class="form-control" name="periode" required>
            </div>
            <div class="form-group">
              <input type="date" class="form-control" name="tanggal" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="tempat" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="instruktur" required>
            </div>
        </div>

      <div class="form-group">
          <input type="submit" name="input" value="Simpan" class="btn btn-warning" style="color:white;">
      </div>
    </form>
  </div>

<?php 
break;
case "editevent_test":
   $user=new User();
    $event=$user->tampil_event_test();

 ?>

<div class="container">
    <h2>Edit Soal</h2> <hr>
    <form method="post" enctype="multipart/form-data" action="<?php echo $aksi?>?module=editevent_test&act=update">
    <input type="hidden" name="id" value="<?php echo $s['id_soal'] ?>">
      <div class="row">
        <div class="col-md-2 col-sm-6" style="line-height: 32px;">
          <div class="form-group">
            <label>Periode</label>
            </div>
          <div class="form-group">
            <label>Tanggal</label>
          </div>
          <div class="form-group">
            <label>Tempat</label>
          </div>
          <div class="form-group">
            <label>Instruktur</label>
          </div>
        </div>

        <div class="col-md-10 col-sm-2 col">
          <div class="form-group">
              <input type="text" class="form-control" name="periode" required>
            </div>
            <div class="form-group">
              <input type="date" class="form-control" name="tanggal" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="tempat" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="instruktur" required>
            </div>
        </div>

      <div class="form-group">
          <input type="submit" name="input" value="Simpan" class="btn btn-warning" style="color:white;">
      </div>
    </form>
  </div>


<?php 
break;
}}
 ?>