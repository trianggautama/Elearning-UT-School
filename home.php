<?php 
$user=new User();
  $peserta=$user->detail_peserta_test($_SESSION['email']);
  $id_user=$peserta['id_user'];
 ?>
<p>Halaman Peserta</p>

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">WELCOME <b><i> <?= strtoupper($peserta['nama']) ?> </i></b></h4>
  <p>Selamat datang di halaman Tes Seleksi Operator dan Mekanik..</p>
  <hr>
  <p class="mb-0">Sebelum mengikuti tes diwajibkan untuk melengkapi  <b>Biodata Diri</b> Anda dengan mengklik <a href="index.php?module=user&act=edituser&id=<?= $id_user?>"><i><b>Profile</b></i></a> atau dengan mengklik photo di pojok kanan atas  .</p>
  <p class="mb-0">Pastikan Anda sudah melakukan <b>Registrasi Pembayaran</b>, jika <i>belum</i> silahkan hubungi ADMIN.</p>
  <p class="mb-0">Jika sudah melengkapi <b>Biodata Diri</b> dan melakukan <b>Registrasi Pembayaran</b>, silahkan mengikuti <a href="index.php?module=test">tes seleksi</a>.</p>
  <p class="mb-0">Jangan lupa untuk selalu <b>Logout</b> setelah Anda selesai melakukan tes seleksi ini.</p>
</div>
