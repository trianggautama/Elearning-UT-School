<?php    
// Apabila user belum login
if (empty($_SESSION['email']) AND empty($_SESSION['password'])){
  echo "<h2 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h2>
        <p class=\"fail\"><a href=\"login.php?auth\">LOGIN</a></p></div>";   
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  

  $aksi = "modul/mod_praktek/aksi_praktek.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil peserta
    default: ?>

<?php 

        echo "
        
        <header class='page-header'>
        <h2>Nilai Tes Teori</h2>
          <div class='right-wrapper text-right'>
            <ol class='breadcrumbs'>
              <li>
                <a href='#'>
                  <i class='fas fa-file'></i>
                </a>
              </li>
              <li><span>Data</span></li>
              <li><span>Nilai Tes Teori</span></li>
            </ol> 
            <a class='sidebar-right-toggle'><i class='fas fa-chevron-left'></i></a>
          </div>
        </header>
        
        <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-md-12\">
        <div class='card'>
          <div class='card-header'>
            <div class='row'>
              <div class='col-md-6'>
                <h3>Data Nilai</h3>
              </div>
              <div class='col-md-6'>
                <div class='text-right'>
                  <a href=\"modul/mod_laporan/cetakdata_nilaiteori.php\" target=\"_blank\">
                  <button id=\"formbtn\" class=\"btn btn-success\" ><i class=\"fa fa-print\"></i> Cetak </button> </a>
                </div>
              </div>
            </div>
          </div>
          <div class='card-body'>
          <div class=\"box-body table-responsive\">
          <table id=\"datatable-default\" class=\"table table-bordered table-striped\">
            <thead>
            <tr>
            <th>No</th>
            <th>Periode</th>
            <th>Nama Peserta</th>
            <th>Benar</th>
            <th>Salah</th>
            <th>Nilai</th>
            <th>Status</th>
            </tr>
            </thead>
            <tbody>";

  $user=new User();
  $soal=$user->tampil_soal_aktif();
  $event=$user->detail_event_aktif(); 
  $id_event=$event['id_event'];
  $news=$user->tampil_nilai_hteori($event['periode']);
  $jumlah_soal=count($soal);
  $no=1;
  if(is_array($news) || is_object($news)){
  foreach ($news as $key => $r) {  
    
    $query =" SELECT count(b_s) as benar from hasil_test WHERE b_s ='B' and id_event='$id_event' and id_user='$r[id_user]'";
    $result =$mysqli->query($query);
    $v=$result->fetch_assoc();
    // mncari nilai
    $score = (100/$jumlah_soal)*$v['benar']; 
    $salah = $jumlah_soal-$v['benar'];

      if ($score>="70") {
      $status="Lulus";
    } else {
      $status="Tidak Lulus";
    }
            echo "<tr><td width=10px>$no</td>
              <td>$r[periode]</td>
              <td>$r[nama]</td>
              <td>$v[benar]</td>
              <td>$salah</td>
              <td>$score</td>
              <td>$status</td>
              
          </tr>";
          $no++;
        }
      }
            
            echo "</tbody>  
            </table>
            </div>
            <!-- /.box-body -->

          </div>
        </div>    
        </section>";
          
    break;    
  
    case "tambahpraktek":
      echo "
      <section class=\"content-header\">
      <h1>
        Data Praktek
      </h1>
      <ol class=\"breadcrumb\">
        <li><a href=\"index.php?module=beranda\"><i class=\"fa fa-dashboard\"></i> Home</a></li>
        <li class=\"active\">Tambah Data Praktek</li>
      </ol>
      </section>

      <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-md-12\">
      <!-- Horizontal Form -->
          <div class=\"box box-info\">
            <div class=\"box-header with-border\">
            <h3 class=\"box-title\">Tambah Data Praktek</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class=\"form-horizontal\" method=\"POST\" action=\"$aksi?module=praktek&act=input\" enctype=\"multipart/form-data\">
              <div class=\"box-body\"> 

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Nama User<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                  <input class=\"form-control\" id=\"inputan\" autocomplete=\"off\" type=\"text\" placeholder=\"Ketik beberapa huruf\" name=\"nama\" onkeyup=\"autoComplete();\" required>
                    <input type=\"hidden\" name=\"id_user\" class=\"form-control\" id=\"id_user\" placeholder=\"\" required>
                      <div  id=\"hasil\" class=\"autocomplete\">
                  </div>
                </div>
                </div>              
          
                 <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Kategori<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                  <input class=\"form-control\" id=\"inputan\" type=\"text\" placeholder=\"\" name=\"kategori\" required>
                    </div>
                </div> 

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Nilai<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                  <input class=\"form-control\" id=\"inputan\" type=\"text\" placeholder=\"\" name=\"nilai\" required>
                    </div>
                </div>
                  
                <div class=\"form-group\">
                  <div class=\"col-sm-offset-2 col-sm-8\">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class=\"box-footer text-center\">
                <button type=\"submit\" class=\"btn btn-default\" onclick=\"self.history.back()\">Back</button> &nbsp;                
                <button type=\"submit\" name=\"submit\" class=\"btn btn-info\">Save</button>                
              </div>
              <!-- /.box-footer -->
            </form>
          
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
          
          <!-- /.box --> ";
    break;
       
    case "editpraktek":
     $user=new User();
      $r=$user->detail_peserta_nilai($_GET['id']);
      $p=$user->detail_user($r['id_user']);
      echo"<section class=\"content-header\">
      <h1>
        Data Hasil Test Praktek
      </h1>
      <ol class=\"breadcrumb\">
        <li><a href=\"index.php?module=beranda\"><i class=\"fa fa-dashboard\"></i> Home</a></li>
        <li class=\"active\">Edit Data Peserta</li>
      </ol>
      </section>

      <section class=\"content\">
        <div class=\"row\">
        <div class=\"col-xs-12\">
      <!-- Horizontal Form -->
          <div class=\"box box-info\">
            <div class=\"box-header with-border\">
            <h3 class=\"box-title\">Tambah Data Peserta</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class=\"form-horizontal\" method=\"POST\" enctype=\"multipart/form-data\" action=\"$aksi?module=praktek&act=update\">
            <input type=\"hidden\" name=\"id\" value=\"$r[id_test]\">
              <div class=\"box-body\">

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Nama User<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                  <input type=\"text\" name=\"nama\" value=\"$p[nama]\" class=\"form-control\" id=\"nama\" placeholder=\"\" readonly>
                  </div>
                </div> 

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Kategori<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                  <input class=\"form-control\" id=\"inputan\" value=\"$r[kategori]\" type=\"text\" placeholder=\"\" name=\"kategori\" required>
                    </div>
                </div> 

                <div class=\"form-group\">
                  <label for=\"inputNama\" class=\"col-sm-2 control-label\">Nilai<span class='text-danger' title='This field is required'>*</span></label>
                  <div class=\"col-sm-9\">
                  <input class=\"form-control\" id=\"inputan\" value=\"$r[nilai_praktek]\" type=\"text\" placeholder=\"\" name=\"nilai\" required>
                    </div>
                </div>   

                
                <div class=\"form-group\">
                  <div class=\"col-sm-offset-2 col-sm-8\">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class=\"box-footer text-center\">
                <button type=\"submit\" class=\"btn btn-default\" onclick=\"self.history.back()\">Back</button> &nbsp;                
                <button type=\"submit\" name=\"submit\" class=\"btn btn-info\">Save</button>                
              </div>
              <!-- /.box-footer -->
            </form>
          
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
          
          <!-- /.box --> ";


  
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
            document.getElementById("hasil").innerHTML = "";
        }
        else {
            ajaxRequest.open("GET","cari.php?input="+input);
            ajaxRequest.onreadystatechange = function() {
                document.getElementById("hasil").innerHTML = ajaxRequest.responseText;
            }
            ajaxRequest.send(null);
        }
    }
    function convertToRupiah(angka)
      {
        var rupiah = '';    
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp '+rupiah.split('',rupiah.length-1).reverse().join('');
      }

    function autoInsert(id_user,nama) { //fungsi mengisi input text dengan hasil pencarian yang dipilih
        document.getElementById("inputan").value = nama;
        document.getElementById("id_user").value = id_user;
        document.getElementById("hasil").innerHTML = "";

    }       
</script>