<?php
class Api_tovar extends MY_Model {
    protected $_table = 'tovar';
    protected $_table_content = 'tovar_content';


    public function get_all($selector_sub_cat, $selector_sort, $page = '')
    {
        // $this->db->order_by('news_id DESC');
        // используем для того чтобы значение второй переменной не присваивалось первой , когда первая пустое поле

        //конфикурация постраничного вывода
        $category = 1;
        $config['base_url'] = 'welcome/magazin/'.$selector_sub_cat.'/'.$selector_sort.'/'.$page.'/';
        // $config['base_url'] = 'welcome/magazin/';
        $config['per_page'] = '6'; 
        $config['total_rows'] = $this->get_num($category);
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
        $offset = ($this->uri->segment(6) != null) ? $this->uri->segment(6) : 0;

        //постраничный вывод
        $this->pagination->initialize($config); 

        // формируем меню 
        if ($selector_sub_cat!='x') 
        {
            $name_sub_category = $this->get_name_sub_category($selector_sub_cat);
        }
        else
        {
            $name_sub_category = 'Все';
        }
        // конфигурируем селектор
        $activ_selector_sort_1='';
        $activ_selector_sort_2='';
        $activ_selector_sort_3='';
        $activ_selector_sort_4='';

        switch($selector_sort) 
        {
        case '1': $activ_selector_sort_1 = 'selected'; break;//сортировка по дате добавления id
        case '2': $activ_selector_sort_2 = 'selected'; break;//сортировка по цене от недорогих tovar_prise
        case '3': $activ_selector_sort_3 = 'selected'; break;//сортировка по цене от дорогих tovar_prise
        case '4': $activ_selector_sort_4 = 'selected'; break;//сортировка по рейтнгу tovar_reit
        }


        return $this->load->view('component/tovar/api/tovar', array(
                    'tovar' => $this->get_tovar($config['per_page'], $offset , $selector_sub_cat, $selector_sort, $category ),
                    'sub_category_menu' => $this->get_tovar_sub_category($category),
                    'all_material_select' => $this->get_all_material(),
                    'name_sub_category' => $name_sub_category,
                    'id_sub_category' => $selector_sub_cat,
                    'selector_sort' => $selector_sort,
                    'activ_selector_sort_1' => $activ_selector_sort_1,
                    'activ_selector_sort_2' => $activ_selector_sort_2,
                    'activ_selector_sort_3' => $activ_selector_sort_3,
                    'activ_selector_sort_4' => $activ_selector_sort_4,
                ), true);
    }

    function get_tovar_ed($tovar_id)
    {
        // для меню
        $name_sub_category = $this->get_name_sub_category_tovar($tovar_id);

        return $this->load->view('component/tovar/api/tovar_ed', array(
                    'tovar_ed' => $this->get_tovar_edinicu($tovar_id),
                    'name_sub_category' => $name_sub_category
                ), true);
    }

    function get_pogonaj_forindex()
    {
        return $this->load->view('component/tovar/api/index_pogonaj', array(
                    'tovar' => $this->get_tovar_pogonaj(),
                ), true);
    }

    function get_project_forindex()
    {
        return $this->load->view('component/tovar/api/index_project', array(
                    'tovar' => $this->get_tovar_project(),
                ), true);
    }

