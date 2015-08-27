<?php
class Database extends MY_Model {
    protected $_component = 'news';
    protected $_table_news = 'news';
    protected $_table_news_content = 'news_content';
    // protected $_table='news';

    function redaktirovanie_novosti($id)
    {
        $rez = $this->db->query("SELECT * FROM news WHERE news_id='{$id}'");
        return $rez->result_array();
    }

    function redakt_comment($id)
    {
        $rez = $this->db->query("SELECT * FROM news_comments WHERE news_comment_id='{$id}'");
        return $rez->result_array();
    }

    function add_data_news($data)
    {
            $data2['news_name'] = $data['zagolovok'];//название
            // $data2['preview'] = cutStr($data['editor1']);
            $data2['news_text'] = $data['editor1'];//текст
            $data2['news_lang'] = 'ru';//язык
            $data2['news_type'] = $data['type'];//тип

            //определяем дату
            $this->load->helper('date');
            date_default_timezone_set('Asia/Almaty');
            $datestring = '%Y:%m:%d';
            $data2['news_date'] = mdate($datestring);

            //определям id юзера, написавшего новость
            // $query = $this->db->query("SELECT user_id FROM users WHERE user_name='{$this->session->userdata('user_name')}'");
            // $data2['user_id'] =$query->row('user_id');
            $data2['user_id'] ='admin';

            If ($data['id']!='')
            {
                $this->db->where('news_id', $data['id']);
                $this->db->update('news', $data2);
            }
            else $this->db->insert('news', $data2);
    }

    function add_data_comment($data)
    {

            $data2['news_comment_text'] = $data['editor2'];//текст

            //определяем дату
            $this->load->helper('date');
            date_default_timezone_set('Asia/Almaty');
            $datestring = '%Y:%m:%d';
            $data2['news_comment_date'] = mdate($datestring);

                $this->db->where('news_comment_id', $data['id']);
                $this->db->update('news_comments', $data2);
    }

    function add_data_img($data)
    {
        // $data2['img_adres'] = $data['img_adres'];
        // $data2['news_id'] = $data['news_id'];

        $this->db->insert('img', $data);
    }

    function get_num()
    {
            $rez = $this->db->query("SELECT count(*) AS num FROM news");
            return $rez->result_array();
    }
    
    function get_num_comment()
    {
            $rez = $this->db->query("SELECT count(*) AS num FROM news_comments");
            return $rez->result_array();
    }

    function get_news($num, $offset)
    {
        $this->db->order_by('news_id DESC');

        $rez = $this->db->get('news', $num, $offset);
        return $rez->result_array();
    }

    
    function get_news_id($data)
    {
        $this->db->where('news_name', $data);
        $rez = $this->db->get('news');
        foreach ($rez->result_array() as $item) {$rez2 = $item['news_id'] ;}
        return $rez2;
    }

    
    function get_img($news_id)
    {
        $this->db->where('news_id', $news_id);
        $rez = $this->db->get('img');

            // foreach ($rez->result_array() as $item) {$rez2 = $item['img_adres'] ;}
            $rez3='';
            foreach ($rez->result() as $row)
            {
                if (isset($row->img_adres)) 
                {
                    $rez3 = $row->img_adres;
                } 
            }
            return $rez3;

        // return $rez->result_array();
    }
    
    function get_news_comments($num, $offset)
    {
        $this->db->order_by('news_comment_id DESC');

        $rez = $this->db->get('news_comments', $num, $offset);
        return $rez->result_array();
    }

    function get_preview($str)
    {
        $lenght = 30;
        $end = '...';
        $charset = 'UTF-8';
        $token = '~';
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

    function get_user($user_id)
    {
        $this->db->where('user_id', $user_id);
        $rez = $this->db->get('users');
        foreach ($rez->result_array() as $item) {$rez2 = $item['user_name'] ;}
        // return $rez2;
        return 'admin';
    }

        function dell_news($data)
    {
        $this->db->where('news_id', $data['id']);
        $this->db->delete('news');
    }

    function dell_img($data)
    {
        $this->db->where('news_id', $data['id']);
        // $this->db->select('ing_adres');
        $query = $this->db->get('img');

            foreach ($query->result() as $row) 
            {
                unlink($row->img_adres);  // удаляем файл с именем 
            }

        $this->db->where('news_id', $data['id']);
        $this->db->delete('img'); //удаляем из базы
         // $query = "DELETE FROM img WHERE news_id='{$data['id']}'";
         // mysql_query($query) or die(mysql_error());
    }


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