<?php
class Database extends MY_Model {
    protected $_component = 'tovar';
    protected $_table_news = 'tovar';
    protected $_table_news_content = 'tovar_content';
    protected $_table = 'tovar_material';


    public function get_all_category()
    {
        return $this->db->get($this->_table)->result_array();
    }

        public function delete_item($id)
    {
        $this->db->where('tovar_material_id', $id);
        $this->db->delete($this->_table);
    }

    
    public function add_data_material($data)
    {
         $this->db->insert($this->_table, $data); 
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