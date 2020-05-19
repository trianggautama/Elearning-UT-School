<?php    
// Apabila user belum login
if (empty($_SESSION['email']) AND empty($_SESSION['password'])){
  echo "<h2 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h2>
        <p class=\"fail\"><a href=\"login.php?auth\">LOGIN</a></p></div>";   
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  

  $aksi = "modul/mod_penjadwalan/aksi_penjadwalan.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil user
    default:
    $user=new User();
    $soal=$user->tampil_soal();

    ?>

<!-- Page Heading -->
      <header class="page-header">
        <h2>Data Penjadwalan</h2>
            <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
              <li>
                <a href="#">
                  <i class="fas fa-file"></i>
                </a>
              </li>
              <li><span>Data</span></li>
              <li><span>Jadwal Mata Pelajaran</span></li>
            </ol> 
              <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
            </div>
          </header>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
              <div class="col-md-6">
                <h5 class="h5 text-gray-800">Data Jadwal Mata Pelajaran</h5>
              </div>
              <div class="col-md-6">
                <div class="text-right">
                  <button id="formbtn" class="btn btn-success" onclick=location.href="?module=penjadwalan&act=tambahjadwal"><i class="fa fa-plus"></i> Tambah Jadwal</button>     
                </div>
              </div>
            </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="datatable-default" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Mata Pelajaran</th>
                      <th>Kelas</th>
                      <th>Jadwal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>1</td>
                        <td>mapel 1</td>
                        <td>Kelas 1</td>
                        <td>Senin 12 Maret</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning " title="Edit Data"><i class="fas fa-edit"></i></a> &nbsp;
                            <a href="$aksi?module=soal&act=hapus&id=$r[id_soal]" class="btn btn-sm btn-danger"  title="Delete Data" onclick="return confirm('Yakin akan Menghapus Data $r[kode_soal]?')"><i class="fa fa-trash"></i></a>     
                        </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

<?php 
  break;
   case "tambahjadwal":
   $user= new User();
   $kode_soal= $user->kode_otomatis();
?>
<!-- isi dengan form tambah soal -->
<header class="page-header">
        <h2>Tambah Jadwal Mata Pelajaran</h2>
            <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
              <li>
                <a href="#">
                  <i class="fas fa-file"></i>
                </a>
              </li>
              <li><span>Data</span></li>
              <li><span>Penjadwalan</span></li>
              <li><span>Tambah</span></li>
            </ol> 
              <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
            </div>
          </header>
<div class="container">
    <div class="card">
        <div class="card-header">
         <h3>Tambah Mata Pelajaran</h3>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="<?php echo $aksi?>?module=soal&act=input">
            <div class="form-group">
                <label for="">Mata Pelajaran</label>
                <select name="pengajar_id" id="pengajar_id" class="form-control">
                    <option value="">-- Pilih dari mapel --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Kelas</label>
                <select name="pengajar_id" id="pengajar_id" class="form-control">
                    <option value="">-- Pilih dari Kelas --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Jadwal</label>
                <input type="date" class="form-control" name="jadwal" id="jadwal">
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-default text-right mt-1" style="color:grey;"> <i class="fa fa-arrow-left"> batal</i> </button>
            <button type="submit" name="input" class="btn btn-warning text-right mt-1" style="color:white;"> <i class="fa fa-save"> Simpan</i> </button>
        </div>
        </form>
    </div>
</div>

<?php 
break;
case "editjadwal":
   $user= new User();
   $s= $user->detail_soal($_GET['id']);

 ?>
<header class="page-header">
  <h2>Edit Kelas</h2>
    <div class="right-wrapper text-right">
      <ol class="breadcrumbs">
        <li>
          <a href="#">
            <i class="fas fa-file"></i>
          </a>
        </li>
        <li><span>Data</span></li>
        <li><span>Kelas</span></li>
        <li><span>Edit</span></li>
      </ol> 
      <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
    </div>
  </header>
<div class="container">
<div class="card">
        <div class="card-header">
         <h3>Tambah Kelas</h3>
        </div>
        <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="<?php echo $aksi?>?module=kelas&act=update">
        <div class="form-group">
                <label for="">Mata Pelajaran</label>
                <select name="pengajar_id" id="pengajar_id" class="form-control">
                    <option value="">-- Pilih dari mapel --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Kelas</label>
                <select name="pengajar_id" id="pengajar_id" class="form-control">
                    <option value="">-- Pilih dari Kelas --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Jadwal</label>
                <input type="date" class="form-control" name="jadwal" id="jadwal">
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-default text-right mt-1" style="color:grey;"> <i class="fa fa-arrow-left"> batal</i> </button>
            <button type="submit" name="input" class="btn btn-warning text-right mt-1" style="color:white;"> <i class="fa fa-save"> Simpan</i> </button>
        </div>
        </form>
    </div>
  </div>
  <script>
    (function($) {
      'use strict';
        var datatableInit = function() {
        $('#datatable-default').dataTable({
          dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p'
        });
      };

      $(function() {
        datatableInit();
      });

      }).apply(this, [jQuery]);
  </script>
<?php 
break;
}}
 ?>