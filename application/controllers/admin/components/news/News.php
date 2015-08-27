<?php

class News extends Admin_Controller {

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

    // добавление новости
    public function action_add_news($id='')
    {

        // если добавляем статью
        if($this->input->post('zagolovok'))
        {
            //добавляем в базу
            $data = array(
               'zagolovok' => $_POST["zagolovok"] ,
               'editor1' => $_POST["editor1"] ,
               'id' => $id, 
               'type' => $_POST["type"]
            );

            $this->dbmodel->add_data_news($data);

            $put=$this->do_upload();


            // если загружен файл картинки
            if($put != '')
            {
                //удаляем все картинки от этой сновости
                if($id != '')//если редактируем 
                {
                    $this->dbmodel->dell_img($id);
                }
                //добавляем в базу путь картинки
                $news_id=$this->dbmodel->get_news_id($data['zagolovok']);
                $data_img = array(
                   'img_adres' => $put ,
                   'news_id' => $news_id 
                );
                $this->dbmodel->add_data_img($data_img);
            }


            // выводим сообщение
            $this->session->set_flashdata('success', 'Новость добавлена');
            // redirect('/admin/components/news');
        }

        $this->load->helper('form');
        if($id)//если редактируем
        {
            $put2=$this->dbmodel->get_img($id);
            $novost_id['uploadfile'] = $put2; //картинка в редакторе

            foreach ($this->dbmodel->redaktirovanie_novosti($id) as $item) 
                {
                    $novost_id['title'] = $item['news_name'];
                    $novost_id['body']  = $item['news_text'];
                    $novost_id['id']  = $id;
                    $data['id'] = $id;
                    $selekt = $item['news_type'];
                }
        } else {
                    $novost_id['title'] = '';
                    $novost_id['body']  = '';
                    $novost_id['id']  = '';
                    $data['id'] = '';
                    $selekt = '';
                }

                $novost_id['selekt0'] = '';
                $novost_id['selekt1'] = '';
                $novost_id['selekt2'] = '';
                $novost_id['selekt3'] = '';

                switch ($selekt) {
                    case '0':
                        $novost_id['selekt0'] = 'selected';
                        break;
                    case '1':
                        $novost_id['selekt1'] = 'selected';
                        break;
                    case '2':
                        $novost_id['selekt3'] = 'selected';
                        break;
                    case '3':
                        $novost_id['selekt4'] = 'selected';
                        break;
                    case '':
                        $novost_id['selekt0'] = 'selected';
                        break;
                    }

        $this->render('dashboard', array(
        'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
        'js' => $this->asset->js(array('jquery', 'uikit', 'moment', 'ckeditor/ckeditor')),
        'component_menu' => $this->component->get_navigation(),
        'component' => $this->load->view('component/news/add_news', $novost_id, true)
        ));
    }

    // редактирование новости
    public function action_edit_news()
    {
        //конфикурация постраничного вывода
        $config['base_url'] = 'admin/components/news/edit_news/';
        $config['per_page'] = '3'; 
        $data['rows'] = $this->dbmodel->get_num();
        foreach ($data['rows'] as $item) {$config['total_rows'] = $item['num'];}


        //постраничный вывод
        $this->pagination->initialize($config); 
        $data['news'] = $this->dbmodel->get_news($config['per_page'], $this->uri->segment(5));


        $this->render('dashboard', array(
            'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
            'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
            'component_menu' => $this->component->get_navigation(),
            'component' => $this->load->view('component/news/edit_news', $data, true)
        ));
    }

    // удаление новости
    public function action_dell_news($id)
    {
        $data['id'] = $id;
        $this->dbmodel->dell_news($data);
        $this->dbmodel->dell_img($data);
        redirect('/admin/components/news/edit_news');
    }

    // удаление картинки
    public function action_dell_img($id)
    {
        $data['id'] = $id;
        $this->dbmodel->dell_img($data);
        redirect('/admin/components/news/edit_news');
    }

    // редактирование комментария
    public function action_edit_comment()
    {
        //конфикурация постраничного вывода
        $config['base_url'] = 'admin/components/news/edit_comment/';
        $config['per_page'] = '3'; 
        $data['rows'] = $this->dbmodel->get_num_comment();
        foreach ($data['rows'] as $item) {$config['total_rows'] = $item['num'];}

        //постраничный вывод
        $this->pagination->initialize($config); 
        $data['news_comments'] = $this->dbmodel->get_news_comments($config['per_page'], $this->uri->segment(5));

        $this->render('dashboard', array(
            'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
            'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
            'component_menu' => $this->component->get_navigation(),
            'component' => $this->load->view('component/news/edit_comment', $data, true)
        ));
    }

    // корректируем комментарий
    public function action_add_comment($id)
    {

        $this->load->helper('form');//подключаем хэлперр для form_open

            foreach ($this->dbmodel->redakt_comment($id) as $item) 
                {
                    $comment_id['body']  = $item['news_comment_text'];
                    $comment_id['id']  = $id;
                    $data['id'] = $id;
                }

        if($this->input->post('editor2'))
        {
            //добавляем в базу
            $data = array(
               'editor2' => $_POST["editor2"] ,
               'id' => $id 
            );

            $this->dbmodel->add_data_comment($data);

            // выводим сообщение
            $this->session->set_flashdata('success', 'Комментарий изменен');
            redirect('/admin/components/news');
        }

        $this->render('dashboard', array(
        'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
        'js' => $this->asset->js(array('jquery', 'uikit', 'moment', 'ckeditor/ckeditor')),
        'component_menu' => $this->component->get_navigation(),
        'component' => $this->load->view('component/news/add_comment', $comment_id, true)
        ));
    }

    // настраиваем базу данных
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

    //загружает картинку и возвращает путь с именем
    private function do_upload()
    {
            $type= explode('.', $_FILES["upload"]["name"]);
            $type=$type[count($type)-1];
            $uploaddir = 'assets/img/news/'; // это папка, в которую будет загружаться картинка
            $name=date('YmdHis').rand(100,1000).".".$type; // это имя, которое будет присвоенно изображению
            // $uploadfile = $uploaddir.$name;// в переменную $uploadfile будет входить папка и имя изображения
            $url=$uploaddir.$name;

            // echo "url:".$url."\n";
            $message='файл не картинка';
            if(in_array($type, array('jpeg','jpg','png','gif')))
            {
                $message='файл не загружен \n';
                // $message='ошибка: '. $_FILES['upload']['error'] ." \n";

                if(is_uploaded_file($_FILES['upload']["tmp_name"]))
                {
                    $message='файл не премещен';
                    if( move_uploaded_file ($_FILES["upload"]["tmp_name"], $url)) 
                        {
                            $message='файл загружен';
                            return $url;
                            break;
                        } 
                }
            }
            // echo $message;
            return "";
    }

}