    public function get_all_project($selector_sub_cat, $selector_sort, $page = '')
    {

        //конфикурация постраничного вывода
        $category = 2;
        $config['base_url'] = 'welcome/magazin_project/'.$selector_sub_cat.'/'.$selector_sort.'/'.$page.'/';
        $config['per_page'] = '6'; 
        $config['total_rows'] = $this->get_num($category);
        $offset = ($this->uri->segment(5) != null) ? $this->uri->segment(5) : 0;

        //постраничный вывод
        $this->pagination->initialize($config); 

        // конфигурируем селектор
        $activ_selector_sort_1='';
        $activ_selector_sort_2='';
        $activ_selector_sort_3='';
        $activ_selector_sort_4='';

        switch($selector_sort) 
        {
        case '1': $activ_selector_sort_1 = 'selected'; break;//сортировка по дате добавления id
        case '2': $activ_selector_sort_2 = 'selected'; break;//сортировка по цене от недорогих tovar_prise
        case '3': $activ_selector_sort_3 = 'selected'; break;//сортировка по цене от дорогих tovar_prise
        case '4': $activ_selector_sort_4 = 'selected'; break;//сортировка по рейтнгу tovar_reit
        }


        return $this->load->view('component/tovar/api/project', array(
                    // 'tovar' => $this->get_project($config['per_page'], $this->uri->segment(3)),
                    // 'sub_category_menu' => $this->get_tovar_sub_category($category),
                    'tovar' => $this->get_tovar($config['per_page'], $offset , $selector_sub_cat, $selector_sort, $category ),
                    'sub_category_menu' => $this->get_tovar_sub_category($category),
                    'id_sub_category' => $selector_sub_cat,
                    'selector_sort' => $selector_sort,
                    'activ_selector_sort_1' => $activ_selector_sort_1,
                    'activ_selector_sort_2' => $activ_selector_sort_2,
                    'activ_selector_sort_3' => $activ_selector_sort_3,
                    'activ_selector_sort_4' => $activ_selector_sort_4,
                ), true);
    }

    public function get_all_project_zakaz($selector_sub_cat, $selector_sort, $page = '')
    {
        //конфикурация постраничного вывода
        $category = 4;
        $config['base_url'] = 'welcome/magazin_project/'.$selector_sub_cat.'/'.$selector_sort.'/'.$page.'/';
        $config['per_page'] = '6'; 
        $config['total_rows'] = $this->get_num($category);
        $offset = ($this->uri->segment(5) != null) ? $this->uri->segment(5) : 0;

        //постраничный вывод
        $this->pagination->initialize($config); 

        // конфигурируем селектор
        $activ_selector_sort_1='';
        $activ_selector_sort_2='';
        $activ_selector_sort_3='';
        $activ_selector_sort_4='';

        switch($selector_sort) 
        {
        case '1': $activ_selector_sort_1 = 'selected'; break;//сортировка по дате добавления id
        case '2': $activ_selector_sort_2 = 'selected'; break;//сортировка по цене от недорогих tovar_prise
        case '3': $activ_selector_sort_3 = 'selected'; break;//сортировка по цене от дорогих tovar_prise
        case '4': $activ_selector_sort_4 = 'selected'; break;//сортировка по рейтнгу tovar_reit
        }


        return $this->load->view('component/tovar/api/project', array(
                    // 'tovar' => $this->get_project($config['per_page'], $this->uri->segment(3)),
                    // 'sub_category_menu' => $this->get_tovar_sub_category($category),
                    'tovar' => $this->get_tovar($config['per_page'], $offset , $selector_sub_cat, $selector_sort, $category ),
                    'sub_category_menu' => $this->get_tovar_sub_category($category),
                    'id_sub_category' => $selector_sub_cat,
                    'selector_sort' => $selector_sort,
                    'activ_selector_sort_1' => $activ_selector_sort_1,
                    'activ_selector_sort_2' => $activ_selector_sort_2,
                    'activ_selector_sort_3' => $activ_selector_sort_3,
                    'activ_selector_sort_4' => $activ_selector_sort_4,
                ), true);
    }


    function get_tovar($num, $offset, $selector_sub_cat, $selector_sort, $category)
    {

        //если выбрали подкатегорию в селекторе
        if ($selector_sub_cat != 'x') 
        {
            $this->db->where('tovar_sub_category_id', $selector_sub_cat);
        }
        else
        {
            // выбираем только подкатегории где категория $category
            $this->db->where('tovar_category_id', $category);
            $rez = $this->db->get('tovar_sub_category');
            // Если производится несколько вызовов функции, то их результаты связывается друг с другом с помощью OR AND:
            foreach ($rez->result_array() as $item) 
            {
                $this->db->or_where('tovar_sub_category_id', $item['tovar_sub_category_id']);
            }
        }

        // сортируем вывод
        switch($selector_sort) 
        {
        case '1': $this->db->order_by('tovar_id DESC'); break;//сортировка по дате добавления id
        case '2': $this->db->order_by('tovar_prise DESC'); break;//сортировка по цене от недорогих tovar_prise
        case '3': $this->db->order_by("tovar_prise", "ASC"); break;//сортировка по цене от дорогих tovar_prise
        case '4': $this->db->order_by('tovar_reit DESC'); break;//сортировка по рейтнгу tovar_reit
        }

        //выбрали товар в базе и вернули
        $this->db->limit($num, $offset);
        $rez2 = $this->db->get('tovar');
        return $rez2->result_array();
    }

