<?php    
// Apabila user belum login
if (empty($_SESSION['email']) AND empty($_SESSION['password'])){
  echo "<h2 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h2>
        <p class=\"fail\"><a href=\"login.php?auth\">LOGIN</a></p></div>";   
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  

  $aksi = "modul/mod_profil/aksi_profil.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil user
    default:
     case "edituser":
     $user=new User();
      $r=$user->detail_user($_GET['id']);
      
      echo"
      <header class='page-header'>
      <h2>Profil User</h2>
          <div class='right-wrapper text-right'>
          <ol class='breadcrumbs'>
            <li>
              <a href='#'>
                <i class='fas fa-file'></i>
              </a>
            </li>
            <li><span>User</span></li>
            <li><span>Profil</span></li>
          </ol> 
            <a class='sidebar-right-toggle'><i class='fas fa-chevron-left'></i></a>
          </div>
        </header>

      <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-md-12\">
      <!-- Horizontal Form -->
          <div class=\"card\">
            <div class=\"card-header with-border\">
             <h3 class=\"card-title\">Edit Data User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class=\"form-horizontal\" method=\"POST\" enctype=\"multipart/form-data\" action=\"$aksi?module=profile&act=update\">
            <input type=\"hidden\" name=\"id\" value=\"$r[id_user]\">
              <div class=\"card-body\">

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"control-label\">Nrp<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"\">
                    <input type=\"text\" name=\"nrp\" class=\"form-control\" id=\"inputNama \" value=\"$r[nrp]\">
                  </div>
                </div>

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"control-label\">Nama<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"ol-sm-9c\">
                    <input type=\"text\" name=\"nama\" class=\"form-control\" id=\"inputNama \" value=\"$r[nama]\">
                  </div>
                </div>
                <div class='row mb-3'>
                  <div class='col-md-6'>
                      <div class=\"form-group\">
                      <label for=\"inputNama\" class=\"control-label\">Tempat Lahir<span class='text-danger' title='This field is required'>*</span></label>
                      <div class=\"\">
                        <input type=\"text\" name=\"tempat_lahir\" class=\"form-control\" id=\"inputNama \" value=\"$r[tempat_lahir]\">
                      </div>
                    </div>  
                  </div>
                  <div class='col-md-6'>
                    <div class=\"form-group\">
                    <label for=\"inputNama\" class=\"control-label\">Tanggal Lahir<span class='text-danger' title='This field is required'>*</span></label>
                    <div class=\"\">
                      <input type=\"date\" name=\"tanggal_lahir\" class=\"form-control\" id=\"inputNama \" value=\"$r[tanggal_lahir]\">
                    </div>
                  </div> 
                  </div>
                </div>
                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"control-label\">Jenis Kelamin<span class='text-danger' title='This field is required'>*</span></label>
                <div class=\"\">
                <div class='row'>
                  <div class='col-md-2'>
                    <div class=\"form-check\">
                    <input class=\"form-check-input\" type=\"radio\" name=\"jk\" id=\"exampleRadios1\" value=\"Laki-laki\" checked>
                    <label class=\"form-check-label\" for=\"exampleRadios1\">
                      Laki-laki
                    </label>
                  </div>
                  </div>
                  <div class='col-md-6'>
                  <div class=\"form-check\">
                    <input class=\"form-check-input\" type=\"radio\" name=\"jk\" id=\"exampleRadios2\" value=\"Perempuan\">
                    <label class=\"form-check-label\" for=\"exampleRadios2\">
                      Perempuan
                    </label>
                    </div>
                  </div>
                </div>
              </div>
              </div>  

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"control-label\">Email<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"\">
                    <input type=\"text\" name=\"email\" class=\"form-control\" id=\"inputNama \" value=\"$r[email]\">
                  </div>
                </div>  

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"control-label\">Asal Perusahaan<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"\">
                    <input type=\"text\" name=\"asal\" class=\"form-control\" id=\"inputNama \" value=\"$r[asal]\">
                  </div>
                </div> 

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"control-label\">Jabatan<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"\">
                    <input type=\"text\" name=\"jabatan\" class=\"form-control\" id=\"inputNama \" value=\"$r[jabatan]\">
                  </div>
                </div>

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"control-label\">Password<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"\">
                    <input type=\"password\" name=\"pass\" class=\"form-control\"  id=\"inputPass \" placeholder=\"Bila tidak diganti, biarkan kosong\">
                  </div>
                </div> 

                <div class='form-group header-group-0 ' id='form-group-photo' >
                <label class='control-label'>Photo</label>
                <div class=\"\">";
                   if ($r['foto']!=""){
                  echo"<img src='photo_user/small_$r[foto]'/>";
                  } else {echo "[user ini tidak ada photo]";}         
                echo"
                <div class=\"text-danger\">
                </div>
                </div>
                </div>              

                <div class='form-group header-group-0 ' id='form-group-photo' >
                <label class='control-label'>Ubah Photo</label>
                <div class=\"\">
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
              <div class=\"card-footer text-right\">
                <button type=\"submit\" class=\"btn btn-default\" onclick=\"self.history.back()\">Back</button> &nbsp;                
                <button type=\"submit\" name=\"submit\" class=\"btn btn-success\">Simpan</button>                
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