<?php
class Database extends MY_Model {
    protected $_component = 'tovar';
    protected $_table_news = 'tovar';
    protected $_table_news_content = 'tovar_content';
    protected $_table = 'tovar_material';

    function cutStr($str, $lenght = 200, $end = '...', $charset = 'UTF-8', $token = '~')
    {
        $str = strip_tags($str);
        if (mb_strlen($str, $charset) >= $lenght)
        {
            $wrap = wordwrap($str, $lenght, $token);
            $str_cut = mb_substr($wrap, 0, mb_strpos($wrap, $token, 0, $charset), $charset);
            return $str_cut .= $end;
        } else {
            return $str;
        }
    }


    public function get_all_material()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function get_material($material_id)
    {
        $this->db->where('tovar_material_id', $material_id);

        $rez = $this->db->get('tovar_material');
        foreach ($rez->result_array() as $item) {$rez2 = $item['tovar_material_name'] ;}
        return $rez2;
    }

    public function get_color($color_id)
    {
        $this->db->where('tovar_color_id', $color_id);

        $rez = $this->db->get('tovar_color');
        foreach ($rez->result_array() as $item) {$rez2 = $item['tovar_color_name'] ;}
        return $rez2;
    }

    public function get_sub_category($subcategory_id)
    {
        $this->db->where('tovar_sub_category_id', $subcategory_id);

        $rez = $this->db->get('tovar_sub_category');
        foreach ($rez->result_array() as $item) {$rez2 = $item['tovar_sub_category_name'] ;}
        return $rez2;
    }

    function get_tovar($tovar_id)
    {
        $this->db->where('tovar_id', $tovar_id);

        $rez = $this->db->get('tovar');
        return $rez->result_array();
    }

    function get_tovar_sub_category($id)
    {
        $this->db->where('tovar_sub_category_id', $id);

        $rez = $this->db->get('tovar_sub_category');
        return $rez->result_array();
    }

    function get_tovar_sub_category_text($id)
    {
        $this->db->where('tovar_sub_category_id', $id);

        $rez = $this->db->get('tovar_sub_category');
        foreach ($rez->result_array() as $item) {$rez2 = $item['tovar_sub_category_text'] ;}
        return $rez2;
    }

    function get_tovar_img($tovar_id)
    {
        $this->db->where('tovar_id', $tovar_id);

        $rez = $this->db->get('tovar_img');
        return $rez->result_array();
    }

    function get_tovar_sub_category_img($id)
    {
        $this->db->where('tovar_sub_category_id', $id);

        $rez = $this->db->get('tovar_sub_category_img');
        return $rez->result_array();
    }

    // выбор товара только с нужной подкатегорией
    function get_tovar_sub($subcategory_id)
    {
        $this->db->where('tovar_sub_category_id', $subcategory_id);

        return $this->db->get('tovar')->result_array();
        // return $rez->result_array();
    }

    // выбор подкатегории только с нужной категорией
    function get_sub_category_menu($category_id)
    {
        $this->db->where('tovar_category_id', $category_id);

        return $this->db->get('tovar_sub_category')->result_array();
        // return $rez->result_array();
    }

    // выбор меню товара только с нужной категорией
    // function get_tovar_cat($category_id)
    // {
    //     $this->db->where('tovar_sub_category_id', $category_id);
    //     $rez = $this->db->get('tovar_sub_category')->result_array();

    //     foreach ($rez->result_array() as $item) {$rez2 = $item['tovar_sub_category_id'] ;}
    //     return $rez2;

    //     $this->db->where('tovar_sub_category_id', $category_id);
    //     $qwery = $this->db->get('tovar_sub_category')->result_array();
        // return $rez->result_array();
    // }

    public function get_all_category()
    {
        return $this->db->get('tovar_category')->result_array();
    }

    public function get_all_sub_category()
    {
        return $this->db->get('tovar_sub_category')->result_array();
    }

    public function get_all_tovar()
    {
        return $this->db->get('tovar')->result_array();
    }

    public function get_all_color()
    {
        return $this->db->get('tovar_color')->result_array();
    }

        public function delete_item($id)
    {
        $this->db->where('tovar_material_id', $id);
        $this->db->delete($this->_table);
    }

    public function delete_color($id)
    {
        $this->db->where('tovar_color_id', $id);
        $this->db->delete('tovar_color');
    }

    public function delete_sub_category($id)
    {
        $this->db->where('tovar_sub_category_id', $id);
        $this->db->delete('tovar_sub_category');
    }

    
    public function delete_category($id)
    {
        $this->db->where('tovar_category_id', $id);
        $this->db->delete('tovar_category');
    }

    public function dell_tovar($id)
    {
        $this->db->where('tovar_id', $id);
        $this->db->delete('tovar');
    }

    public function dell_all_img($id)
    {
        $this->db->where('tovar_id', $id);

        $rez = $this->db->get('tovar_img');
        foreach ($rez->result_array() as $item) 
        {
            $put = $item['tovar_img_adres'] ;
            unlink($put);
        }

        $this->db->where('tovar_id', $id);
        $this->db->delete('tovar_img');
    }

    public function dell_img($id)
    {
        $this->db->where('tovar_img_id', $id);

        $rez = $this->db->get('tovar_img');
        foreach ($rez->result_array() as $item) {$put = $item['tovar_img_adres'] ;}
        unlink($put);

        $this->db->where('tovar_img_id', $id);
        $this->db->delete('tovar_img');
    }

    public function delete_sub_category_img($id)
    {
        $this->db->where('tovar_sub_category_img_id', $id);

        $rez = $this->db->get('tovar_sub_category_img');
        foreach ($rez->result_array() as $item) {$put = $item['tovar_sub_category_img_adres'] ;}
        unlink($put);

        $this->db->where('tovar_sub_category_img_id', $id);
        $this->db->delete('tovar_sub_category_img');
    }

    public function add_data_material($data)
    {
        $this->db->insert($this->_table, $data); 
    }

    public function add_data_color($data)
    {
        $this->db->insert('tovar_color', $data); 
    }

    public function add_data_category($data)
    {
        $this->db->insert('tovar_category', $data); 
    }

    public function add_data_sub_category($data, $id)
    {
        If ($id!='')
        {
            $this->db->where('tovar_sub_category_id', $id);
            $this->db->update('tovar_sub_category', $data);
        }
        else $this->db->insert('tovar_sub_category', $data); 
    }

    public function add_data_tovar($data, $id)
    {
        If ($id!='')
        {
            $this->db->where('tovar_id', $id);
            $this->db->update('tovar', $data);
        }
        else $this->db->insert('tovar', $data);
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