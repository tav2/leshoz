<?php
class Api_news extends MY_Model {
    protected $_table_news = 'news';
    protected $_table_news_content = 'news_content';

    public function get_all()
    {
        $this->db->order_by('news_id DESC');
        $rez = $this->db->get('news');
        return $this->load->view('component/news/api/news', array(
                    'rez' => $rez->result_array()
                ), true);
    }








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