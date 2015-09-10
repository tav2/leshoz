<?php
class Api extends MY_Model {
    protected $_table_staticpage = 'staticpage';
    protected $_table_staticpage_content = 'staticpage_content';
    protected $_table_staticpage_file = 'staticpage_content';

    public function api_get_content($id, $lang)
    {
        $query = $this->db->get_where($this->_table_staticpage_content, array(
            'staticpage_id' => $id,
            'staticpage_lang' => $lang
        ));
        return $this->load->view('component/staticpage/api/page', array(
            'page' => $query->row_array()
        ), true);
    }

    public function api_get_file($id)
    {
        $query = $this->db->get_where($this->_table_staticpage_file, array(
            'staticpage_id' => $id,
            // 'staticpage_lang' => $lang
        ));
        return $this->load->view('component/staticpage/api/page', array(
            'page' => $query->row_array()
        ), true);
    }
}