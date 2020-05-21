<?php 
$user=new User();
  $peserta=$user->detail_peserta_test($_SESSION['email']);
  $id_user=$peserta['id_user'];
 ?>
         <header class='page-header'>
        <h2>Beranda User</h2>
            <div class='right-wrapper text-right'>
            <ol class='breadcrumbs'>
              <li>
                <a href='#'>
                  <i class='fas fa-file'></i>
                </a>
              </li>
              <li><span>Beranda</span></li>
            </ol> 
              <a class='sidebar-right-toggle'><i class='fas fa-chevron-left'></i></a>
            </div>
          </header>
      <div class="row">
        <div class="col-md-3">
          <div class="card mb-1">
            <div class="card-header">
              Informasi Sekolah 
            </div>
            <div class="card-body">
              <p class="text-justify"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptatem quis impedit nesciunt sint magni, sunt aspernatur ea iure labore minus dolores, hic eligendi nobis sapiente molestias vitae consectetur velit.</p>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
                Mata Pelajaran
            </div>
            <div class="card-body">
									<a href="" class="btn btn-block btn-warning text-left"> <i class="fas fa-book"></i> Mata Pelajaran 1</a>
                  <a href="" class="btn btn-block btn-warning text-left"> <i class="fas fa-book"></i> Mata Pelajaran 2</a>
                  <a href="" class="btn btn-block btn-warning text-left"> <i class="fas fa-book"></i> Mata Pelajaran 3</a>
                  <a href="" class="btn btn-block btn-warning text-left"> <i class="fas fa-book"></i> Mata Pelajaran 4</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">WELCOME <b><i> <?= strtoupper($peserta['nama']) ?> </i></b></h4>
          <p>Selamat datang di halaman Tes Seleksi Operator dan Mekanik..</p>
          <hr>
          <p class="mb-0">Sebelum mengikuti tes diwajibkan untuk melengkapi  <b>Biodata Diri</b> Anda dengan mengklik <a href="index.php?module=user&act=edituser&id=<?= $id_user?>"><i><b>Profile</b></i></a> atau dengan mengklik photo di pojok kanan atas  .</p>
          <p class="mb-0">Pastikan Anda sudah melakukan <b>Registrasi Pembayaran</b>, jika <i>belum</i> silahkan hubungi ADMIN.</p>
          <p class="mb-0">Jika sudah melengkapi <b>Biodata Diri</b> dan melakukan <b>Registrasi Pembayaran</b>, silahkan mengikuti <a href="index.php?module=test">tes seleksi</a>.</p>
          <p class="mb-0">Jangan lupa untuk selalu <b>Logout</b> setelah Anda selesai melakukan tes seleksi ini.</p>
        </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header">
              Profil Siswa 
            </div>
            <div class="card-body">
              <div class="thumb-info mb-3">
										<img src="img/!logged-user.jpg" class="rounded img-fluid" alt="John Doe">
										<div class="thumb-info-title">
											<span class="thumb-info-inner">Nama Peserta</span>
										</div>
                </div>
                <div class="content">
										<ul class="simple-user-list">
											<li>
												<span class="title">NRP</span>
												<span class="message truncate">123456789</span>
											</li>
											<li>
												<span class="title">Tempat Tanggal Lahir</span>
												<span class="message truncate">Lorem ipsum dolor sit.</span>
											</li>
											<li>
												<span class="title">Jenis kelamin</span>
												<span class="message truncate">Laki- laki</span>
											</li>
											<li>
												<span class="title">Email</span>
												<span class="message truncate">trianggautama@gmail.com</span>
                      </li>
                      <li>
												<span class="title">Asal Perusahaan</span>
												<span class="message truncate">PT.aaaa</span>
                      </li>
                      <li>
												<span class="title">Jabatan</span>
												<span class="message truncate">CEO</span>
											</li>
										</ul>
										<hr class="dotted short">
										<div class="text-right">
											<a class="text-uppercase text-muted" href="#">(Edit Profil)</a>
										</div> </div>
          </div>
        </div>
      </div>
