<?php 
require_once("../../dompdf/autoload.inc.php");
include "../../config/class.admin.php";
use Dompdf\Dompdf;
$dompdf = new Dompdf();

 $tanggal = date('d M Y');
 
$html="<!DOCTYPE html>
<html>
<head>
<title>Sertifikat</title>
<link href='../../css/sb-admin-2.min.css' rel='stylesheet'>
<style>

table {
  border: 0;
  width:90%;
  margin-left:50px;
}



</style>
</head>
<body>


";

$html .="<div class='text-center'>
<img src = '../../img/sertifikat.png' width=450px>
</div>";

      $user=new User();
      $p=$user->tampil_hasil_kelulusanid($_GET['id']);
      $tanggal_lahir=date('d F Y',strtotime($p['tanggal_lahir']));
      $tanggalt=date('d F Y',strtotime($p['tanggal']));
   
      if ($r['status_praktek']=="l") {
          $status="Lulus";
        } else {
          $status="Tidak Lulus";
        }
$html .="<br>
 <h3 class='text-center'>".strtoupper($p['nama'])."<h3>
 <table> 
 <tr>
 <td width=300px> <u> Tempat & Tanggal Lahir</u> <br> <i>Place & Date of Birth</i> </td> <td width=20px>:</td><td class='text-left'>".strtoupper($p['tempat_lahir']).", ".strtoupper($tanggal_lahir)."</td>
 </tr>
 <tr>
 <td> <u> Nama Perusahaan </u> <br> <i>Name of Company</i></td><td> :</td><td>".strtoupper($p['asal'])."</td>
 </tr>
 <tr>
 <td> <u> Telah Mengikuti Pelatihan </u> <br> <i>Has complated Training</i></td><td>  :</td><td>".strtoupper($p['kategori'])."</td>
 </tr>
 <tr>
 <td> <u> Periode & Tempat </u> <br> <i>Period & Venue</i></td><td> :</td><td>".strtoupper($tanggalt).", DI ".strtoupper($p['tempat'])."</td>
 </tr>

<tr>
 <td height='50px'></td>
 <td></td> 
 <td></td>
 </tr>
 <tr>
 <td></td>
 <td></td>
 <td class = 'text-right'> <b>Banjarmasin, $tanggal</b> </td>
 </tr>
 <tr>
 <td></td>
 <td></td>
 <td class = 'text-right'> <b>Instruktur &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</b> </td>
 </tr>
 <tr>
 <td height='50px'></td>
 <td></td> 
 <td></td>
 </tr>
 <tr>
 <td></td>
 <td></td>
 <td class = 'text-right'><b>".strtoupper($p['instruktur'])."</b></td>
 </tr>
 </table>";

$html .="
</body>
</html>";

$namefile = 'Laporan-Sertifikat';
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