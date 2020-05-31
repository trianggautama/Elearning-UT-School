<?php    
// Apabila user belum login
if (empty($_SESSION['email']) AND empty($_SESSION['password'])){
  echo "<h2 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h2>
        <p class=\"fail\"><a href=\"login.php?auth\">LOGIN</a></p></div>";   
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  

  $aksi = "modul/mod_soal/aksi_soal.php";

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
        <h2>Data Soal</h2>
            <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
              <li>
                <a href="#">
                  <i class="fas fa-file"></i>
                </a>
              </li>
              <li><span>Data</span></li>
              <li><span>Soal</span></li>
            </ol> 
              <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
            </div>
          </header>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
              <div class="col-md-6">
                <h5 class="h5 text-gray-800">Data Soal</h5>
              </div>
              <div class="col-md-6">
                <div class="text-right">
                  <button id="formbtn" class="btn btn-success" onclick=location.href="?module=soal&act=tambahsoal"><i class="fa fa-plus"></i> Tambah Soal</button>     
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
                      <th>Kode Soal</th>
                      <th>Soal</th>
                      <th>Kunci Jawaban</th>
                      <th>Status</th>
                      <th>Gambar</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $no=1;
                      if(is_array($soal) || is_object($soal)){
                        foreach ($soal as $key => $r) {
                          echo "
                          <td> $no </td>
                          <td>$r[mapel]</td>
                          <td> $r[kode_soal] </td>
                          <td> $r[soal] </td>
                          <td> $r[jawaban] </td>
                          <td> $r[aktif] </td>";
                          if ($r['gambar']!=""){
                            echo "<td><img src='photo/small_$r[gambar]'/> </td>";
                          } else{
                            echo "<td> --- </td>";
                          }
                          echo "
                          
                          <td> 
                          <a href=\"?module=soal&act=editsoal&id=$r[id_soal]\" class=\"btn btn-warning btn-xs\" title=\"Edit Data\"><i class=\"fas fa-edit\"></i></a> &nbsp;
                  <a href=\"$aksi?module=soal&act=hapus&id=$r[id_soal]\" class=\"btn btn-danger btn-xs\"  title=\"Delete Data\" onclick=\"return confirm('Yakin akan Menghapus Data $r[kode_soal]?')\"><i class=\"fa fa-trash\"></i></a>
                          </td>
                          </tr>";
                           $no++;
                        }
                      }
                   
                   ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

<?php 
  break;
   case "tambahsoal":
   $user= new User();
   $kode_soal= $user->kode_otomatis();
?>
<!-- isi dengan form tambah soal -->
<header class="page-header">
        <h2>Tambah Soal</h2>
            <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
              <li>
                <a href="#">
                  <i class="fas fa-file"></i>
                </a>
              </li>
              <li><span>Data</span></li>
              <li><span>Soal</span></li>
              <li><span>Tambah</span></li>
            </ol> 
              <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
            </div>
          </header>
<div class="container">
  <h3>Tambah Soal</h3>
  <hr>
    <form method="post" enctype="multipart/form-data" action="<?php echo $aksi?>?module=soal&act=input">
      <div class="row">

        <div class="col-md-2 col-sm-6" style="line-height: 32px;">
          <div class="form-group">
            <label>Kode Soal</label>
            </div>
            <div class="form-group">
              <label > Mata Pelajaran</label>
          </div>
          <div class="form-group">
            <label>Soal</label>
          </div>
          <div class="form-group">
            <label>A</label>
          </div>
          <div class="form-group">
            <label>B</label>
          </div>
          <div class="form-group">
            <label>C</label>
          </div>
          <div class="form-group">
            <label>D</label>
          </div>
          <div class="form-group">
            <label>Jawaban</label>
          </div>
          <div class="form-group">
            <label>Gambar</label>
          </div>
        </div>

        <div class="col-md-10 col-sm-2 col">
          <div class="form-group">
              <input type="text" class="form-control" name="kode_soal" value="<?php echo "$kode_soal"; ?>" readonly >
            </div>
            <div class="form-group">
          <select name="id_mapel" id="id_mapel" class="form-control">
                    <option value="">-- Pilih Nama Mata Pelajaran --</option>";
                    <?php
                     $k = new User();
                     $mapel = $k->tampil_mapel();
                     if (is_array($mapel) || is_object($mapel)) {
                         foreach ($mapel as $key => $p) {
                             $selected = ($p[id_mapel] == $r[id_mapel]) ? 'selected' : '';
                             echo "  <option $selected value=\"$p[id_mapel]\">$p[mapel]</option>
                                 ";
                         }
                     }
                    ?>
           </select>
          </div>
            <div class="form-group">
              <input type="text" class="form-control" name="soal" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="A" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="B" required>
            </div>
             <div class="form-group">
              <input type="text" class="form-control" name="C" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="D" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="jawaban" required>
            </div>
            <div class="form-group">
             <input class="form-control" type='file' name='fupload'>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-default text-right mt-1" style="color:grey;"> <i class="fa fa-arrow-left"> batal</i> </button>
              <button type="submit" name="input" class="btn btn-warning text-right mt-1" style="color:white;"> <i class="fa fa-save"> Simpan</i> </button>
            </div>
          </div>
          <br>
      </form>
</div>

<?php 
break;
case "editsoal":
   $user= new User();
   $s= $user->detail_soal($_GET['id']);

 ?>
<header class="page-header">
  <h2>Edit Soal</h2>
    <div class="right-wrapper text-right">
      <ol class="breadcrumbs">
        <li>
          <a href="#">
            <i class="fas fa-file"></i>
          </a>
        </li>
        <li><span>Data</span></li>
        <li><span>Soal</span></li>
        <li><span>Edit</span></li>
      </ol> 
      <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
    </div>
  </header>
<div class="container">
    <h2>Edit Soal</h2> <hr>
    <form method="post" enctype="multipart/form-data" action="<?php echo $aksi?>?module=soal&act=update">
    <input type="hidden" name="id" value="<?php echo $s['id_soal'] ?>">
      <div class="row">
        <div class="col-md-2 col-sm-6" style="line-height: 32px;">
        <div class="form-group">
              <label > Mata Pelajaran</label>
          </div>
          <div class="form-group">
            <label>Kode Soal</label>
            </div>
          <div class="form-group">
            <label>Soal</label>
          </div>
          <div class="form-group">
            <label>A</label>
          </div>
          <div class="form-group">
            <label>B</label>
          </div>
          <div class="form-group">
            <label>C</label>
          </div>
          <div class="form-group">
            <label>D</label>
          </div>
          <div class="form-group">
            <label>Jawaban</label>
          </div>
          <div class="form-group">
            <label>Gambar</label>
          </div>
        </div>

        <div class="col-md-10 col-sm-2 col">
          <div class="form-group">
              <input type="text" class="form-control" name="kode_soal" value="<?php echo $s['kode_soal'] ?>" readonly >
            </div>
            <div class="form-group">
          <select name="id_mapel" id="id_mapel" class="form-control">
                    <option value="">-- Pilih Mata Pelajaran  --</option>";
                    <?php
                    $k = new User();
                    $mapel = $k->tampil_mapel();
                    if (is_array($mapel) || is_object($mapel)) {
                        foreach ($mapel as $key => $p) {
                            $selected = ($p[id_mapel] == $s[id_mapel]) ? 'selected' : '';
                            echo "  <option $selected value=\"$p[id_mapel]\">$p[mapel] </option>
                                ";
                        }
                    }
                    ?>
           </select>
          </div>
            <div class="form-group">
              <input type="text" class="form-control" name="soal" value="<?php echo $s['soal'] ?>" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="A" value="<?php echo $s['a'] ?>" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="B" value="<?php echo $s['b'] ?>" required>
            </div>
             <div class="form-group">
              <input type="text" class="form-control" name="C" value="<?php echo $s['c'] ?>" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="D" value="<?php echo $s['d'] ?>" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="jawaban" value="<?php echo $s['jawaban'] ?>" required>
            </div>
            <div class="form-group">
             <input class="form-control" type='file' name='fupload'>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-default text-right mt-1" style="color:grey;"> <i class="fa fa-arrow-left"> batal</i> </button>
              <input type="submit" name="input" value="Simpan" class="btn btn-warning" style="color:white;">
            </div>
        </div>
    </form>
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