<?php 
class Tanggal 
{     
// konversi menjadi nama hari bahasa indonesia
public function tgl(){  
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari     = date("w");
$hari_ini = $seminggu[$hari]; // konversi menjadi hari bahasa indonesia

$tgl_sekarang = date("Ymd");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");

//bikin jatuh tempo
$timestamp = strtotime("+4 day");
$sekarang = date("d-m-y");
$besok=date("Ymd",$timestamp);

// format penanggalan di database MySQL
$tanggal=date("Y-m-d"); 
}
// fungsi untuk mengubah tanggal menjadi format bahasa indonesia, contoh: 14 Maret 2014 
public function tgl_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan   = ambilbulan(substr($tgl,5,2)); // konversi menjadi nama bulan bahasa indonesia
	$tahun   = substr($tgl,0,4);
	return $tanggal.' '.$bulan.' '.$tahun;		 
}	

// fungsi untuk mengubah angka bulan menjadi nama bulan
public function ambilbulan($bln){
  if ($bln=="01") return "Jan";
  elseif ($bln=="02") return "Feb";
  elseif ($bln=="03") return "Mar";
  elseif ($bln=="04") return "Apr";
  elseif ($bln=="05") return "Mei";
  elseif ($bln=="06") return "Jun";
  elseif ($bln=="07") return "Jul";
  elseif ($bln=="08") return "Agu";
  elseif ($bln=="09") return "Sept";
  elseif ($bln=="10") return "Okt";
  elseif ($bln=="11") return "Nop";
  elseif ($bln=="12") return "Des";
} 

// fungsi untuk mengubah susunan format tanggal
public function ubah_tgl($tanggal) { 
   $pisah   = explode('/',$tanggal);
   $larik   = array($pisah[2],$pisah[1],$pisah[0]);
   $satukan = implode('-',$larik);
   return $satukan;
}

public function ubah_tgl2($tanggal) { 
   $pisah   = explode('-',$tanggal);
   $larik   = array($pisah[2],$pisah[1],$pisah[0]);
   $satukan = implode('/',$larik);
   return $satukan;
}
}
?>