    function get_tovar_edinicu($tovar_id)
    {
        $this->db->where('tovar_id', $tovar_id);
        $rez2 = $this->db->get('tovar');
        return $rez2->result_array();
    }

    function get_tovar_pogonaj()
    {
        $tovar_pogonaj_id = 1;
        $this->db->where('tovar_sub_category_id', $tovar_pogonaj_id);
        $this->db->limit(8);
        $rez2 = $this->db->get('tovar');
        return $rez2->result_array();
    }

    function get_tovar_project()
    {
        $tovar_project_id = 2;
        // выбираем только подкатегории где категория 2
        $this->db->where('tovar_category_id', $tovar_project_id);
        $rez = $this->db->get('tovar_sub_category');
        // Если производится несколько вызовов функции, то их результаты связывается друг с другом с помощью OR:
        foreach ($rez->result_array() as $item) 
        {
            $this->db->or_where('tovar_sub_category_id', $item['tovar_sub_category_id']);
        }
        $this->db->limit(8);
        $rez2 = $this->db->get('tovar');
        return $rez2->result_array();
    }

    function get_project($num, $offset)
    {
        // $this->db->order_by('news_id DESC');
        // выбираем только подкатегории где категория 2
        $this->db->where('tovar_category_id', 2);
        $rez = $this->db->get('tovar_sub_category');
        // Если производится несколько вызовов функции, то их результаты связывается друг с другом с помощью OR:
        foreach ($rez->result_array() as $item) 
        {
            $this->db->or_where('tovar_sub_category_id', $item['tovar_sub_category_id']);
        }

        $rez2 = $this->db->get('tovar', $num, $offset);
        return $rez2->result_array();
    }

    function get_project_zakaz($num, $offset)
    {
        // $this->db->order_by('news_id DESC');
        // выбираем только подкатегории где категория 4
        $this->db->where('tovar_category_id', 4);
        $rez = $this->db->get('tovar_sub_category');
        // Если производится несколько вызовов функции, то их результаты связывается друг с другом с помощью OR:
        foreach ($rez->result_array() as $item) 
        {
            $this->db->or_where('tovar_sub_category_id', $item['tovar_sub_category_id']);
        }

        $rez2 = $this->db->get('tovar', $num, $offset);
        return $rez2->result_array();
    }

    // выводим только число товаров, которые относятся к переданной категории 
    function get_num($category)
    {
        // выбираем только подкатегории где категория 1
        $this->db->where('tovar_category_id', $category);
        $rez = $this->db->get('tovar_sub_category');
        // Если производится несколько вызовов функции, то их результаты связывается друг с другом с помощью OR:
        foreach ($rez->result_array() as $item) 
        {
            $this->db->or_where('tovar_sub_category_id', $item['tovar_sub_category_id']);
        }

        $this->db->from('tovar');
        return $this->db->count_all_results();
        // $rez2 = $this->db->query("SELECT count(*) AS num FROM tovar");
        // return $rez2->result_array();
    }

    function get_tovar_sub_category($category)
    {
        $this->db->where('tovar_category_id', $category);
        return $this->db->get('tovar_sub_category')->result_array();
    }

    function get_all_material()
    {
        return $this->db->get('tovar_material')->result_array();
    }

    function get_material($id)
    {
        $this->db->where('tovar_material_id', $id);
        $rez = $this->db->get('tovar_material');
        foreach ($rez->result_array() as $item) {$rez2 = $item['tovar_material_name'] ;}
        return $rez2;
    }

    function get_sub_category_text($tovar_id)
    {
        $this->db->where('tovar_id', $tovar_id);
        $rez = $this->db->get('tovar');
        foreach ($rez->result_array() as $selector_sub_cat) {$rez2 = $selector_sub_cat['tovar_sub_category_id'] ;}

        $this->db->where('tovar_sub_category_id', $rez2);
        $rez = $this->db->get('tovar_sub_category');
        foreach ($rez->result_array() as $item) {$rez3 = $item['tovar_sub_category_text'] ;}
        return $rez3;
    }

