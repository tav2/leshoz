<?php

class Database extends CI_Model {

	protected $_component = 'pricelist';
    protected $_table_pricelist = 'pricelist';
    protected $_table_item = 'pricelist_items';

	public function get_pages()
    {
        $query = $this->db->get_where('components', array('component_name' => $this->_component));
        if ($query->num_rows() != 0) {
            return $this->db->get($this->_table_pricelist)->result_array();
        }
    }

    public function create_price($file)
    {
        $this->db->insert($this->_table_pricelist, array(
            'pricelist_title' => $this->input->post('pricelist_title', true),
            'pricelist_file' => $file
        ));
    }

    public function price_delete($id)
    {
    	$query = $this->db->get_where($this->_table_pricelist, array('pricelist_id' => $id))->row_array();
    	unlink(FCPATH.'upload/prices/'.$query['pricelist_file']);
        $this->db->delete($this->_table_pricelist, array('pricelist_id' => $id));
    }
}