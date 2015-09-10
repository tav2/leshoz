<?php
class Setup extends CI_Model {
    protected $_table_galereya_menu = 'galereya_menu';//таблица меню галереи
    protected $_table_galereya_img = 'galereya_img';//таблица изображений галереи


    protected $_fields_galereya_menu = array();
    protected $_fields_galereya_img = array();

    protected $version = '1.0.0';

    public function install($component, $reinstall = false)
    {
        if($reinstall === true)
        {
            $this->dbforge->drop_table($this->_table_galereya_menu);
            $this->dbforge->drop_table($this->_table_galereya_img);
        }

        // таблица меню галереи
        $this->_fields_galereya_menu = array(
            'galereya_menu_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'galereya_menu_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            ),
            'galereya_menu_text' => array(
                'type' => 'VARCHAR',
                'constraint' => '256'
            ),
            'galereya_menu_date' => array(
                'type' => 'date',
            )
        );
        $this->dbforge->add_field($this->_fields_galereya_menu);
        $this->dbforge->add_key('galereya_menu_id', TRUE);
        $this->dbforge->create_table($this->_table_galereya_menu, true, array('ENGINE' => 'InnoDB'));

        // таблица изображений галереи
        $this->_fields_galereya_img = array(
            'galereya_img_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'galereya_img_adres' => array(
                'type' => 'VARCHAR',
                'constraint' => 64
            ),
            'galereya_menu_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            )
        );
        $this->dbforge->add_field($this->_fields_galereya_img);
        $this->dbforge->add_key('galereya_img_id', TRUE);
        $this->dbforge->create_table($this->_table_galereya_img, true, array('ENGINE' => 'InnoDB'));

        $this->db->insert('components', array('component_name' => $component, 'component_version' => $this->version));
    }
}