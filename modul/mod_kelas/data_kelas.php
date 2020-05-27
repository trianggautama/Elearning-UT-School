<?php
// Apabila user belum login
if (empty($_SESSION['email']) and empty($_SESSION['password'])) {
    echo "<h2 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h2>
        <p class=\"fail\"><a href=\"login.php?auth\">LOGIN</a></p></div>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else {

    $aksi = "modul/mod_kelas/aksi_kelas.php";

    // mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    switch ($act) {
        // Tampil kelas
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
         <h2>Data kelas</h2>
             <div class='right-wrapper text-right'>
             <ol class='breadcrumbs'>
               <li>
                 <a href='#'>
                   <i class='fas fa-file'></i>
                 </a>
               </li>
               <li><span>Data</span></li>
               <li><span>Kelas</span></li>
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
              <div class='col-md-6'>Data Kelas</div>
              <div class='col-md-6 text-right'>
                <a href=\"modul/mod_laporan/cetakdata_kelas.php\" target=\"_blank\">
                <button id=\"formbtn\" class=\"btn btn-primary\" ><i class=\"fa fa-print\"></i> Cetak </button> </a>
                <button id=\"formbtn\" class=\"btn btn-success\" onclick=location.href=\"?module=kelas&act=tambahkelas\"><i class=\"fa fa-plus\"></i> Tambah Kelas</button>
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
                <th>Aksi</th>
                </tr>
                </thead>
                <tbody>";

            $kelas = new User();
            $news = $kelas->tampil_kelas();
            $no = 1;
            if (is_array($news) || is_object($news)) {
                foreach ($news as $key => $r) {
                    echo "<tr><td width=10px>$no</td>
                  <td>$r[kelas]</td>
                  <td width=130px>
                  <a href=\"?module=kelas&act=editkelas&id=$r[id_kelas]\" class=\"btn btn-info btn-xs\" title=\"Edit Data\"><i class=\"fas fa-edit\"></i></a> &nbsp;
                  <a href=\"$aksi?module=kelas&act=hapus&id=$r[id_kelas]\" class=\"btn btn-danger btn-xs\" title=\"Delete Data\" onclick=\"return confirm('Yakin akan Menghapus Data $r[id_kelas]?')\"><i class=\"fa fa-trash\"></i></a></td>
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

        case "tambahkelas":
            echo "
      <header class='page-header'>
      <h2>Tambah Kelas</h2>
          <div class='right-wrapper text-right'>
          <ol class='breadcrumbs'>
            <li>
              <a href='#'>
                <i class='fas fa-file'></i>
              </a>
            </li>
            <li><span>Data</span></li>
            <li><span>kelas</span></li>
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
            <h3 class=\"card-title\">Tambah Data Kelas</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class=\"form-horizontal\" method=\"POST\" action=\"$aksi?module=kelas&act=input\" >
              <div class=\"card-body\">

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Nama Kelas<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-12\">
                  <input class=\"form-control\" id=\"inputan\" autocomplete=\"off\" type=\"text\" placeholder=\"Ketik nama kelas\" name=\"kelas\" onkeyup=\"autoComplete();\" required>

                      <div  id=\"kelas\" class=\"autocomplete\">
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

        case "editkelas":
            $user = new User();
            $r = $user->detail_kelas_edit($_GET['id']);

            echo "
      <header class='page-header'>
      <h2>Tambah kelas</h2>
          <div class='right-wrapper text-right'>
          <ol class='breadcrumbs'>
            <li>
              <a href='#'>
                <i class='fas fa-file'></i>
              </a>
            </li>
            <li><span>Data</span></li>
            <li><span>kelas</span></li>
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
            <h3 class=\"card-title\">Edit Data Kelas</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class=\"form-horizontal\" method=\"POST\" action=\"$aksi?module=kelas&act=update\">
            <input type=\"hidden\" name=\"id\" value=\"$r[id_kelas]\">
              <div class=\"card-body\">

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Nama kelas<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-12\">
                  <input class=\"form-control\" id=\"inputan\" autocomplete=\"off\" type=\"text\"  name=\"kelas\" value=\"$r[kelas]\" >
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
            document.getElementById("kelas").innerHTML = "";
        }
        else {
            ajaxRequest.open("GET","cari.php?input="+input);
            ajaxRequest.onreadystatechange = function() {
                document.getElementById("kelas").innerHTML = ajaxRequest.responseText;
            }
            ajaxRequest.send(null);
        }
    }

    function autoInsert(nama) { //fungsi mengisi input text dengan hasil pencarian yang dipilih
        document.getElementById("inputan").value = kelas;
        document.getElementById("kelas").innerHTML = "";

    }
</script>