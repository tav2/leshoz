<?php
class news_model extends CI_Model 
{
	function get_all_news()
	{
		$this->db->order_by('news_id DESC');
		$rez = $this->db->get('news');
		return $rez->result_array();
	}

	function get_all_comments($news_id)
	{
		// $this->db->order_by('news_id DESC');
		$this->db->where('news_id', $news_id);
		$rez = $this->db->get('news_comments');
		return $rez->result_array();
	}

	function get_news($news_id)
	{
		$this->db->where('news_id', $news_id);
		$rez = $this->db->get('news');
		return $rez->result_array();
	}

	function get_user()
	{
		// $this->db->where('user_id', $user_id);
		// $rez = $this->db->get('users');
		// foreach ($rez->result() as $row)
		// {
		//     return $row->user_name;
		// }
		return 'admin';
	}

		function add_data_comment($data)
	{
		$this->db->insert('news_comments', $data);
	}


	function get_num_comment($news_id)
	{
		$rez = $this->db->query("SELECT count(*) AS num FROM news_comments WHERE news_id='{$news_id}'");
		foreach ($rez->result() as $row)
		{
			return $row->num;
		}
	}

	function get_img_put($news_id)
	{
		$this->db->where('news_id', $news_id);
		$this->db->select('img_adres');
		$rez = $this->db->get('img');
		foreach ($rez->result() as $row)
		{
			return $row->img_adres;
		}
	}
}