<?php

class Pricelist extends Admin_Controller {

    public function before()
    {
        $this->load->model('component/'.strtolower(__CLASS__).'/database', 'dbmodel');
    }

    public function action_index()
    {
        $this->render('dashboard', array(
            'css' => $this->asset->css(array('uikit', 'style')),
            'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
            'component_menu' => $this->component->get_navigation(),
            'component' => $this->component->run(strtolower(__CLASS__), array(
                'prices' => $this->dbmodel->get_pages()
            ))
        ));
    }

    public function action_get_price($download, $value = '')
    {
        if(file_exists(FCPATH.'upload/prices/' . $download))
        {
            header('Content-type: application/pdf');
            header('Content-Disposition: attachment; filename="price_vels_company_'.date('Y_m_d').'_'.$download.'"');
            readfile(FCPATH.'upload/prices/' . $download);
            redirect('/admin/components/pricelist');
        }
        // } else if($value == 'send' && $download !== null) {

        //     $this->load->library('form_validation');

        //     $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        //     if ($this->form_validation->run() == FALSE)
        //     {
        //         $error['error'] = validation_errors();
        //         echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=/cost">';
        //     } else {
        //         $this->load->library('email');
        //         $config['mailtype'] = 'html';

        //         $this->email->initialize($config);
        //         $this->email->from('noreply@intelties.com', 'Юридические и правовые услуги www.intelties.com');
        //         $this->email->to($this->input->post('email', true));

        //         $this->email->subject($this->input->post('title', true));
        //         $this->email->message('Вам был отправлен прайс лист с сайта <a href="http://www.intelties.com">www.intelties.com</a>.<br>Пожалуйста не отвечайте на данное письмо!');
        //         $this->email->attach('download/' . $price_id . '.pdf');

        //         $this->email->send();

        //         $error['error'] = 'Сообщение успешно отправлено!';
        //     }
    }

    public function action_add_price($action = '')
    {
        if ($action != '')
        {
            switch ($action)
            {
                case 'create':

                    $this->load->library('upload');

                    // создаем папку './upload/prices' если ее нет
                    $pass = './upload/prices';

                    if (!is_dir($pass)) {
                        mkdir($pass, 0700, true);
                    }

                    $this->load->helper('string');
                    $config['upload_path']          = './upload/prices';
                    $config['allowed_types']        = 'pdf';
                    $config['encrypt_name']            = true;
                    $config['file_ext_tolower']            = true;
                    $this->upload->initialize($config);
                    $this->upload->do_multi_upload('item_file');
                    $files = $this->upload->get_multi_upload_data();
                    $this->dbmodel->create_price($files[0]['file_name']);
                    $this->session->set_flashdata('success', 'Прайс лист добавлен');
                    redirect('admin/components/pricelist');
                    break;
            }
        }
        $this->render('dashboard', array(
            'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
            'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
            'component_menu' => $this->component->get_navigation(),
            'component' => $this->load->view('component/pricelist/add_price', array(

            ), true)
        ));
    }

    public function action_price_edit($id, $action = '')
    {
        if ($action != '')
        {
            switch ($action)
            {
                case 'delete':
                    $this->dbmodel->price_delete($id);
                    $this->session->set_flashdata('status', 'Прайс успешно удален');
                    redirect('/admin/components/pricelist/');
                    break;
            }
        }
        redirect('admin/components/'.strtolower(__CLASS__));
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