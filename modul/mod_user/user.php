<?php    
// Apabila user belum login
if (empty($_SESSION['email']) AND empty($_SESSION['password'])){
  echo "<h2 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h2>
        <p class=\"fail\"><a href=\"login.php?auth\">LOGIN</a></p></div>";   
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  

  $aksi = "modul/mod_user/aksi_user.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil user
    default:

        echo "

        <header class='page-header'>
        <h2>Data User</h2>
            <div class='right-wrapper text-right'>
            <ol class='breadcrumbs'>
              <li>
                <a href='#'>
                  <i class='fas fa-file'></i>
                </a>
              </li>
              <li><span>Data</span></li>
              <li><span>User</span></li>
            </ol> 
              <a class='sidebar-right-toggle'><i class='fas fa-chevron-left'></i></a>
            </div>
          </header>

        <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-xs-12\">    

          <div class=\"card\">
            <div class=\"card-header\">
            <div class='row'>
              <div class='col-md-6'>
                Data User
              </div>
              <div class='col-md-6 text-right'>
                <button id=\"formbtn\" class=\"btn btn-success\" onclick=location.href=\"?module=user&act=tambahuser\"><i class=\"fa fa-plus\"></i> Tambah User</button>
              </div>
            </div>          
            </div>
            <!-- /.card-header -->

            <div class=\"card-body table-responsive\">
              <table id=\"datatable-default\" class=\"table table-bordered table-striped\">
                <thead>
                <tr>
                <th>No</th>
                <th>nrp</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Email</th>
                <th>Asal Perusahaan</th>
                <th>Jabatan</th>
                <th>Photo</th>
                <th>Aksi</th>
                </tr>
                </thead>
                <tbody>";

      $user=new User();
      $news=$user->tampil_user();  
      $no = 1;
      if(is_array($news) || is_object($news)){
      foreach ($news as $key => $r) {  
                echo "<tr><td width=10px>$no</td>
                  <td>$r[nrp]</td>
                  <td>$r[nama]</td>
                  <td>$r[tempat_lahir]</td>
                  <td>$r[tanggal_lahir]</td>
                  <td>$r[jk]</td>
                  <td>$r[email]</td>
                  <td>$r[asal]</td>
                  <td>$r[jabatan]</td>
                  <td>";
                  if ($r['foto']!=""){
                  echo"<img src='photo_user/small_$r[foto]'/>";
                  }
                 echo" </td>
		              <td width=130px>
                  <a href=\"?module=user&act=edituser&id=$r[id_user]\" class=\"btn btn-info btn-xs\" title=\"Edit Data\"><i class=\"fas fa-edit\"></i></a> &nbsp;
                  <a href=\"$aksi?module=user&act=hapus&id=$r[id_user]\" class=\"btn btn-danger btn-xs\" title=\"Delete Data\" onclick=\"return confirm('Yakin akan Menghapus Data $r[nama]?')\"><i class=\"fa fa-trash\"></i></a></td>
              </tr>";
              $no++;
            }
          }
                
                echo "</tbody>  
                            
                </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>";
          
    break;    
  
    case "tambahuser":
      echo "
      <section class=\"content-header\">
      <h1>
        Tambah Data User
      </h1>
      <ol class=\"breadcrumb\">
        <li><a href=\"index.php?module=home\"><i class=\"fa fa-dashboard\"></i> Home</a></li>
        <br>
      </ol>
      </section>

      <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-md-12\">
      <!-- Horizontal Form -->
          <div class=\"card card-info\">
            <div class=\"card-header with-border\">
            <h3 class=\"card-title\">Tambah Data User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class=\"form-horizontal\" method=\"POST\" action=\"$aksi?module=user&act=input\" enctype=\"multipart/form-data\">
              <div class=\"card-body\">
                <div class=\"form-group\">
                  <label for=\"inputUsername\" class=\"col-sm-2 control-label\">NRP<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" name=\"nrp\" class=\"form-control\" id=\"inputnrp \" placeholder=\"\" required>
                  </div>
                </div>

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Nama Lengkap User<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" name=\"nama\" class=\"form-control\" id=\"inputNama \" placeholder=\"\" required>
                  </div>
                </div>

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Password<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"password\" name=\"pass\" class=\"form-control\" id=\"inputPass \" placeholder=\"\" required>
                  </div>
                </div>

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Tempat Lahir<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" name=\"tempat_lahir\" class=\"form-control\" id=\"inputNama \" placeholder=\"\" required>
                  </div>
                </div> 

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Tanggal Lahir<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"date\" name=\"tanggal_lahir\" class=\"form-control\" id=\"inputNama \" placeholder=\"\" required>
                  </div>
                </div>              
          
                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Jenis Kelamin<span class='text-danger' title='This field is required'>*</span></label>
                <div class=\"col-sm-9\">
                <div class=\"form-check\">
                <input class=\"form-check-input\" type=\"radio\" name=\"jk\" id=\"exampleRadios1\" value=\"Laki-laki\" checked>
                <label class=\"form-check-label\" for=\"exampleRadios1\">
                  Laki-laki
                </label>
                </div>
                <div class=\"form-check\">
                <input class=\"form-check-input\" type=\"radio\" name=\"jk\" id=\"exampleRadios2\" value=\"Perempuan\">
                <label class=\"form-check-label\" for=\"exampleRadios2\">
                  Perempuan
                </label>
              </div>
              </div>
              </div>

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Email<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" name=\"email\" class=\"form-control\" id=\"inputNama \" placeholder=\"\" required>
                  </div>
                </div>

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Asal<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" name=\"asal\" class=\"form-control\" id=\"inputNama \" placeholder=\"\" required>
                  </div>
                </div>

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Jabatan<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" name=\"jabatan\" class=\"form-control\" id=\"inputNama \" placeholder=\"\" required>
                  </div>
                </div>

                 <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Level<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" name=\"level\" class=\"form-control\" id=\"inputNama \" placeholder=\"\" required>
                  </div>
                </div>

                <div class='form-group header-group-0 ' id='form-group-photo' >
                <label class='col-sm-2 control-label'>Photo</label>
                <div class=\"col-sm-9\">
                            <input type='file' id=\"photo\" title=\"Photo\"    class='form-control' name=\"fupload\"/>
                <p class='help-block'>File types support : JPG, JPEG, PNG, GIF</p>
                <div class=\"text-danger\">
                </div>
                </div>
                </div>                
                  
                <div class=\"form-group\">
                  <div class=\"col-sm-offset-2 col-sm-8\">
                  </div>
                </div>
                
              </div>
              <!-- /.card-body -->
              <div class=\"card-footer text-center\">
                <button type=\"submit\" class=\"btn btn-default\" onclick=\"self.history.back()\">Back</button> &nbsp;                
                <button type=\"submit\" name=\"submit\" class=\"btn btn-info\">Save</button>                
              </div>
              <!-- /.card-footer -->
            </form>
          
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
          
          <!-- /.card --> ";
    break;
       
    case "edituser":
     $user=new User();
      $r=$user->detail_user($_GET['id']);
      
      echo"<section class=\"content-header\">
      <h1>
        Profile
      </h1>
      </section>

      <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-xs-12\">
      <!-- Horizontal Form -->
          <div class=\"card card-info\">
            <div class=\"card-header with-border\">
            <!-- <h3 class=\"card-title\">Edit Data User</h3> -->
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class=\"form-horizontal\" method=\"POST\" enctype=\"multipart/form-data\" action=\"$aksi?module=user&act=update\">
            <input type=\"hidden\" name=\"id\" value=\"$r[id_user]\">
              <div class=\"card-body\">

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Nrp<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" name=\"nrp\" class=\"form-control\" id=\"inputNama \" value=\"$r[nrp]\">
                  </div>
                </div>

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Nama<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" name=\"nama\" class=\"form-control\" id=\"inputNama \" value=\"$r[nama]\">
                  </div>
                </div>

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Tempat Lahir<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" name=\"tempat_lahir\" class=\"form-control\" id=\"inputNama \" value=\"$r[tempat_lahir]\">
                  </div>
                </div>  

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Tanggal Lahir<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"date\" name=\"tanggal_lahir\" class=\"form-control\" id=\"inputNama \" value=\"$r[tanggal_lahir]\">
                  </div>
                </div>  

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Jenis Kelamin<span class='text-danger' title='This field is required'>*</span></label>
                <div class=\"col-sm-9\">
                <div class=\"form-check\">
                <input class=\"form-check-input\" type=\"radio\" name=\"jk\" id=\"exampleRadios1\" value=\"Laki-laki\" checked>
                <label class=\"form-check-label\" for=\"exampleRadios1\">
                  Laki-laki
                </label>
                </div>
                <div class=\"form-check\">
                <input class=\"form-check-input\" type=\"radio\" name=\"jk\" id=\"exampleRadios2\" value=\"Perempuan\">
                <label class=\"form-check-label\" for=\"exampleRadios2\">
                  Perempuan
                </label>
              </div>
              </div>
              </div>  

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Email<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" name=\"email\" class=\"form-control\" id=\"inputNama \" value=\"$r[email]\">
                  </div>
                </div>  

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Asal Perusahaan<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" name=\"asal\" class=\"form-control\" id=\"inputNama \" value=\"$r[asal]\">
                  </div>
                </div> 

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Jabatan<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" name=\"jabatan\" class=\"form-control\" id=\"inputNama \" value=\"$r[jabatan]\">
                  </div>
                </div>

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Password<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                    <input type=\"password\" name=\"pass\" class=\"form-control\"  id=\"inputPass \" placeholder=\"Bila tidak diganti, biarkan kosong\">
                  </div>
                </div> 

                <div class='form-group header-group-0 ' id='form-group-photo' >
                <label class='col-sm-2 control-label'>Photo</label>
                <div class=\"col-sm-9\">";
                   if ($r['foto']!=""){
                  echo"<img src='photo_user/small_$r[foto]'/>";
                  } else {echo "[user ini tidak ada photo]";}         
                echo"
                <div class=\"text-danger\">
                </div>
                </div>
                </div>              

                <div class='form-group header-group-0 ' id='form-group-photo' >
                <label class='col-sm-2 control-label'>Ubah Photo</label>
                <div class=\"col-sm-9\">
                            <input type='file' id=\"photo\" title=\"Photo\"    class='form-control' name=\"fupload\"/>
                <p class='help-block'>Bila tidak diganti, biarkan kosong. File support : JPG, JPEG, PNG, GIF</p>
                <div class=\"text-danger\">
                </div>
                </div>
                </div>                
                  
                <div class=\"form-group\">
                  <div class=\"col-sm-offset-2 col-sm-8\">
                  </div>
                </div>
                
              </div>
              <!-- /.card-body -->
              <div class=\"card-footer text-center\">
                <button type=\"submit\" class=\"btn btn-default\" onclick=\"self.history.back()\">Back</button> &nbsp;                
                <button type=\"submit\" name=\"submit\" class=\"btn btn-info\">Simpan</button>                
              </div>
              <!-- /.card-footer -->
            </form>
          
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
          
          <!-- /.card --> ";


  
    break;  
  }
}
?>
