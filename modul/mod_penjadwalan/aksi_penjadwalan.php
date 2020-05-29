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
    $gambar = new Gambar();

    $module = $_GET['module'];
    $act = $_GET['act'];

    // Hapus user
    if ($module == 'penjadwalan' and $act == 'hapus') {
        $namafile = $user->detail_penjadwalan($_GET['id']);
        // hapus file gambar yang berhubungan dengan berita tersebut
        @unlink("../../file_penjadwalan/$namafile[file]");

        // hapus data user di database

        $del = $user->delete_penjadwalan($_GET['id']);

        header("location:../../index.php?module=" . $module);
    }

    // Input user
    elseif ($module == 'penjadwalan' and $act == 'input') {

        $id_kelas = $user->escape_string($_POST['id_kelas']);
        $id_mapel = $user->escape_string($_POST['id_mapel']);
        $tanggal_upload = $user->escape_string($_POST['jadwal']);

        $msg = $validation->check_empty($_POST, array('id_kelas', 'id_mapel'));

        // checking empty fields
        if ($msg != null) {
            echo "<h3 class=text-center>Ada Kesalahan</h3> <p  class=text-center>";
            echo $msg;

            //link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
            echo "</p>";
        } else //
        // Apabila tidak ada file yang di upload
        $simpan_penjadwalan = $user->simpan_penjadwalan($id_kelas, $id_mapel, $tanggal_upload);
        header("location:../../index.php?module=" . $module);

    }
    // Update penjadwalan
    elseif ($module == 'penjadwalan' and $act == 'update') {

        $id = $_POST['id'];
        $user = new User();
        $r = $user->detail_penjadwalan($id);

        $id_kelas = $user->escape_string($_POST['id_kelas']);
        $id_mapel = $user->escape_string($_POST['id_mapel']);
        $tanggal_upload = $user->escape_string($_POST['jadwal']);

        $update_mapel = $user->update_penjadwalan($id_kelas, $id_mapel,$tanggal_upload, $id);
        header("location:../../index.php?module=" . $module);


    } elseif ($module == 'penjadwalan' and $act == 'download') {
        if (isset($_GET['filename'])) {
            $filename = $_GET['filename'];

            $back_dir = "../../file_penjadwalan/";
            $file = $back_dir . $filename;

            if (file_exists($file)) {

                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename=' . $file);
                header('Content-Transfer-Encoding: binary');
                header('Accept-Ranges: bytes');

                readfile($file);

            } else {
                $_SESSION['pesan'] = "Oops! File - $filename - not found ...";
                // header("Location: ../../index.php?module=penjadwalan");

            }
        }
    }
}
