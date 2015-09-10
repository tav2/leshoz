<?php
class Database extends MY_Model {
    protected $_component = 'galereya';
    protected $_table_news = 'galereya_menu';
    protected $_table_news_content = 'galereya_content';
    protected $_table = 'galereya_menu';

    function get_all_galereya_menu()
    {
        return $this->db->get('galereya_menu')->result_array();
    }

    function get_galereya_menu($galereya_menu_id)
    {
        $this->db->where('galereya_menu_id', $galereya_menu_id);
        return $this->db->get('galereya_menu')->result_array();
    }

    function get_galereya_img($galereya_menu_id)
    {
        $this->db->where('galereya_menu_id', $galereya_menu_id);
        return $this->db->get('galereya_img')->result_array();
    }

    function add_data_galereya_menu($data, $id)
    {
        If ($id!='')
        {
            $this->db->where('galereya_menu_id', $id);
            $this->db->update('galereya_menu', $data);
        }
        else $this->db->insert('galereya_menu', $data); 
    }

    function delete_galereya_menu($id)
    {
        $this->db->where('galereya_menu_id', $id);
        $this->db->delete('galereya_menu');
    }

    //удаление записей изображений от удаленной менюшки галереи
    function delete_galereya_all_img_menu($id)
    {
        $this->db->where('galereya_menu_id', $id);
        $this->db->delete('galereya_img');
    }

    //удаление одного изображения в таблице менюшки галереи
    function delete_galereya_img_menu($id)
    {
        $this->db->where('galereya_img_id', $id);
        $this->db->delete('galereya_img');
    }

    //удаление одного изображения на сервере
    function delete_galereya_img($id)
    {
        $this->db->where('galereya_img_id', $id);

        $rez = $this->db->get('galereya_img');
        foreach ($rez->result_array() as $item) {$put = $item['galereya_img_adres'] ;}
        unlink($put);
    }

    function delete_all_galereya_img($id)
    {
        $dir = 'assets/img/galereya/'.$id.'/';
        if ($objs = glob($dir."/*")) 
        {
        foreach($objs as $obj) 
        {
            is_dir($obj) ? $this->delete_all_galereya_img($obj) : unlink($obj);
        }
        }
        rmdir($dir);
    }



    //были тут ---------------------------------
    public function create_page()
    {
        $this->db->insert($this->_table_news, array(
            'news_name' => $this->input->post('news_name', true)
        ));
        $id = $this->db->insert_id();
        if($this->config->item('multi_language_enable') === true AND count($this->config->item('multi_language')) > 0)
        {
            $languages = $this->config->item('multi_language');
            foreach ($languages as $key => $value)
            {
                $this->db->insert($this->_table_news_content, array(
                    'news_id' => $id,
                    'news_name' => '',
                    'news_text' => '',
                    'news_lang' => $key
                ));
            }
        } else {
            $this->db->insert($this->_table_news_content, array(
                'news_id' => $id,
                'news_name' => '',
                'news_text' => '',
                'news_lang' => lang_id()
            ));
        }
    }
    public function get_pages()
    {
        $query = $this->db->get_where('components', array('component_name' => $this->_component));
        if ($query->num_rows() != 0) {
            return $this->db->get($this->_table_news)->result_array();
        }        
    }
    public function get_page_content($id)
    {
        $result = null;
        if($this->config->item('multi_language_enable') === true AND count($this->config->item('multi_language')) > 0)
        {
            $languages = $this->config->item('multi_language');
            foreach ($languages as $key => $value)
            {
                $result[$key] = $this->db->get_where($this->_table_news_content, array(
                    'news_id' => $id,
                    'news_lang' => $key
                ))->row_array();
                
            }
        } else {
            $result[lang_id()] = $this->db->get_where($this->_table_news_content, array(
                    'news_id' => $id,
                    'news_lang' => lang_id()
                ))->row_array();
        }
        
        
        return $result;
    }
    public function page_content_edit()
    {
        $this->db->where('news_content_id', $this->input->post('news_content_id'));
        $this->db->where('news_lang', $this->input->post('news_lang'));
        $this->db->update($this->_table_news_content, array(
            'news_name' => $this->input->post('news_name_'.$this->input->post('news_lang')),
            'news_text' => $this->input->post('news_text_'.$this->input->post('news_lang')),
        ));
    }
    public function page_delete($id)
    {
        $this->db->delete($this->_table_news, array('news_id' => $id));
        $this->db->delete($this->_table_news_content, array('news_id' => $id));
    }
}