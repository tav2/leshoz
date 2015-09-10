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

        $this->load->model('cart');
        $this->load->library('session');
        $this->cart->check_cart();

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
        // подключаем модель для обрабоки переменных из бд используемых статично
        $this->load->model('Staticpage_model');
        // определяем число товаров в корзине
        $count = $this->cart->cart_get_num();
        foreach ($count as $item) {$num = $item['num'];}

        $this->controller = ($this->controller != '') ? '/'.strtolower($this->controller).'/' : '/';
        $this->load->view($this->theme.'/layouts/'.$this->layout, array(
            'content' => $this->load->view($this->theme.$this->controller.$view, $data, true),
            'about' => $this->Staticpage_model->get_zapis(5, 1),
            'time' => $this->Staticpage_model->get_zapis(5, 2),
            'kontakt' => $this->Staticpage_model->get_zapis(5, 3),
            'cart_count' => $num
        ));
    }

    /**
     * Исполнение кода до выполнения метода
     */
    public function before()
    {
        
    }

    /**
     * Исполнение кода после выполнения метода
     */
    public function after()
    {
        // Some code...
    }
}