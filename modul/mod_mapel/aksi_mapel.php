<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['email']) and empty($_SESSION['password'])) {
    echo "<h2 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h2>
        <p class=\"fail\"><a href=\"index.php\">LOGIN</a></p></div>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else {
    include "../../config/class.admin.php";
    include_once '../../config/validation.php';
    include "../../config/library.php";
    include "../../config/fungsi_thumbnail.php";

    $user = new User();
    $validation = new Validation();

    $module = $_GET['module'];
    $act = $_GET['act'];

    // Hapus user
    if ($module == 'mapel' and $act == 'hapus') {
        $namafile = $user->detail_user($_GET['id']);
        // hapus file gambar yang berhubungan dengan berita tersebut
        @unlink("../../photo/$namafile");
        @unlink("../../photo/small_$namafile");
        // hapus data user di database

        $del = $user->delete_mapel($_GET['id']);

        header("location:../../index.php?module=" . $module);
    }

    // Input user
    elseif ($module == 'mapel' and $act == 'input') {
        $id_kelas = $user->escape_string($_POST['id_kelas']);
        $id_user = $user->escape_string($_POST['id_user']);
        $mapel = $user->escape_string($_POST['mapel']);
        $deskripsi = $user->escape_string($_POST['deskripsi']);

        $msg = $validation->check_empty($_POST, array('id_kelas', 'id_user', 'mapel', 'deskripsi'));

        // checking empty fields
        if ($msg != null) {
            echo "<h3 class=text-center>Ada Kesalahan</h3> <p  class=text-center>";
            echo $msg;

            //link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
            echo "</p>";
        } else {

            $simpan_mapel = $user->simpan_mapel($id_kelas, $id_user, $mapel, $deskripsi);

            header("location:../../index.php?module=" . $module);
        }
    }
    // Update user
    elseif ($module == 'mapel' and $act == 'update') {

        $id = $_POST['id'];
        $user = new User();
        $r = $user->detail_mapel($id);

        $id_kelas = $user->escape_string($_POST['id_kelas']);
        $id_user = $user->escape_string($_POST['id_user']);
        $mapel = $user->escape_string($_POST['mapel']);
        $deskripsi = $user->escape_string($_POST['deskripsi']);

        if (empty($lokasi_file)) {

            $update_mapel = $user->update_mapel($id_kelas, $id_user, $mapel, $deskripsi, $id);

            header("location:../../index.php?module=" . $module);
        }
    }
}
