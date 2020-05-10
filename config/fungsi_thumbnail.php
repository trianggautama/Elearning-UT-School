<?php
class Gambar 
{
// Upload gambar untuk berita, album, galeri foto, banner
public function UploadFoto($fupload_name, $folder, $ukuran){
  // File gambar yang di upload
  $imageType = $_FILES["fupload"]["type"];
  $file_upload = $folder . $fupload_name;

  // Simpan gambar dalam ukuran aslinya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $file_upload);

 //identitas file asli
  switch($imageType) {
    case "image/gif":
      $gbr_asli=imagecreatefromgif($file_upload);
      break;
      case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
      $gbr_asli=imagecreatefromjpeg($file_upload);
      break;
      case "image/png":
    case "image/x-png":
      $gbr_asli=imagecreatefrompng($file_upload);
      break;
  } 

  // Identitas file asli
  //$gbr_asli = imagecreatefromjpeg($file_upload);
  $lebar    = imageSX($gbr_asli);
  $tinggi 	= imageSY($gbr_asli);

  // Simpan dalam versi thumbnail
  $thumb_lebar  = $ukuran;
  $thumb_tinggi = ($thumb_lebar/$lebar) * $tinggi;

  // Proses perubahan dimensi ukuran
  $gbr_thumb = imagecreatetruecolor($thumb_lebar,$thumb_tinggi);
  imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $thumb_lebar, $thumb_tinggi, $lebar, $tinggi);

  //png
    //$width = imagesx($im);
   // $height = imagesy($im);

    $newImg = imagecreatetruecolor($thumb_lebar, $thumb_tinggi);

    imagealphablending($newImg, false);
    imagesavealpha($newImg, true);
    $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
    imagefilledrectangle($newImg, 0, 0, $lebar, $tinggi, $transparent);
    imagecopyresampled($newImg, $gbr_asli, 0, 0, 0, 0, $thumb_lebar, $thumb_tinggi, $lebar, $tinggi);

   //Simpan gambar
  switch($imageType) {
    case "image/gif":
        imagegif($gbr_thumb,$folder . "small_" . $fupload_name);
      break;
      case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
        imagejpeg($gbr_thumb,$folder . "small_" . $fupload_name);
      break;
      case "image/png":
    case "image/x-png":
        imagepng($newImg,$folder . "small_" . $fupload_name);
      break;
  }  
  // Hapus gambar di memori komputer
  imagedestroy($gbr_asli);
  imagedestroy($gbr_thumb);
}
}
?>
