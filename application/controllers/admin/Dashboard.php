<?php

class Dashboard extends Admin_Controller {


    public function __construct()
    {
        parent::__construct();
    }

    public function action_index()
    {
        $this->render('dashboard', array(
            'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
            'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
            'component_menu' => $this->component->get_navigation(),
            'component' => ''
        ));
    }

    public function action_setting()
    {
        if($this->input->post('setting'))
        {
            if($this->input->post('password') == $this->input->post('password_again'))
            {
                $this->db->where('user_name', 'admin');
                $this->db->update('users', array('user_password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)));
                $this->session->set_flashdata('success', 'Пароль изменен');
                redirect('/admin/dashboard/setting');
            } else {
                $this->session->set_flashdata('success', 'Пароли не совпадают');
                redirect('/admin/dashboard/setting');
            }
        }

        $this->render('dashboard', array(
            'css' => $this->asset->css(array('uikit', 'style')),
            'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
            'component_menu' => $this->component->get_navigation(),
            'component' => $this->load->view('admin/setting', '', true)
        ));
    }
}