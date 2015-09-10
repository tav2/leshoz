<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reg_model extends CI_Model {

	//проверяем ессть ли в базе такие емайл или имя, если нет то возвращаем лож
	function reg_proverka($str)
	{

		// $query = $this->db->query("SELECT email, username FROM users");
		$query = $this->db->get('customer');
		$rez=FALSE;

		foreach ($query->result_array() as $row)
		{
			if(($row['customer_name']==$str) or ($row['customer_email']==$str)) // or ($row['email']==$str)
			{
				$rez = TRUE;
			}
		}
		return $rez;
	}

	function reg_create($customer_email, $customer_name, $customer_password)
	{
		$data['customer_email'] = $customer_email;
		$data['customer_name'] = $customer_name;
		$data['customer_password'] = $customer_password;
		$data['customer_email_check'] = FALSE;

		$this->load->helper('date');
		date_default_timezone_set('Asia/Almaty');
		$datestring = '%Y:%m:%d';
		$data['customer_date'] = mdate($datestring);

		$this->db->insert('customer', $data);
	}

}