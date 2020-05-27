<?php
date_default_timezone_set('Asia/Makassar'); //tentukan waktu
//koneksi
include "db_config.php";
class User
{
    protected $db;
    public function __construct()
    {
        $this->db = new DB_con();
        $this->db = $this->db->ret_obj();
    }

    /*** for login process ***/
    public function check_login($email, $pass)
    {
        $password = md5($pass);
        $query = "SELECT * from user WHERE email='$email' and pass='$password'";
        $result = $this->db->query($query) or die($this->db->error);
        $adm = $result->fetch_array(MYSQLI_ASSOC);
        $count_row = $result->num_rows;

        if ($count_row == 1) {
            session_start();

            $_SESSION['KCFINDER'] = array();
            $_SESSION['KCFINDER']['disabled'] = false;
            $_SESSION['KCFINDER']['uploadURL'] = "../tinymcpuk/gambar";
            $_SESSION['KCFINDER']['uploadDir'] = "";

            $_SESSION['login'] = true; // this login var will use for the session thing
            $_SESSION['email'] = $adm['email'];
            $_SESSION['password'] = $adm['pass'];
            $_SESSION['nama'] = $adm['nama'];
            $_SESSION['foto'] = $adm['foto'];
            $_SESSION['level'] = $adm['level'];
            return true;
        } else {return false;}
    }

    public function random($panjang_karakter)
    {
        $karakter = '1234567890abcdefghijkmnopqrstuvwxyz';
        $string = '';
        for ($i = 0; $i < $panjang_karakter; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{$pos};
        }
        return $string;
    }

    public function hitung_umur($tanggal_lahir)
    {
        list($year, $month, $day) = explode("-", $tanggal_lahir);
        $year_diff = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff = date("d") - $day;
        if ($month_diff < 0) {
            $year_diff--;
        } elseif (($month_diff == 0) && ($day_diff < 0)) {
            $year_diff--;
        }

        return $year_diff;
    }

    public function tampil_user()
    {
        $query = "SELECT * FROM user order by id_user asc";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }

