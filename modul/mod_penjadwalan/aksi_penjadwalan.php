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
        //kelola file
        $lokasi_file = $_FILES['file']['tmp_name'];
        $tipe_file = $_FILES['file']['type'];
        $nama_file = $_FILES['file']['name'];
        $acak = rand(1, 99);
        $nama_gambar = $acak . $nama_file;

        $id_kelas = $user->escape_string($_POST['id_kelas']);
        $id_mapel = $user->escape_string($_POST['id_mapel']);
        $judul = $user->escape_string($_POST['judul']);
        $tanggal_upload = date("Y-m-d");

        $msg = $validation->check_empty($_POST, array('id_kelas', 'id_mapel', 'judul'));

        // checking empty fields
        if ($msg != null) {
            echo "<h3 class=text-center>Ada Kesalahan</h3> <p  class=text-center>";
            echo $msg;

            //link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
            echo "</p>";
        } else //
        // Apabila tidak ada file yang di upload
        if (empty($lokasi_file)) {

            $simpan_penjadwalan = $user->simpan_penjadwalan($id_kelas, $id_mapel, $judul, $tanggal_upload);
        } else {
            if ($tipe_file != "application/pdf") {
                echo "<script>window.alert('Upload Gagal! Pastikan file yang di upload bertipe PDF');
              window.location=('../../index.php?module=penjadwalan')</script>";
            } else {
                //simpan file baru
                $folder = "../../file_penjadwalan/"; // folder untuk file
                $gb = $gambar->UploadFile($nama_gambar, $folder);

                $simpan_penjadwalan = $user->simpan_penjadwalan_file($id_kelas, $id_mapel, $judul, $tanggal_upload, $nama_gambar);

            }

            header("location:../../index.php?module=" . $module);
        }
    }
    // Update penjadwalan
    elseif ($module == 'penjadwalan' and $act == 'update') {
        $lokasi_file = $_FILES['file']['tmp_name'];
        $tipe_file = $_FILES['file']['type'];
        $nama_file = $_FILES['file']['name'];
        $acak = rand(1, 99);
        $nama_gambar = $acak . $nama_file;

        $id = $_POST['id'];
        $user = new User();
        $r = $user->detail_penjadwalan($id);

        $id_kelas = $user->escape_string($_POST['id_kelas']);
        $id_mapel = $user->escape_string($_POST['id_mapel']);
        $judul = $user->escape_string($_POST['judul']);
        $tanggal_upload = date("Y-m-d");

        if (empty($lokasi_file)) {

            $update_mapel = $user->update_penjadwalan($id_kelas, $id_mapel, $judul, $id);

            header("location:../../index.php?module=" . $module);
        } else {
            if ($tipe_file != "application/pdf") {
                echo "<script>window.alert('Upload Gagal! Pastikan file yang di upload bertipe PDF');
              window.location=('../../index.php?module=penjadwalan')</script>";
            } else {

                //hapus photo lama
                $namafile = $user->detail_penjadwalan($id);
                // hapus file gambar yang berhubungan dengan berita tersebut
                @unlink("../../file_penjadwalan/$namafile[file]");
                //simpan photo baru
                $folder = "../../file_penjadwalan/"; // folder untuk photo
                $gb = $gambar->UploadFile($nama_gambar, $folder);

                $update_penjadwalan = $user->update_penjadwalan_file($id_kelas, $id_mapel, $judul, $tanggal_upload, $nama_gambar, $id);

                header("location:../../index.php?module=" . $module);
            }
        }
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
