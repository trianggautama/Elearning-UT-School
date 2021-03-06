<?php 
require_once("../../dompdf/autoload.inc.php");
include "../../config/class.admin.php";
use Dompdf\Dompdf;
$dompdf = new Dompdf();

 $tanggal = date('d M Y');
 
$html="<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel='stylesheet' href='../../vendor/bootstrap/css/bootstrap.css' />
</head>
<body>";

$html .="<div class='text-center'>
<img src = '../../img/logo_ut.png' width='100px'>
<h4><b>Laporan Data Nilai Teori</h4>
</div>";

$html .="<table  class=\"table table-bordered table-striped\">
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

          if ($score>="75") {
          $status="Lulus";
        } else {
          $status="Tidak Lulus";
        }
$html .="<tr><td>".$no."</td><td>".$r['periode']."</td><td>".$r['nama']."</td><td>".$v['benar']."</td><td>".$salah."</td><td>".$score."</td><td>".$status."</td></tr>";
$no++;
}
}
$html .="</tbody>  
                            
</table>
<p class = 'text-right'><b>Banjarmasin, $tanggal</b></p>
<p class = 'text-right'><b>Instruktur</b></p>
<br><br>
<p class = 'text-right'><b>".$r['instruktur']."</b></p>
</body>
</html>";


$namefile = 'Laporan-Nilai_Teori';
$dompdf = new DOMPDF();
$dompdf->set_paper('A4', 'landscape');
$dompdf->load_html($html);
$dompdf->render();
//buat page number
        $font = $dompdf->getFontMetrics()->get_font("Arial", "bold");
        $dompdf->getCanvas()->page_text(430, 550, "Page {PAGE_NUM}/{PAGE_COUNT}", $font, 10, array(0,0,0));
ob_end_clean();

$dompdf->stream(''.$namefile, array('Attachment'=>0));
$output = $dompdf->output();
file_put_contents('directory/'.$namefile, $output);
?>