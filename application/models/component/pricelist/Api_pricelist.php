<?php

class Api_pricelist extends MY_Model {

	public function get_prices()
	{
		$query = $this->db->get('pricelist');
		if ($query->num_rows() > 0) {
			$prices = $query->result_array();
		} else {
			$prices = false;
		}
		return $this->load->view('component/pricelist/api/api_get_prices', array(
            'result' => $prices
        ), true);
	}
}