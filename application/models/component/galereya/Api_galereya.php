<?php
class Api_galereya extends MY_Model {
    protected $_table = 'galereya';
    protected $_table_content = 'galereya_content';

    //функции вывода на виев
    function get_galereya_menu_viev()
    {
        return $this->load->view('component/galereya/api/galereya_menu', array(
            'galereya_menu' => $this->get_galereya_menu(),
        ), true);
    }

    function get_galereya_img_viev($id_menu)
    {
        return $this->load->view('component/galereya/api/galereya_img', array(
            'galereya_img' => $this->get_galereya_img($id_menu),
        ), true);
    }

    // другие функции
    function get_galereya_menu()
    {
        return $this->db->get('galereya_menu')->result_array();
    }

    function get_galereya_img($id_menu, $page = '1')
    {
        //конфикурация постраничного вывода
        $config['base_url'] = 'welcome/galereya/'.$id_menu.'/'.$page.'/';
        $config['per_page'] = '8'; 
        $config['total_rows'] = $this->get_num_img($id_menu);
        $config['num_links'] = 2;
        $config['full_tag_open'] = '<div class="row"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['first_link'] = 'В начало';
        $config['first_tag_open'] = '<li class="pag-prev">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'В конец';
        $config['last_tag_open'] = '<li class="pag-prev">';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; ';
        $config['prev_tag_open'] = '<li class="pag-prev">';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li >';
        $config['num_tag_close'] = '</li>';
        $config['next_link'] = ' &rarr;';
        $config['next_tag_open'] = '<li class="pag-next">';
        $config['next_tag_close'] = '</li>';
        $offset = ($this->uri->segment(5) != null) ? $this->uri->segment(5) : 0;

        //постраничный вывод
        $this->pagination->initialize($config);

        $this->db->where('galereya_menu_id', $id_menu);
        $this->db->limit($config['per_page'], $offset);
        return $this->db->get('galereya_img')->result_array();
    }

    //число изображений в одном меню галереи
    function get_num_img($id_menu)
    {
        $this->db->where('galereya_menu_id', $id_menu);

        $this->db->from('galereya_img');
        return $this->db->count_all_results();
    }

    function get_galereya_date_viev($id_menu)
    {
        $this->db->where('galereya_menu_id', $id_menu);

        $rez = $this->db->get('galereya_menu');
        foreach ($rez->result_array() as $item) {$rez2 = $item['galereya_menu_date'] ;}
        return $rez2;
    }

    function get_galereya_text_viev($id_menu)
    {
        $this->db->where('galereya_menu_id', $id_menu);

        $rez = $this->db->get('galereya_menu');
        foreach ($rez->result_array() as $item) {$rez2 = $item['galereya_menu_text'] ;}
        return $rez2;
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