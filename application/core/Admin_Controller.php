<?php

/**
 * Class Admin_Controller
 */
class Admin_Controller extends Base_Controller {

    protected $theme = 'admin';
    /**
     *
     */
    public function __construct()
    {
        parent::__construct();

        if( ! file_exists(APPPATH.'runtime/system/installed.lock'))
        {
            redirect('eidos/setup');
        }
        $this->config->set_item('language', 'russian');
        $this->load->model('component/component');
        $this->lang->load('backend/global');
        $this->load->library(array('asset', 'session', 'user'));
        $this->load->helper('url');
        $this->asset->asset_path('assets/admin');

        // Проверка авторизован ли пользователь
        if( ! $this->user->check() AND $this->uri->segment(2) != 'auth')
        {
            redirect('admin/auth');
        }
    }

    /**
     * Исполнение кода до выполнения метода
     */
    public function before()
    {
        parent::before();
    }

    /**
     * Исполнение кода после выполнения метода
     */
    public function after()
    {
        parent::after();
    }

}