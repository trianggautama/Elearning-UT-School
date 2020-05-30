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
<link rel='stylesheet' href='../../vendor/animate/animate.css'>

<link rel='stylesheet' href='../../vendor/font-awesome/css/all.min.css' />
</head>
<body>";

$html .="<div class='text-center'>
<br>
<img src = '../../img/logo_ut.png' width='100px'>
<br>
<h4><b>Laporan Data Peserta</h4>
</div>";

$html .="

<div style='padding:15px;'>
<table  class=\"table table-bordered table-striped\">
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
<br>
<div class='row'>
<div class='col-md-11'>
</div>
<div class='col-md-1 text-center pl-5'>
<p class = ''><b>Banjarmasin, $tanggal</b></p>
<p class = ''><b>Instruktur</b></p>
<br><br>
<p class = ''><b>".$r['instruktur']."</b></p>
</div>
</div>

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