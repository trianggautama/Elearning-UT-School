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
<h4><b>Laporan Data Peserta</h4>
</div>";

$html .="<table  class=\"table table-bordered table-striped\">
<thead>
<tr>
<th>No</th>
<th>Periode</th>
<th>Nama Peserta</th>
<th>Tempat Lahir</th>
<th>Tanggal Lahir</th>
<th>Asal Perusahaan</th>
<th>Jabatan</th>
</tr>
</thead>
<tbody>";
      $user=new User();
      $event=$user->detail_event_aktif(); 
      $id_event=$event['id_event'];
      $news=$user->tampil_nilai_hteori($event['periode']); 
      $no = 1;
      if(is_array($news) || is_object($news)){
      foreach ($news as $key => $r) { 
$html .="<tr><td>".$no."</td><td>".$r['periode']."</td><td>".$r['nama']."</td><td>".$r['tempat_lahir']."</td><td>".$r['tanggal_lahir']."</td><td>".$r['asal']."</td><td>".$r['jabatan']."</td></tr>";
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

$namefile = 'Laporan-Data_Peserta';
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