    function get_name_sub_category_tovar($tovar_id)
    {
        $this->db->where('tovar_id', $tovar_id);
        $rez = $this->db->get('tovar');
        foreach ($rez->result_array() as $selector_sub_cat) {$rez2 = $selector_sub_cat['tovar_sub_category_id'] ;}

        $this->db->where('tovar_sub_category_id', $rez2);
        $rez = $this->db->get('tovar_sub_category');
        foreach ($rez->result_array() as $item) {$rez3 = $item['tovar_sub_category_name'] ;}
        return $rez3;
    }

    function get_name_sub_category($selector_sub_cat)
    {
        $this->db->where('tovar_sub_category_id', $selector_sub_cat);
        $rez = $this->db->get('tovar_sub_category');
        foreach ($rez->result_array() as $item) {$rez2 = $item['tovar_sub_category_name'] ;}
        return $rez2;
    }

    function get_img1($id)
    {
        $this->db->where('tovar_id', $id);
        $this->db->limit(1);//берем первое изображение
        $rez = $this->db->get('tovar_img');
        foreach ($rez->result_array() as $item) {$rez2 = $item['tovar_img_adres'] ;}
        // если изображения нет берем картинку из подкатегории
        if (!isset($rez2)) 
        {
            $this->db->where('tovar_id', $id);
            $rez = $this->db->get('tovar');
            foreach ($rez->result_array() as $item) {$sub_id = $item['tovar_sub_category_id'] ;}

            $this->db->where('tovar_sub_category_id', $sub_id);
            $this->db->limit(1);//берем первое изображение
            $rez = $this->db->get('tovar_sub_category_img');
            foreach ($rez->result_array() as $item) {$rez2 = $item['tovar_img_adres'] ;}
            return $rez2;
        }
        else
        {
            return $rez2;
        }
        
    }
    function get_img2($id)
    {
        $this->db->where('tovar_id', $id);
        $this->db->limit(2);//берем второе изображение
        $rez = $this->db->get('tovar_img');
        foreach ($rez->result_array() as $item) {$rez2 = $item['tovar_img_adres'] ;}
        // если изображения нет берем картинку из подкатегории
        if (!isset($rez2)) 
        {
            $this->db->where('tovar_id', $id);
            $rez = $this->db->get('tovar');
            foreach ($rez->result_array() as $item) {$sub_id = $item['tovar_sub_category_id'] ;}

            $this->db->where('tovar_sub_category_id', $sub_id);
            $this->db->limit(2);//берем второе изображение
            $rez = $this->db->get('tovar_sub_category_img');
            foreach ($rez->result_array() as $item) {$rez2 = $item['tovar_img_adres'] ;}
            return $rez2;
        }
        else
        {
            return $rez2;
        }
    }

    function get_img_all($tovar_id)
    {
        $this->db->where('tovar_id', $tovar_id);
        $rez = $this->db->get('tovar_img');
        // если изображения нет берем картинку из подкатегории
        if (!$rez->result_array()) 
        {
            $this->db->where('tovar_id', $tovar_id);
            $rez = $this->db->get('tovar');
            foreach ($rez->result_array() as $item) {$sub_id = $item['tovar_sub_category_id'] ;}

            $this->db->where('tovar_sub_category_id', $sub_id);
            $this->db->limit(2);//берем 2 изображения
            $rez2 = $this->db->get('tovar_sub_category_img');
            return $rez2->result_array();
        }
        else
        {
            return $rez->result_array();
        }
    }

    function get_color_name($tovar_id)
    {
        $this->db->where('tovar_id', $tovar_id);
        $rez = $this->db->get('tovar');
        foreach ($rez->result_array() as $item) {$rez2 = $item['tovar_color_id'] ;}

        $this->db->where('tovar_color_id', $rez2);
        $rez = $this->db->get('tovar_color');
        foreach ($rez->result_array() as $item) {$rez3 = $item['tovar_color_name'] ;}
        return $rez3;
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