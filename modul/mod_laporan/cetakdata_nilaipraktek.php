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
<h4><b>Laporan Data Nilai Praktek</h4>
</div>";

$html .="<table  class=\"table table-bordered table-striped\">
<thead>
<tr>
<th>No</th>
<th>Periode</th>
 <th>Nama Peserta</th>
 <th>Kategori</th>
 <th>Nilai</th>
 <th>Status</th>
</tr>
</thead>
<tbody>";
      $user=new User();
      $news=$user->tampil_peserta_nilai(); 
      $nilai=$user->tampil_nilai(); 
      $no = 1;
      if(is_array($news) || is_object($news)){
      foreach ($news as $key => $r) {  
        if ($r['status_praktek']=="l") {
          $status="Lulus";
        } else {
          $status="Tidak Lulus";
        }
$html .="<tr><td>".$no."</td><td>".$r['periode']."</td><td>".$r['nama']."</td><td>".$r['kategori']."</td><td>".$r['nilai_praktek']."</td><td>".$status."</td></tr>";
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

$namefile = 'Laporan-Nilai_Praktek';
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