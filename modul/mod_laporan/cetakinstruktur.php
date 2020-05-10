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
<link href='../../css/sb-admin-2.min.css' rel='stylesheet'>
</head>
<body>";

$html .="<div class='text-center'>
<img src = '../../img/logo11.png' width='300px'>
<h4><b>Laporan Data Instruktur</h4>
</div>";

$html .="<table  class=\"table table-bordered table-striped\">
<thead>
<tr>
<th>No</th>
<th>Periode</th>
<th>Tanggal</th>
<th>Tempat</th>
<th>Instruktur</th>
</tr>
</thead>
<tbody>";
      $user=new User();
      $event=$user->tampil_instruktur();
      $no = 1;
      if(is_array($event) || is_object($event)){
      foreach ($event as $key => $r) {
        if ($r['aktif']=="y") {
          $aktif="Aktif";
         } else {
          $aktif="Nonaktif";
        } 
$html .="<tr><td>".$no."</td><td>".$r['periode']."</td><td>".$r['tanggal']."</td><td>".$r['tempat']."</td><td>".$r['instruktur']."</td></tr>";
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

$namefile = 'Laporan-Data_Kelulusan';
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