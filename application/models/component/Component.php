<?php

class Component extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('directory');
        if(file_exists(APPPATH.'runtime/system/installed.lock'))
        {
            $this->load->dbforge();
        }
    }

    public function get_navigation()
    {
        $result = array();
        $directories = directory_map(APPPATH.'controllers/admin/components', TRUE);
        if($directories)
        {
            foreach ($directories as $directory) {
                $directory = trim($directory, DIRECTORY_SEPARATOR);
                if(is_dir(APPPATH.'controllers/admin/components/'.$directory))
                {
                    $this->lang->load('component/'.$directory.'/'.$directory);
                    $result[] = array(
                        'dir' => $directory,
                        'status' => $this->status($directory),
                        'name' => $this->lang->line('menu_title')
                    );
                }
            }
        } else {
            $result[] = array(
                'dir' => '',
                'status' => '2',
                'name' => 'Компонентов нет'
            );
        }

        return $result;
    }

    public function status($component)
    {
        return $this->db->get_where('components', array('component_name' => $component))->num_rows();
    }

    public function run($component, $action_or_data = '')
    {
        if($this->status($component) == 1)
        {
            return $this->load->view('component/'.$component.'/'.$component, $action_or_data, true);
        } else {
            if($action_or_data == 'setup')
            {
                $this->load->model('component/'.$component.'/setup', 'setup');
                $this->setup->install($component);
            } else {
                return $this->load->view('admin/layouts/component_install', array(
                    'component' => $component
                ), true);
            }
        }
    }
}