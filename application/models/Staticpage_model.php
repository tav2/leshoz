<?php
//модель для обработки даннных для подвала сайта
class Staticpage_model extends CI_Model 
{
	function get_zapis($staticpage_id, $smeshenie='')
	{
		if ($staticpage_id=='6' and $smeshenie=='')//выводит направления работы
		{
			$kolichestvo=50;
			$smeshenie = 6;
		}
		elseif ($smeshenie=='') 
		{
			$kolichestvo=50;
			$smeshenie = 1;
		}
		else
		{
			$kolichestvo=1;
		}
		$this->db->where('staticpage_id', $staticpage_id);
		$rez = $this->db->get('staticpage_content', $kolichestvo, $smeshenie);
		return $rez->result_array();
	}

	function get_file($staticpage_id, $smeshenie)
	{
		$this->db->where('staticpage_id', $staticpage_id);
		$rez = $this->db->get('staticpage_file', 1 , $smeshenie);
		foreach ($rez->result_array() as $item) {$put = $item['staticpage_file_adres'] ;}
		if (isset($put)) {
			return $put;
		}
		
	}

	// function get_kontakt($staticpage_id)
	// {
	// 	$this->db->where('staticpage_id', $staticpage_id);
	// 	$rez = $this->db->get('staticpage_file');
	// 	foreach ($rez->result_array() as $item) {$put = $item['staticpage_file_adres'] ;}
	// 	return $put;

	// 	return $this->load->view('component/staticpage/api/kontakt_ip', array(
	// 		// 'galereya_menu' => $this->get_galereya_menu(),
	// 	), true);

	// }
}