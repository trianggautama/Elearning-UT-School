<?php 
	if(isset($_GET['module'])){
		if($_GET['module']=="home"){
			if ($_SESSION['level']=="Admin") {
				include 'home_admin.php';
			} else {
			include 'home.php';
			}
		}
		elseif ($_GET['module']=="soal") {
			include 'modul/mod_soal/soal.php';
		}
		elseif ($_GET['module']=="user") {
			include 'modul/mod_user/user.php';
		}
		elseif ($_GET['module']=="test") {
			include 'modul/mod_test/test.php';
		}
		elseif ($_GET['module']=="event_test") {
			include 'modul/mod_event_test/event_test.php';
		}
		elseif ($_GET['module']=="instruktur") {
			include 'modul/mod_event_test/instruktur.php';
		}
		elseif ($_GET['module']=="peserta") {
			include 'modul/mod_peserta/peserta.php';
		}
		elseif ($_GET['module']=="profile") {
			include 'modul/mod_profil/profil.php';
		}
		elseif ($_GET['module']=="praktek") {
			include 'modul/mod_praktek/praktek.php';
		}
		elseif ($_GET['module']=="hasil_test") {
			include 'modul/mod_hasil_test/hasil_test.php';
		}
		elseif ($_GET['module']=="laporan") {
			include 'modul/mod_laporan/data_kelulusan.php';
		}
		elseif ($_GET['module']=="hteori") {
			include 'modul/mod_hteori/hteori.php';
		}
		elseif ($_GET['module']=="nilai_kelulusan") {
			include 'modul/mod_nilai_kelulusan/nilai_kelulusan.php';
		}
		elseif ($_GET['module']=="tlaporan") {
			include 'modul/mod_laporan/data_tkelulusan.php';
		}
	}
	else  {
		if ($_SESSION['level']=="Admin") {
				include 'home_admin.php';
			} else {
			include 'home.php';
			}
	}
 ?>