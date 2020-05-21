<?php
//error_reporting(0);
session_start();
include "config/class.admin.php";
//$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);
if (empty($_SESSION['email']) AND empty($_SESSION['password'])){
header("location:login.php?auth");
  exit;

}
  $user=new User();
  $peserta=$user->detail_peserta_test($_SESSION['email']);
  $id_user=$peserta['id_user'];
  // $p=$user->tampil_hasil_kelulusanid($id_user);
  $query =" SELECT * FROM test t, user u, event_test e WHERE t.id_user=u.id_user and t.id_event=e.id_event and status_teori='l' and status_praktek='l' and t.id_user='$id_user'";
        $result =$mysqli->query($query);
        $ada=$result->num_rows;  
?>
<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Seleksi Operator & Mekanik</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="vendor/animate/animate.css">

		<link rel="stylesheet" href="vendor/font-awesome/css/all.min.css" />
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.theme.css" />
		<link rel="stylesheet" href="vendor/bootstrap-multiselect/css/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="vendor/morris/morris.css" />
    <link rel="stylesheet" href="vendor/select2/css/select2.css" />
		<link rel="stylesheet" href="vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
		<link rel="stylesheet" href="vendor/datatables/media/css/dataTables.bootstrap4.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<section class="body">

					<!-- start: header -->
					<header class="header mt-0 pt-0 bg-light">
						<div class="logo-container">
							<a href="../2.2.0" class="logo">
								<img src="img/logo_ut.png" width="35" height="35" alt="Porto Admin" />
							</a>
							<p class="logo pt-1	">
								<b>E-Learning UT School</b> 
							</p>
							<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
								<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
							</div>
						</div>
					
						<!-- start: search & user box -->
						<div class="header-right pt-1">					
            <div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
                <?php 
                  if ($peserta['foto']!=""){
                    echo "<div> <img class=\"rounded-circle\" src='photo_user/small_$peserta[foto]'/> </div>";
                  }else{
                    echo "<td> <img  class=\"rounded-circle\" src=\"photo_user/user.png\" width=\"40px\" hight=\"40px\"> </td>";
                  }  
                ?>        
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name"><?= strtoupper($peserta['nama']) ?></span>
								<span class="role">administrator</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled mb-2">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="index.php?module=profile&id=<?= $id_user?>" ><i class="fas fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fas fa-lock"></i> Lock Screen</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1"  href="logout.php"><i class="fas fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
						</div>
						<!-- end: search & user box -->
					</header>der -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
				    <div class="sidebar-header">
				        <div class="sidebar-title">
				            Navigation
				        </div>
				        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
				            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
				        </div>
				    </div>
				
				    <div class="nano">
				        <div class="nano-content">
                <?php 
                  if ($_SESSION['level']=="Admin") { 
                ?>
				    <nav id="menu" class="nav-main" role="navigation">
				                <ul class="nav nav-main">
                        <li class="nav-item active">
                          <a class="nav-link" href="index.php?module=home">
                            <i class="fas fa-home"></i>
                            <span>Home</span></a>
                        </li>
						<li class="nav-parent">
				            <a class="nav-link" href="#">
							<i class="fas fa-fw fa-users"></i>
				                 <span>Data Siswa</span>
				            </a>
				        <ul class="nav nav-children">
							<li>
                                <a class="nav-link" href="index.php?module=kelas">Data Kelas</a>
							</li>
							<li>
                              <a class="nav-link" href="index.php?module=peserta">
                                <span>Data Peserta</span>
                              </a>
                              </li>
				        </ul>
						</li> 
						<li class="nav-parent">
				            <a class="nav-link" href="#">
							<i class="fas fa-fw fa-book"></i>
				                 <span>Data Mata Pelajaran</span>
				            </a>
				        <ul class="nav nav-children">
							<li>
                                <a class="nav-link" href="index.php?module=mapel">Data Mata Pelajaran</a>
				            </li>
							<li class="nav-item active">
                          		<a class="nav-link" href="index.php?module=penjadwalan">
                            	<span>Penjadwalan</span></a>
							</li>
							<li class="nav-item active">
                          		<a class="nav-link" href="index.php?module=materi">
                            	<span>Materi</span></a>
                        	</li>
				        </ul>
						</li> 
						<li class="nav-parent">
				            <a class="nav-link" href="#">
							<i class="fas fa-fw fa-question-circle"></i>
				                 <span>Data Kuis</span>
				            </a>
				        <ul class="nav nav-children">
							<li class="nav-item active">
							<a class="nav-link" href="index.php?module=soal">
								<span>Input Soal Teori</span></a>
							</li>
							<li class="nav-item active">
								<a class="nav-link" href="index.php?module=hteori">
								<span>Nilai Tes Teori</span></a>
							</li>
							<li class="nav-item active">
                          		<a class="nav-link" href="index.php?module=praktek">
                            	<span>Nilai Tes Praktek</span></a>
                        	</li>
				        </ul>
						</li> 
                        <li class="nav-parent">
				            <a class="nav-link" href="#">
				                <i class="fas fa-asterisk" aria-hidden="true"></i>
				                 <span>Data Kelulusan</span>
				            </a>
				        <ul class="nav nav-children">
				            <li>
                                <a class="nav-link" href="index.php?module=laporan">Data Kelulusan</a>
				            </li>
				             <li>
                                <a class="nav-link" href="index.php?module=tlaporan">Data Tidak Lulus</a>
				            </li>
				        </ul>
				    </li> 
                      </ul>
                  </nav>
                  <hr class="separator" />
                  <div class="sidebar-widget widget-tasks">
                      <div class="widget-header">
                          <h6>Data</h6>
                          <div class="widget-toggle">+</div>
                      </div>
                      <div class="widget-content">
                          <ul class="list-unstyled m-0">
                              <li>
                              <a class="nav-link" href="index.php?module=user">
                                <i class="fas fa-fw fa-users"></i>
                                <span>Data User</span>
                              </a>
                              </li>
                              <li>
                              <a class="nav-link" href="index.php?module=event_test">
                                <i class="fas fa-fw fa-users"></i>
                                <span>Data Instruktur</span>
                              </a>
                              </li>
                          </ul>
                      </div>
                  </div>
				  <?php }else { ?>
					<nav id="menu" class="nav-main" role="navigation">
				                <ul class="nav nav-main">
                        <li class="nav-item active">
                          <a class="nav-link" href="index.php?module=home">
                            <i class="fas fa-home"></i>
                            <span>Home</span></a>
						</li>
						<li class="nav-item active">
                          <a class="nav-link" href="index.php?module=nilai_kelulusan">
                            <i class="fas fa-file"></i>
                            <span>Nilai Kelulusan</span></a>
						</li>
						<li class="nav-item active">
                          <a class="nav-link" href="index.php?module=test">
                            <i class="fas fa-file"></i>
                            <span>Tes Teori</span></a>
                        </li>
                      </ul>
                  </nav>
					<!-- <li class="nav-item active">
						<a class="nav-link" href="index.php?module=hteori">
						<i class="fas fa-fw fa-tachometer-alt"></i>
						<span>Hasil Tes Teori</span></a>
					</li> -->
				<?php 
				if ($ada>0) {
				
				?>
      <li class="nav-item active">
        <a class="nav-link" href="modul/mod_laporan/sertifikat.php?id=<?= $id_user ?>" target="_blank">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Cetak Sertifikat</span></a>
      </li>

<?php   
  } else {

  }
  ?>

     <!--  <div class="sidebar-heading">
        Sharing Product Knowledge
      </div>
      <li class="nav-item active">
        <a class="nav-link" href="index.php?module=soal">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Materi Modul</span></a>
      </li> -->
<?php 
}
 ?>
                </div>
             </div>
        </aside>
     <!-- end: sidebar -->
     <section role="main" class="content-body">
        <?php include'content.php';?>

		</section>

		<!-- Vendor -->
		<script src="vendor/jquery/jquery.js"></script>
		<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="vendor/popper/umd/popper.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.js"></script>
		<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="vendor/common/common.js"></script>
		<script src="vendor/nanoscroller/nanoscroller.js"></script>
		<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="vendor/jquery-ui/jquery-ui.js"></script>
		<script src="vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="vendor/jquery-appear/jquery.appear.js"></script>
		<script src="vendor/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
		<script src="vendor/jquery.easy-pie-chart/jquery.easypiechart.js"></script>
		<script src="vendor/flot/jquery.flot.js"></script>
		<script src="vendor/flot.tooltip/jquery.flot.tooltip.js"></script>
		<script src="vendor/flot/jquery.flot.pie.js"></script>
		<script src="vendor/flot/jquery.flot.categories.js"></script>
		<script src="vendor/flot/jquery.flot.resize.js"></script>
		<script src="vendor/morris/morris.js"></script>
		<script src="vendor/gauge/gauge.js"></script>
		<script src="vendor/snap.svg/snap.svg.js"></script>
    <script src="vendor/select2/js/select2.js"></script>
		<script src="vendor/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>
		<!-- Examples -->
		<script src="js/examples/examples.datatables.default.js"></script>
		<script src="js/examples/examples.datatables.row.with.details.js"></script>
		<script src="js/examples/examples.datatables.tabletools.js"></script>
		<!-- Theme Custom -->
		<script src="js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

		<!-- Examples -->
		<script src="js/examples/examples.dashboard.js"></script>

	</body>
</html>