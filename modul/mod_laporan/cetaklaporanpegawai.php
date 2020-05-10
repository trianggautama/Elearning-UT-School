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
<img src = '../../images/header-lap.png'>
<h4><b>Laporan Pegawai</h4>
</div>";

$html .="<table  class=\"table table-bordered table-striped\">
<thead>
<tr>
<th>No</th>
<th>NIK</th>
<th>Nama Pegawai</th>
<th>Jabatan</th>
<th>Umur (th)</th>
<th>Mulai Bekerja</th>
</tr>
</thead>
<tbody>";
      $user=new User();
      $news=$user->tampil_peserta();  
      $no = 1;
      if(is_array($news) || is_object($news)){
      foreach ($news as $key => $r) { 
$html .="<tr><td>".$no."</td><td>".$r['id_peserta']."</td><td>".$r['id_event']."</td><td>".$r['id_user']."</td><td>".$r['pembayaran']."</td></tr>";
$no++;
}
}
$html .="</tbody>  
                            
</table>
<p class = 'text-right'><b>Banjarmasin, $tanggal</b></p>
<p class = 'text-right'><b>Staff</b></p>
<br><br>
<p class = 'text-right'><b>Arif Rahman Hakim</b></p>
</body>
</html>";

$namefile = 'Laporan-Pegawai';
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