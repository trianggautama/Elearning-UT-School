<?php
// Apabila user belum login
if (empty($_SESSION['email']) and empty($_SESSION['password'])) {
    echo "<h2 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h2>
        <p class=\"fail\"><a href=\"login.php?auth\">LOGIN</a></p></div>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else {

    $aksi = "modul/mod_penjadwalan/aksi_penjadwalan.php";

    // mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    switch ($act) {
        // Tampil penjadwalan
        default: ?>

<style>
            .autocomplete {
                padding: 2px 25px;
                white-space: nowrap;
                overflow: hidden;
                background: #fff;
                position: absolute;
                z-index: 99;
            }
             .autocomplete a {
                font-family: 'Roboto', Arial, Sans-serif;
                font-size: 15px;
                color: #838384;
                text-decoration: none;
            }

            .autocomplete a hover{
                font-family: 'Roboto', Arial, Sans-serif;
                font-size: 15px;
                color: #fff;
                background: #f7f7f7;
                text-decoration: none;
            }
            .autocomplete-selected {
                background: #337ab7;
            }
            .autocomplete-suggestions strong {
                font-weight: normal;
                color: #3399FF;
            }
            .autocomplete-group {
                padding: 2px 5px;
            }
            .autocomplete-group strong {
                display: none;

            }
        </style>

<?php

            echo "

         <header class='page-header'>
         <h2>Data penjadwalan</h2>
             <div class='right-wrapper text-right'>
             <ol class='breadcrumbs'>
               <li>
                 <a href='#'>
                   <i class='fas fa-file'></i>
                 </a>
               </li>
               <li><span>Data</span></li>
               <li><span>Penjadwalan</span></li>
             </ol>
               <a class='sidebar-right-toggle'><i class='fas fa-chevron-left'></i></a>
             </div>
           </header>

        <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-md-12\">
          <div class=\"card\">
            <div class=\"card-header\">
            <div class='row'>
              <div class='col-md-6'>Data Penjadwalan</div>
              <div class='col-md-6 text-right'>
                <a href=\"modul/mod_laporan/cetakdata_penjadwalan.php\" target=\"_blank\">
                <button id=\"formbtn\" class=\"btn btn-primary\" ><i class=\"fa fa-print\"></i> Cetak </button> </a>
                <button id=\"formbtn\" class=\"btn btn-success\" onclick=location.href=\"?module=penjadwalan&act=tambahpenjadwalan\"><i class=\"fa fa-plus\"></i> Tambah penjadwalan</button>
              </div>
            </div>
            </div>
            <!-- /.card-header -->

            <div class=\"card-body table-responsive\">
              <table id=\"datatable-default\" class=\"table table-bordered table-striped\">
                <thead>
                <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Judul</th>
                <th>Tanggal Upload</th>
                <th>File</th>
                <th>Aksi</th>
                </tr>
                </thead>
                <tbody>";

            $penjadwalan = new User();
            $news = $penjadwalan->tampil_penjadwalan();
            $no = 1;
            if (is_array($news) || is_object($news)) {
                foreach ($news as $key => $r) {
                    echo "<tr><td width=10px>$no</td>
                  <td>$r[kelas]</td>
                  <td>$r[mapel]</td>
                  <td>$r[judul]</td>
                  <td>$r[tanggal_upload]</td>
                  <td><a href=\"$aksi?module=penjadwalan&act=download&filename=$r[file]\">Preview</a></td>
                  <td width=130px>
                  <a href=\"?module=penjadwalan&act=editpenjadwalan&id=$r[id_penjadwalan]\" class=\"btn btn-info btn-xs\" title=\"Edit Data\"><i class=\"fas fa-edit\"></i></a> &nbsp;
                  <a href=\"$aksi?module=penjadwalan&act=hapus&id=$r[id_penjadwalan]\" class=\"btn btn-danger btn-xs\" title=\"Delete Data\" onclick=\"return confirm('Yakin akan Menghapus Data $r[id_penjadwalan]?')\"><i class=\"fa fa-trash\"></i></a>
                  </td>
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
          <!-- /.row -->
        </section>";

            break;

        case "tambahpenjadwalan":
            echo "
      <header class='page-header'>
      <h2>Tambah Data Penjadwalan</h2>
          <div class='right-wrapper text-right'>
          <ol class='breadcrumbs'>
            <li>
              <a href='#'>
                <i class='fas fa-file'></i>
              </a>
            </li>
            <li><span>Data</span></li>
            <li><span>Penjadwalan</span></li>
            <li><span>Tambah</span></li>
          </ol>
            <a class='sidebar-right-toggle'><i class='fas fa-chevron-left'></i></a>
          </div>
        </header>

      <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-md-12\">
      <!-- Horizontal Form -->
          <div class=\"card \">
            <div class=\"card-header with-border\">
            <h3 class=\"card-title\">Tambah Data penjadwalan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class=\"form-horizontal\" method=\"POST\" enctype=\"multipart/form-data\" action=\"$aksi?module=penjadwalan&act=input\" >
            <div class=\"card-body\">
            <div class=\"form-group\">
                    <label for=\"inputNama\"  class=\"col-sm-2 control-label\">Nama Mata Pelajaran</label>
                    <div class=\"col-sm-12\">
                    <select name=\"id_mapel\" id=\"id_mapel\" class=\"form-control\">
                    <option value=\"\">-- Pilih Nama Mata Pelajaran --</option>";
            $k = new User();
            $mapel = $k->tampil_mapel();
            if (is_array($mapel) || is_object($mapel)) {
                foreach ($mapel as $key => $r) {
                    echo "  <option value=\"$r[id_mapel]\">$r[mapel]</option>
                        ";
                }
            }
            echo "  </select>
                </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"inputNama\"  class=\"col-sm-2 control-label\">Kelas</label>
                    <div class=\"col-sm-12\">
                    <select name=\"id_kelas\" id=\"id_kelas\" class=\"form-control\">
                    <option value=\"\">-- Pilih Kelas --</option>";
            $k = new User();
            $kelas = $k->tampil_kelas();
            if (is_array($kelas) || is_object($kelas)) {
                foreach ($kelas as $key => $r) {
                    echo "  <option value=\"$r[id_kelas]\">$r[kelas]</option>
                        ";
                }
            }
            echo "  </select>
                </div>
                </div>
                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Judul<span class='text-danger' title='This field is required'></span></label>
                  <div class=\"col-sm-12\">
                  <input class=\"form-control\" id=\"inputan\" autocomplete=\"off\" type=\"text\" placeholder=\"Ketik judul penjadwalan\" name=\"judul\" onkeyup=\"autoComplete();\" required>

                      <div  id=\"judul\" class=\"autocomplete\">
                  </div>
                </div>
                </div>
                <div class=\"form-group\">
                <label for=\"inputNama\" class=\"col-sm-2 control-label\">File<span class='text-danger' title='This field is required'></span></label>
                <div class=\"col-sm-12\">
                            <input type=\"file\" id=\"file\" title=\"File\"    class='form-control' name=\"file\"/>
                <p class='help-block'>File types support : PDF</p>
                <div class=\"text-danger\">
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

        case "editpenjadwalan":
            $user = new User();
            $r = $user->detail_penjadwalan_edit($_GET['id']);

            echo "
      <header class='page-header'>
      <h2>Tambah penjadwalan</h2>
          <div class='right-wrapper text-right'>
          <ol class='breadcrumbs'>
            <li>
              <a href='#'>
                <i class='fas fa-file'></i>
              </a>
            </li>
            <li><span>Data</span></li>
            <li><span>penjadwalan</span></li>
            <li><span>edit</span></li>
          </ol>
            <a class='sidebar-right-toggle'><i class='fas fa-chevron-left'></i></a>
          </div>
        </header>

      <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-md-12\">
      <!-- Horizontal Form -->
          <div class=\"card \">
            <div class=\"card-header with-border\">
            <h3 class=\"card-title\">Edit Data Penjadwalan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class=\"form-horizontal\" method=\"POST\" enctype=\"multipart/form-data\" action=\"$aksi?module=penjadwalan&act=update\">
            <input type=\"hidden\" name=\"id\" value=\"$r[id_penjadwalan]\">
              <div class=\"card-body\">
                 <div class=\"form-group\">
                    <label for=\"inputNama\"  class=\"col-sm-2 control-label\">Kelas</label>
                    <div class=\"col-sm-12\">
                    <select name=\"id_kelas\" id=\"id_kelas\" class=\"form-control\">
                    <option value=\"\">-- Pilih Kelas --</option>";
            $k = new User();
            $kelas = $k->tampil_kelas();
            if (is_array($kelas) || is_object($kelas)) {
                foreach ($kelas as $key => $p) {
                    $selected = ($p[id_kelas] == $r[id_kelas]) ? 'selected' : '';
                    echo "  <option $selected value=\"$p[id_kelas]\">$p[kelas]</option>
                        ";
                }
            }
            echo "  </select>
                </div>
                </div>
                 <div class=\"form-group\">
                    <label for=\"inputNama\"  class=\"col-sm-2 control-label\">Nama Mata Pelajaran</label>
                    <div class=\"col-sm-12\">
                    <select name=\"id_mapel\" id=\"id_mapel\" class=\"form-control\">
                    <option value=\"\">-- Pilih Nama Mata Pelajaran --</option>";
            $k = new User();
            $mapel = $k->tampil_mapel();
            if (is_array($mapel) || is_object($mapel)) {
                foreach ($mapel as $key => $p) {
                    $selected = ($p[id_mapel] == $r[id_mapel]) ? 'selected' : '';
                    echo "  <option $selected value=\"$p[id_mapel]\">$p[nama]</option>
                        ";
                }
            }
            echo "  </select>
                </div>
                </div>
                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Judul<span class='text-danger' title='This field is required'></span></label>
                  <div class=\"col-sm-12\">
                  <input class=\"form-control\" id=\"inputan\" autocomplete=\"off\" type=\"text\"  name=\"judul\" value=\"$r[judul]\" >
                  </div>
                </div>
                <div class=\"form-group\">
                <label for=\"inputNama\" class=\"col-sm-2 control-label\">File<span class='text-danger' title='This field is required'></span></label>
                <div class=\"col-sm-12\">
                            <input type=\"file\" id=\"file\" title=\"File\"    class='form-control' name=\"file\"/>
                <p class='help-block'>File types support : PDF</p>
                <div class=\"text-danger\">
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
 <script language="JavaScript">
    var ajaxRequest;
    function getAjax() { //fungsi untuk mengecek AJAX pada browser
        try {
            ajaxRequest = new XMLHttpRequest();
        } catch (e) {
            try {
                ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e) {
                try {
                   ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    alert("Your browser broke!");
                    return false;
                }
            }
        }
    }
    function autoComplete() { //fungsi menangkap input search dan menampilkan hasil search
        getAjax();
        input = document.getElementById('inputan').value;
        if (input == "") {
            document.getElementById("penjadwalan").innerHTML = "";
        }
        else {
            ajaxRequest.open("GET","cari.php?input="+input);
            ajaxRequest.onreadystatechange = function() {
                document.getElementById("penjadwalan").innerHTML = ajaxRequest.responseText;
            }
            ajaxRequest.send(null);
        }
    }

    function autoInsert(nama) { //fungsi mengisi input text dengan hasil pencarian yang dipilih
        document.getElementById("inputan").value = name;
        document.getElementById("penjadwalan").innerHTML = "";

    }
</script>