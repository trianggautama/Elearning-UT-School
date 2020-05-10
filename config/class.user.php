<?php 
    date_default_timezone_set('Asia/Makassar');//tentukan waktu
 //koneksi   
	include "db_config.php";   
	class User{
		protected $db;
		public function __construct(){
			$this->db = new DB_con();
			$this->db = $this->db->ret_obj();
		}
				
	   /*** for login process ***/
		
	public function random($panjang_karakter)   
    {   
       $karakter = '1234567890abcdefghijkmnopqrstuvwxyz';   
       $string = '';   
       for($i = 0; $i < $panjang_karakter; $i++) {   
       $pos = rand(0, strlen($karakter)-1);   
        $string .= $karakter{$pos};   
       }   
       return $string;   
       }  

    public function hitung_umur($tanggal_lahir) {
    list($year,$month,$day) = explode("-",$tanggal_lahir);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($month_diff < 0) $year_diff--;
        elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
    return $year_diff;
}   


    public function tampil_user(){
		$query = "SELECT * FROM data_user order by id_user asc";
	 $result= $this->db->query($query);
			 $num_result=$result->num_rows;
			 if($num_result>0){
			 while($rows=$result->fetch_assoc()){
			 $this->dataus[]=$rows;
			}
	return $this->dataus;
	 }
 } 

  public function simpan_user($nama, $password, $email){
			$query = "INSERT INTO user SET nama='$nama', pass='$password', email='$email'";		
			$result = $this->db->query($query) or die($this->db->error);	
		}

 public function update_user($username, $password, $nama_user, $posisi, $status, $id){
			$query = "UPDATE data_user SET username='$username', password='$password', nama_user='$nama_user', posisi='$posisi', status='$status' WHERE id_user='$id'";		
			$result = $this->db->query($query) or die($this->db->error);	
		}		

public function simpan_user_gb($username, $password, $nama_user, $posisi, $gambar, $status){
			$query = "INSERT INTO data_user SET username='$username', password='$password', nama_user='$nama_user', posisi='$posisi', photo='$gambar', status='$status'";		
			$result = $this->db->query($query) or die($this->db->error);	
		}

public function update_user_gb($username, $password, $nama_user, $posisi, $gambar, $status, $id){
			$query = "UPDATE data_user SET username='$username', password='$password', nama_user='$nama_user', posisi='$posisi', photo='$gambar', status='$status' WHERE id_user='$id'";		
			$result = $this->db->query($query) or die($this->db->error);	
		}				

public function detail_user($id){
			$query = "SELECT * FROM data_user WHERE id_user = '$id'";
			$result = $this->db->query($query) or die($this->db->error);
			$user_data = $result->fetch_array(MYSQLI_ASSOC);
			return $user_data;
		}	

	public function delete_users($id){
		$query = "DELETE FROM data_user WHERE id_user='$id'";		
		$result = $this->db->query($query) or die($this->db->error);	
	} 	

		
	public function rupiah($nilai) {
         $nilai1=number_format($nilai,0,",",".");
         $nilai2=" ".$nilai1." ";
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
    public function kode_otomatis(){
			$query = "SELECT MAX(nik) AS kode FROM pegawai";
			$result = $this->db->query($query) or die($this->db->error);
		    $pecah = $result->fetch_array(MYSQLI_ASSOC);
			
			$kode = substr($pecah['kode'], 3,5);
			$jum = $kode + 1;
			if ($jum < 10) {
				$id = "LM70000".$jum;
			}
			else if($jum >= 10 && $jum < 100){
				$id = "LM7000".$jum;
			}
			else if($jum >= 100 && $jum < 1000){
				$id = "LM700".$jum;
			}
			else{
				$id = "LM70".$jum;
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

	public function check_hp($id){	
		$query = "SELECT no_hp from pelanggan WHERE no_hp='$id'";		
		$result = $this->db->query($query) or die($this->db->error);
		$count_row = $result->num_rows;		
		if ($count_row == 0) {
	            return true;
	        }
	    }

	
   public function ubah_tgl($tanggal) { 
        $pisah   = explode('-',$tanggal);
        $larik   = array($pisah[2],$pisah[1],$pisah[0]);
        $satukan = implode('-',$larik);
        return $satukan;
    }

 
}
