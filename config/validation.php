<?php
class Validation 
{
	public function check_empty($data, $fields)
	{
		$msg = null;
		foreach ($fields as $value) {
			if (empty($data[$value])) {
				$msg .= "<font color=red><b>$value</b> Empty </font> <br />";
			}
		} 
		return $msg;
	}
	
	public function hp_valid($telpon)
	{
		//if (is_numeric($age)) {
		if (preg_match("/^[0-9]+$/", $telpon)) {	
			return true;
		} 
		return false;
	}

	public function check_keamanan($keamanan,$keamanan2)
	{
		//if (is_numeric($age)) {
		if ($keamanan==$keamanan2) {	
			return true;
		}  
	}
	
	public function email_valid($email)
	{
		//if (preg_match("/^[_a-z0-9-+]+(\.[_a-z0-9-+]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email)) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {	
			return true;  
		}
		return false;
	}
}
?>
