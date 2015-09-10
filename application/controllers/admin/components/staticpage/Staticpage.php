<?php
class Staticpage extends Admin_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    public function before()
    {
        $this->load->model('component/'.strtolower(__CLASS__).'/database', 'dbmodel');
    }

    public function action_index()
    {
        $this->render('dashboard', array(
            'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
            'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
            'component_menu' => $this->component->get_navigation(),
            'component' => $this->component->run(strtolower(__CLASS__), array(
                'pages' => $this->dbmodel->get_pages()
            ))
        ));
    }

    public function action_add_page($action = '')
    {
        if ($action != '')
        {
            switch ($action)
            {
                case 'create':
                    $this->dbmodel->create_page();
                    $this->session->set_flashdata('status', 'Страница успешно добавлена');
                    redirect('/admin/components/staticpage/page_edit');
                    break;
            }
        }
        $this->render('dashboard', array(
            'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
            'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
            'component_menu' => $this->component->get_navigation(),
            'component' => $this->load->view('component/staticpage/add_page', array(
            ), true)
        ));
    }

    public function action_page_edit()
    {
        $data['staticpage_id']='';
        $data['staticpage_content'] = array();
        $data['staticpage_file'] = array();
        $data['pages']=$this->dbmodel->get_all_table();

        // если выбрали страницу
        if($id=$this->input->post('staticpage_select'))
        {
            $data['staticpage_id']=$id;
            $data['staticpage_content'] = $this->dbmodel->get_table_content($id);
            $data['staticpage_file'] = $this->dbmodel->get_staticpage_file($id);
        }
        

        $this->render('dashboard', array(
            'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
            'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
            'component_menu' => $this->component->get_navigation(),
            'component' => $this->load->view('component/staticpage/page_edit', $data, true)
        ));
    }

    // добавление файлов
    public function action_add_staticpage_file($id)
    {
            // создаем папку assets/img/staticpage_file/'.$id.'/' если ее нет
            $pass = 'assets/img/staticpage_file/'.$id.'/';

            if (!is_dir($pass)) {
                mkdir($pass, 0700, true);
            }
            // конфигурируем загрузчик картинок
            $config['upload_path'] = $pass; // путь к папке куда будем сохранять изображение
            $config['allowed_types'] = 'gif|jpg|png|mp4|avi|pdf'; // разрешенные форматы файлов
            $config['max_size'] = 3000000; // максимальный вес файла
            $config['encrypt_name'] = TRUE; // переименование файла в уникальное название
            $config['remove_spaces'] = TRUE; // убирает пробелы из названия файлов

            $this->load->library('upload', $config); // загружаем библиотеку

            if ( ! $this->upload->do_upload('userfile'))
            {
                $this->session->set_flashdata('success', $this->upload->display_errors());
            } 
            else 
            {

                /* Начало занесения имени файла в БД*/
                $upload_data = $this->upload->data(); // получаем информацию о загруженном файле
                $add['staticpage_file_adres'] = $config['upload_path'].$upload_data['file_name']; // сохраняем имя файла в элемент массива add
                $add['staticpage_id'] = $id; // сохраняем айди товара в элемент массива add
                $this->db->insert('staticpage_file',$add); // заносим это значение в таблицу staticpage_file
                /* Конец занесения имени файла в БД*/

                // выводим сообщение
                $this->session->set_flashdata('success', 'Файл добавлен');
                redirect('/admin/components/staticpage/page_edit');
            }

            $this->render('dashboard', array(
                'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
                'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
                'component_menu' => $this->component->get_navigation(),
                'component' => $this->load->view('component/staticpage/add_file', array(

                    'id' => $id
                ), true)
            ));
    }

    //добавление записей к странице
    public function action_add_staticpage_zapis($staticpage_id, $staticpage_content_id='')
    {
        // если нажали добавить
        if($this->input->post('staticpage_title'))
        {
            //добавляем в базу
            $data['staticpage_id']=$staticpage_id;
            $data['staticpage_title'] = $this->input->post('staticpage_title');
            $data['staticpage_text'] = $this->input->post('staticpage_text');
            $data['staticpage_lang'] = 'ru';

            // если новая запись
            if ($this->input->post('staticpage_content_id')=='') 
            {
                $this->dbmodel->add_zapis_data($data);
                // выводим сообщение
                $this->session->set_flashdata('success', 'Запись добавлена');
                redirect('/admin/components/staticpage/page_edit');
            }
            else
            {
                $this->dbmodel->update_zapis_data($data, $staticpage_content_id);
                // выводим сообщение
                $this->session->set_flashdata('success', 'Запись изменена');
                redirect('/admin/components/staticpage/page_edit');
            }

            // echo "внутри";
        }

        // если редактируем запись
        if ($staticpage_content_id!='') 
        {
            foreach ($this->dbmodel->get_table_staticpage_content($staticpage_content_id) as $item) 
            {
                $data['staticpage_content_id'] = $item['staticpage_content_id'];
                $data['staticpage_id'] = $item['staticpage_id'];
                $data['staticpage_title'] = $item['staticpage_title'];
                $data['staticpage_text'] = $item['staticpage_text'];
            }
        }
        else
        {
            $data['staticpage_content_id'] = '';
            $data['staticpage_id'] = $staticpage_id;
            $data['staticpage_title'] = '';
            $data['staticpage_text'] = '';
        }

        $this->render('dashboard', array(
            'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
            'js' => $this->asset->js(array('jquery', 'uikit', 'moment', 'ckeditor/ckeditor')),
            'component_menu' => $this->component->get_navigation(),
            'component' => $this->load->view('component/staticpage/add_zapis', $data, true)
        ));
    }

    public function action_delete_staticpage_zapis($staticpage_id, $staticpage_content_id)
    {
        $this->dbmodel->delete_staticpage_zapis($staticpage_id, $staticpage_content_id);
        $this->session->set_flashdata('success', 'Запись удалена');
        redirect('/admin/components/staticpage/page_edit');
    }

    public function action_delete_staticpage_file($id)
    {
        // удаляем из базы
        $this->dbmodel->delete_staticpage_file($id);
        $this->session->set_flashdata('success', 'Файл удален');
        redirect('/admin/components/staticpage/page_edit');
    }


    public function action_setup()
    {
        if($this->component->status(strtolower(__CLASS__)) != 1)
        {
            $this->render('dashboard', array(
                'css' => $this->asset->css(array('uikit', 'style')),
                'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
                'component_menu' => $this->component->get_navigation(),
                'component' => $this->component->run(strtolower(__CLASS__), 'setup')
            ));
        }
        redirect('admin/components/'.strtolower(__CLASS__));
    }
}