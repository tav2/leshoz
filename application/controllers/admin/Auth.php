<?php

class Auth extends Admin_Controller {

    protected $theme = 'admin';
    protected $layout = 'layout_auth';

    public function action_index()
    {
        $this->render('auth', array(
            'css' => $this->asset->css(array('uikit', 'style')),
            'js' => $this->asset->js(array(''))
        ));
    }

    public function action_login()
    {
        if( ! $this->user->login())
        {
            $this->session->set_flashdata('auth_error', 'Логин или пароль введены не верно');
            redirect('admin/auth');
        }

        redirect('admin');
    }

    public function action_logout()
    {
        $this->user->logout();
        redirect('admin');
    }
}