<?php

class Setup extends Base_Controller {

    protected $theme = 'setup';
    protected $controller = __CLASS__;
    protected $type = 'development';

    public function before()
    {
        if(file_exists(APPPATH.'runtime/system/installed.lock'))
        {
            die('Site installed');
        }
    }

    public function action_index()
    {
        $this->render('index');
    }

    public function action_production()
    {
        $this->render('index');
    }

    public function action_step($step = 1)
    {
        switch ($step) {
            case 1:
                $dsn = 'mysqli://'.$this->input->post('user').':'.$this->input->post('pass').'@localhost/'.$this->input->post('db');
                $this->load->database($dsn);

                $this->load->model('install');
                $this->install->install();
                $this->render('step1', array(
                    'user' => $this->input->post('user'),
                    'pass' => $this->input->post('pass'),
                    'db' => $this->input->post('db'),
                ));
                break;

            case 2:
                $file = file(APPPATH.'config/'.$this->type.'/database.php');
                $row = null;
                foreach ($file as $string) {
                    if(preg_match('/\'username\'\s+=>\s+\'(.*)\'/', $string))
                    {
                        $string = preg_replace('/\'username\'\s+=>\s+\'(.*)\'/', '\'username\' => \''.$this->input->post('user').'\'', $string);
                    }
                    if(preg_match('/\'password\'\s+=>\s+\'(.*)\'/', $string))
                    {
                        $string = preg_replace('/\'password\'\s+=>\s+\'(.*)\'/', '\'password\' => \''.$this->input->post('pass').'\'', $string);
                    }
                    if(preg_match('/\'database\'\s+=>\s+\'(.*)\'/', $string))
                    {
                        $string = preg_replace('/\'database\'\s+=>\s+\'(.*)\'/', '\'database\' => \''.$this->input->post('db').'\'', $string);
                    }
                    $row .= $string;
                }
                $fp = fopen(APPPATH.'config/'.$this->type.'/database.php', 'w');
                fwrite($fp, $row);
                fclose($fp);
                $this->render('step2');
                break;

            case 3:
                $this->load->helper('string');
                $file = file(APPPATH.'config/'.$this->type.'/config.php');
                $row = null;
                foreach ($file as $string) {
                    if(preg_match('/\$config\[\'base_url\'\]\s+=\s+\'(.*)\'/', $string))
                    {
                        $string = preg_replace('/\$config\[\'base_url\'\]\s+=\s+\'(.*)\'/', '$config[\'base_url\'] = \'http://'.$_SERVER['SERVER_NAME'].'/\'', $string);
                    }
                    if(preg_match('/\$config\[\'index_page\'\]\s+=\s+\'(.*)\'/', $string))
                    {
                        $string = preg_replace('/\$config\[\'index_page\'\]\s+=\s+\'(.*)\'/', '$config[\'index_page\'] = \'\'', $string);
                    }
                    if(preg_match('/\$config\[\'encryption_key\'\]\s+=\s+\'(.*)\'/', $string))
                    {
                        $string = preg_replace('/\$config\[\'encryption_key\'\]\s+=\s+\'(.*)\'/', '$config[\'encryption_key\'] = \''.random_string('alnum', 64).'\'', $string);
                    }
                    $row .= $string;
                }
                $fp = fopen(APPPATH.'config/'.$this->type.'/config.php', 'w');
                fwrite($fp, $row);
                fclose($fp);
                $lock_file = fopen(APPPATH.'runtime'.DIRECTORY_SEPARATOR.'system'.DIRECTORY_SEPARATOR.'installed.lock', 'w');
                fwrite($lock_file, time());
                fclose($lock_file);
                $this->render('step3');
                break;
        }
    }
}