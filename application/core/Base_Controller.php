<?php

/**
 * Расширение системного контроллера
 * Class MY_Controller
 */
class Base_Controller extends CI_Controller {

    protected $layout = 'layout';
    protected $theme = 'default';
    protected $controller = '';

    /**
     * наследование базового конструктора
     * подключение к БД
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('language', 'url'));

        if($this->uri->total_segments() == 0 AND $this->config->item('multi_language_enable') === TRUE)
        {
            redirect(array_search($this->config->item('language'), $this->config->item('multi_language')));
        }
    }

    /**
     * Подгрузка вьюшек в шаблон
     *
     * @param $view
     * @param array $data
     */
    public function render($view, $data = array())
    {
        $this->controller = ($this->controller != '') ? '/'.strtolower($this->controller).'/' : '/';
        $this->load->view($this->theme.'/layouts/'.$this->layout, array(
            'content' => $this->load->view($this->theme.$this->controller.$view, $data, true)
        ));
    }

    /**
     * Исполнение кода до выполнения метода
     */
    public function before()
    {
        // Some code...
    }

    /**
     * Исполнение кода после выполнения метода
     */
    public function after()
    {
        // Some code...
    }
}