    public function simpan_user($nrp, $pass, $nama, $tempat_lahir, $tanggal_lahir, $jk, $email, $asal, $jabatan, $level)
    {
        $query = "INSERT INTO user SET nrp='$nrp', pass='$pass', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jk='$jk', email='$email', asal='$asal', level='$level'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function update_user($nrp, $nama, $tempat_lahir, $tanggal_lahir, $jk, $email, $pass, $asal, $jabatan, $id)
    {
        $query = "UPDATE user SET nrp='$nrp', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jk='$jk', email='$email', pass='$pass', asal='$asal', jabatan='$jabatan' WHERE id_user='$id'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function simpan_user_gb($nrp, $pass, $nama, $tempat_lahir, $tanggal_lahir, $jk, $email, $asal, $jabatan, $level, $nama_gambar)
    {
        $query = "INSERT INTO user SET nrp='$nrp', pass='$pass', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jk='$jk', email='$email', asal='$asal', jabatan='$jabatan', level='$level', foto='$nama_gambar'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function update_user_gb($nrp, $nama, $tempat_lahir, $tanggal_lahir, $jk, $email, $pass, $asal, $jabatan, $nama_gambar, $id)
    {
        $query = "UPDATE user SET nrp='$nrp', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jk='$jk', email='$email', pass='$pass', asal='$asal', jabatan='$jabatan', foto='$nama_gambar' WHERE id_user='$id'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function check_email($id)
    {
        $query = "SELECT email from user WHERE email='$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $count_row = $result->num_rows;
        if ($count_row == 0) {
            return true;
        }
    }

    public function check_nrp($id)
    {
        $query = "SELECT nrp from user WHERE nrp='$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $count_row = $result->num_rows;
        if ($count_row == 0) {
            return true;
        }
    }

    public function simpan_soal_gb($kode_soal, $soal, $A, $B, $C, $D, $jawaban, $nama_gambar)
    {
        $query = "INSERT INTO soal SET kode_soal='$kode_soal', soal='$soal', A='$A', B='$B', C='$C', D='$D', jawaban='$jawaban',  gambar='$nama_gambar'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function simpan_soal($kode_soal, $soal, $A, $B, $C, $D, $jawaban)
    {
        $query = "INSERT INTO soal SET kode_soal='$kode_soal', soal='$soal', A='$A', B='$B', C='$C', D='$D', jawaban='$jawaban'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function update_soal($kode_soal, $soal, $A, $B, $C, $D, $jawaban, $id)
    {
        $query = "UPDATE soal SET kode_soal='$kode_soal', soal='$soal', A='$A', B='$B', C='$C', D='$D', jawaban='$jawaban' WHERE id_soal='$id'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function update_soal_gb($kode_soal, $soal, $A, $B, $C, $D, $jawaban, $nama_gambar, $id)
    {
        $query = "UPDATE soal SET kode_soal='$kode_soal', soal='$soal', A='$A', B='$B', C='$C', D='$D', jawaban='$jawaban', gambar='$nama_gambar' WHERE id_soal='$id'";
        $result = $this->db->query($query) or die($this->db->error);
    }
    public function delete_soal($id)
    {
        $query = "DELETE FROM soal WHERE id_soal='$id'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function detail_user($id)
    {
        $query = "SELECT * FROM user WHERE id_user = '$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        return $user_data;
    }

    public function detail_soal($id)
    {
        $query = "SELECT * FROM soal WHERE id_soal = '$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        return $user_data;
    }
    public function detail_nilai($id)
    {
        $query = "SELECT * FROM user WHERE id_user = '$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        return $user_data;
    }

    public function delete_users($id)
    {
        $query = "DELETE FROM user WHERE id_user='$id'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    //soal
    public function tampil_soal()
    {
        $query = "SELECT * FROM soal order by id_soal asc";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }

    public function tampil_test()
    {
        $query = "SELECT * FROM soal order by id_soal asc";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->datausx[] = $rows;
            }
            return $this->datausx;
        }
    }

    public function tampil_soal_aktif()
    {
        $query = "SELECT * FROM soal WHERE aktif = 'Y'";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }

    public function tampil_event_test()
    {
        $query = "SELECT * FROM event_test order by id_event asc";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }

    public function tampil_instruktur()
    {
        $query = "SELECT * FROM event_test WHERE aktif = 'y'";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }

    public function simpan_event($periode, $tanggal, $tempat, $instruktur)
    {
        $query = "INSERT INTO event_test SET periode='$periode', tanggal='$tanggal', tempat='$tempat', instruktur='$instruktur'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function update_event($periode, $tanggal, $tempat, $instruktur)
    {
        $query = "UPDATE event_test SET periode='$periode', tanggal='$tanggal', tempat='$tempat', instruktur='$instruktur' WHERE id_event='$id'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function update_status($aktif)
    {
        $query = "UPDATE event_test SET aktif='$aktif'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function detail_event($id)
    {
        $query = "SELECT * FROM event_test WHERE id_event = '$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        return $user_data;
    }

    public function detail_event_aktif()
    {
        $query = "SELECT * FROM event_test WHERE aktif = 'y'";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        return $user_data;
    }

    public function simpan_hasil_test($id_test, $id_event, $id_user, $id_soal, $nomor_soal, $pilihan)
    {
        $query = "INSERT INTO hasil_test SET id_test='$id_test', id_event='$id_event', id_user='$id_user', id_soal='$id_soal', nomor_soal='$nomor_soal', jawaban='$pilihan'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function tampil_hasil_test($id_test, $id_user)
    {
        $query = "SELECT * FROM hasil_test WHERE id_test='$id_test' and id_user='$id_user'";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }

    public function tampil_peserta()
    {
        $query = "SELECT * FROM peserta_event p,user u, event_test e WHERE p.id_user=u.id_user and p.id_event=e.id_event order by id_peserta asc";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }
    public function tampil_kelas()
    {
        $query = "SELECT * FROM kelas order by id_kelas asc";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }

    public function detail_kelas($id)
    {
        $query = "SELECT * FROM kelas WHERE id_kelas = '$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $kelas_data = $result->fetch_array(MYSQLI_ASSOC);
        return $kelas_data;
    }

    public function detail_kelas_edit($id)
    {
        $query = "SELECT * FROM kelas WHERE id_kelas = '$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $kelas_data = $result->fetch_array(MYSQLI_ASSOC);
        return $kelas_data;
    }

    public function simpan_kelas($kelas)
    {
        $query = "INSERT INTO kelas SET kelas='$kelas'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function update_kelas($kelas, $id)
    {
        $query = "UPDATE kelas SET kelas='$kelas' WHERE id_kelas='$id'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function delete_kelas($id)
    {
        $query = "DELETE FROM kelas WHERE id_kelas='$id'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function tampil_peserta_nilai()
    {
        $query = "SELECT * FROM test n,user u, event_test e WHERE n.id_user=u.id_user and n.id_event=e.id_event and status_teori='l' order by id_test asc";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }

    public function detail_peserta($id)
    {
        $query = "SELECT * FROM peserta_event WHERE id_peserta = '$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        return $user_data;
    }

    public function detail_peserta_test($id)
    {
        $query = "SELECT * FROM user WHERE email = '$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        return $user_data;
    }

    public function simpan_peserta($id_event, $id_user, $pembayaran)
    {
        $query = "INSERT INTO peserta_event SET id_event='$id_event', id_user='$id_user', pembayaran='$pembayaran'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function update_peserta($id_user, $pembayaran, $id)
    {
        $query = "UPDATE peserta_event SET id_user='$id_user', pembayaran='$pembayaran' WHERE id_peserta='$id'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function delete_peserta($id)
    {
        $query = "DELETE FROM peserta_event WHERE id_peserta='$id'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function detail_pembayaran($id, $id_event)
    {
        $query = "SELECT * FROM peserta_event WHERE id_user = '$id' and id_event='$id_event'";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        return $user_data;
    }

    public function detail_peserta_edit($id)
    {
        $query = "SELECT * FROM peserta_event p, user u WHERE p.id_user=u.id_user and p.id_peserta = '$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        return $user_data;
    }

    public function tampil_nilai()
    {
        $query = "SELECT * FROM nilai_praktek order by id_nilai asc";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }

    public function simpan_nilai($id_event, $id_user, $kategori, $nilai)
    {
        $query = "INSERT INTO nilai_praktek SET id_event='$id_event', id_user='$id_user', kategori='$kategori', nilai='$nilai'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function tampil_test_nilai($id_user)
    {
        $query = "SELECT * FROM test WHERE id_user='$id_user'";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }

    public function tampil_hasil_teori($id)
    {
        $query = "SELECT * FROM test t, user u, event_test e WHERE t.id_user=u.id_user and t.id_event=e.id_event WHERE t.id_event='$id' order by id_test asc";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }

    public function detail_peserta_nilai($id)
    {
        $query = "SELECT * FROM test WHERE id_test = '$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        return $user_data;
    }

    public function detail_tes($id)
    {
        $query = "SELECT * FROM test WHERE id_user = '$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        return $user_data;
    }

    public function update_test($kategori, $nilai, $status, $id)
    {
        $query = "UPDATE test SET nilai_praktek='$nilai', kategori='$kategori', status_praktek='$status' WHERE id_test='$id'";
        $result = $this->db->query($query) or die($this->db->error);
    }

    public function tampil_nilai_hteori($periode)
    {
        $query = "SELECT * FROM peserta_event
		LEFT JOIN user ON peserta_event.id_user=user.id_user
		LEFT JOIN event_test ON peserta_event.id_event=event_test.id_event
		WHERE  periode='$periode' and user.level='user' order by id_peserta asc";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->datauszzz[] = $rows;
            }
            return $this->datauszzz;
        }
    }

    public function tampil_hasil_kelulusan()
    {
        $query = "SELECT * FROM test t, user u, event_test e WHERE t.id_user=u.id_user and t.id_event=e.id_event and status_teori='l' and status_praktek='l'";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }

    public function tampil_hasil_kelulusanid($id)
    {
        $query = "SELECT * FROM test t, user u, event_test e WHERE t.id_user=u.id_user and t.id_event=e.id_event and status_teori='l' and status_praktek='l' and t.id_user='$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        return $user_data;
    }

    public function tampil_hasil_tkelulusan()
    {
        $query = "SELECT * FROM test t, user u, event_test e WHERE t.id_user=u.id_user and t.id_event=e.id_event and status_teori='l' and status_praktek='tl'";
        $result = $this->db->query($query);
        $num_result = $result->num_rows;
        if ($num_result > 0) {
            while ($rows = $result->fetch_assoc()) {
                $this->dataus[] = $rows;
            }
            return $this->dataus;
        }
    }

    public function rupiah($nilai)
    {
        $nilai1 = number_format($nilai, 0, ",", ".");
        $nilai2 = " " . $nilai1 . " ";
        return $nilai2;
    }

    public function getData($query)
    {
        $result = $this->db->query($query);
        if ($result == false) {
            return false;
        }
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }
    public function kode_otomatis()
    {
        $query = "SELECT MAX(kode_soal) AS kode FROM soal";
        $result = $this->db->query($query) or die($this->db->error);
        $pecah = $result->fetch_array(MYSQLI_ASSOC);

        $kode = substr($pecah['kode'], 1, 5);
        $jum = $kode + 1;
        if ($jum < 10) {
            $id = "A0000" . $jum;
        } else if ($jum >= 10 && $jum < 100) {
            $id = "A000" . $jum;
        } else if ($jum >= 100 && $jum < 1000) {
            $id = "A00" . $jum;
        } else {
            $id = "A0" . $jum;
        }
        return $id;
    }

    public function escape_string($value)
    {
        return $this->db->real_escape_string($value);
    }

    public function stripslashes($value)
    {
        return $this->db->stripslashes($value);
    }

    public function check_hp($id)
    {
        $query = "SELECT no_hp from pelanggan WHERE no_hp='$id'";
        $result = $this->db->query($query) or die($this->db->error);
        $count_row = $result->num_rows;
        if ($count_row == 0) {
            return true;
        }
    }

    public function ubah_tgl($tanggal)
    {
        $pisah = explode('-', $tanggal);
        $larik = array($pisah[2], $pisah[1], $pisah[0]);
        $satukan = implode('-', $larik);
        return $satukan;
    }

}
