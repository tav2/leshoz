<?php

/**
 * Класс для работы с командной строкой
 *
 * Class CLI_Controller
 */
class CLI_Controller extends CI_Controller {

    /**
     * Запрет на исполнение вне комендной строки
     */
    public function __construct()
    {
        parent::__construct();

        if( ! is_cli())
        {
            die('Only command line access');
        }
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