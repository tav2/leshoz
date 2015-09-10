<?php
class Database extends MY_Model {
    protected $_component = 'staticpage';
    protected $_table_staticpage = 'staticpage';
    protected $_table_content = 'staticpage_content';
    protected $_table = 'staticpage';
    protected $_table_id = 'staticpage_id';
    protected $_table_content_id = 'staticpage_content_id';
    
    // выводим все записи из таблицы как масив
    public function get_all_table()
    {
        return $this->db->get($this->_table)->result_array();
    }

    // выводим одну запись из таблицы с id как масив
    public function get_table_content($id)
    {
        if ($id!='')
        {
            $this->db->where('staticpage_id', $id);
            return $this->db->get('staticpage_content')->result_array();
        }
        else
        {
            return array();
        }
    }

    // выводим одну запись из таблицы с id как масив
    public function get_table_staticpage_content($id)
    {
        if ($id!='')
        {
            $this->db->where('staticpage_content_id', $id);
            return $this->db->get('staticpage_content')->result_array();
        }
        else
        {
            return array();
        }
    }

    public function get_table_field($id, $field)
    {
        if ($id!='')
        {
            $this->db->where($this->_table_id, $id);

            $rez = $this->db->get($this->_table);
            foreach ($rez->result_array() as $item) {$rez2 = $item[$field] ;}
            return $rez2;
        }
        else
        {
            return '';
        }
    }

    public function get_staticpage_file($id)
    {
        if ($id)
        {
            $this->db->where('staticpage_id', $id);
            $rez=$this->db->get('staticpage_file');
            if ($rez) 
            {
                return $rez->result_array();
            }
            else return array();
        }
        else
        {
            return array();
        }
    }

    public function add_zapis_data($data)
    {
        $this->db->insert($this->_table_content, $data); 
    }

    public function update_zapis_data($data, $content_id)
    {
        $this->db->where($this->_table_content_id, $content_id);
        $this->db->update($this->_table_content, $data);
    }

    public function delete_staticpage_zapis($staticpage_id, $staticpage_content_id)
    {
        $this->db->where('staticpage_id', $staticpage_id);
        $this->db->where('staticpage_content_id', $staticpage_content_id);
        $this->db->delete('staticpage_content');
    }

    public function delete_staticpage_file($id)
    {
        $this->db->where('staticpage_file_id', $id);

        $rez = $this->db->get('staticpage_file');
        foreach ($rez->result_array() as $item) 
        {
            $put = $item['staticpage_file_adres'] ;
            unlink($put);
        }

        $this->db->where('staticpage_file_id', $id);
        $this->db->delete('staticpage_file');
    }








    // были тут---------------------------------
    public function create_page()
    {
        $this->db->insert($this->_table_staticpage, array(
            'staticpage_name' => $this->input->post('staticpage_name', true)
        ));
        $id = $this->db->insert_id();
        if($this->config->item('multi_language_enable') === true AND count($this->config->item('multi_language')) > 0)
        {
            $languages = $this->config->item('multi_language');
            foreach ($languages as $key => $value)
            {
                $this->db->insert($this->_table_content, array(
                    'staticpage_id' => $id,
                    'staticpage_title' => '',
                    'staticpage_text' => '',
                    'staticpage_lang' => $key
                ));
            }
        } else {
            $this->db->insert($this->_table_content, array(
                'staticpage_id' => $id,
                'staticpage_title' => '',
                'staticpage_text' => '',
                'staticpage_lang' => lang_id()
            ));
        }
    }
    public function get_pages()
    {
        $query = $this->db->get_where('components', array('component_name' => $this->_component));
        if ($query->num_rows() != 0) {
            return $this->db->get($this->_table_staticpage)->result_array();
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
                $result[$key] = $this->db->get_where($this->__table_content, array(
                    'staticpage_id' => $id,
                    'staticpage_lang' => $key
                ))->row_array();
                
            }
        } else {
            $result[lang_id()] = $this->db->get_where($this->__table_content, array(
                    'staticpage_id' => $id,
                    'staticpage_lang' => lang_id()
                ))->row_array();
        }
        
        
        return $result;
    }
    public function page_content_edit()
    {
        $this->db->where('staticpage_content_id', $this->input->post('staticpage_content_id'));
        $this->db->where('staticpage_lang', $this->input->post('staticpage_lang'));
        $this->db->update($this->_table_content, array(
            'staticpage_title' => $this->input->post('staticpage_title_'.$this->input->post('staticpage_lang')),
            'staticpage_text' => $this->input->post('staticpage_text_'.$this->input->post('staticpage_lang')),
        ));
    }
    public function page_delete($id)
    {
        $this->db->delete($this->_table_staticpage, array('staticpage_id' => $id));
        $this->db->delete($this->_table_content, array('staticpage_id' => $id));
    }
}