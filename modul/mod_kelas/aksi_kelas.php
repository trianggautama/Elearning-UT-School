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
    if ($module == 'kelas' and $act == 'hapus') {
        $namafile = $user->detail_user($_GET['id']);
        // hapus file gambar yang berhubungan dengan berita tersebut
        @unlink("../../photo/$namafile");
        @unlink("../../photo/small_$namafile");
        // hapus data user di database

        $del = $user->delete_kelas($_GET['id']);

        header("location:../../index.php?module=" . $module);
    }

    // Input user
    elseif ($module == 'kelas' and $act == 'input') {
        $kelas = $user->escape_string($_POST['kelas']);

        $msg = $validation->check_empty($_POST, array('kelas'));

        // checking empty fields
        if ($msg != null) {
            echo "<h3 class=text-center>Ada Kesalahan</h3> <p  class=text-center>";
            echo $msg;

            //link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
            echo "</p>";
        } else {

            // // Apabila tidak ada foto yang di upload
            if (empty($lokasi_file)) {

                $simpan_kelas = $user->simpan_kelas($kelas);

                header("location:../../index.php?module=" . $module);
            }
        }
    }
    // Update user
    elseif ($module == 'kelas' and $act == 'update') {

        $id = $_POST['id'];
        $user = new User();
        $r = $user->detail_kelas($id);

        $kelas = $user->escape_string($_POST['kelas']);

        if (empty($lokasi_file)) {

            $update_kelas = $user->update_kelas($kelas, $id);

            header("location:../../index.php?module=" . $module);
        }
    }
}
