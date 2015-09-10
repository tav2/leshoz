<?php
class Api_users extends MY_Model {
    protected $_table = 'users';
    protected $_table_content = 'users_content';





    //была тут----------------------------------------------
    public function api_get_content($id, $lang)
    {
        $query = $this->db->get_where($this->_table_users, array(
            'news_id' => $id,
            'news_lang' => $lang
        ));
        return $this->load->view('component/news/api/page', array(
            'page' => $query->row_array()
        ), true);
    }
}