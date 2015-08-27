<?php

class Install extends MY_Model {

    protected $_table_users = 'users';
    protected $_table_components = 'components';
    protected $_fields_users = array();
    protected $_fields_components = array();

    public function install($reinstall = false)
    {
        $this->load->dbforge();
        if($reinstall === true)
        {
            $this->dbforge->drop_table($this->_table_users);
            $this->dbforge->drop_table($this->_table_components);
        }



        // Таблица users
        $this->_fields_users = array(
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'user_password' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
            ),
        );

        $this->dbforge->add_field($this->_fields_users);
        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table($this->_table_users, true, array('ENGINE' => 'InnoDB'));

        // Таблица components
        $this->_fields_components = array(
            'component_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'component_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'component_version' => array(
                'type' => 'VARCHAR',
                'constraint' => '5',
            ),
        );

        $this->dbforge->add_field($this->_fields_components);
        $this->dbforge->add_key('component_id', TRUE);
        $this->dbforge->create_table($this->_table_components, true, array('ENGINE' => 'InnoDB'));

        // Создание админа
        $this->db->insert($this->_table_users, array(
            'user_name' => 'admin',
            'user_password' => password_hash('p@$$v0rd', PASSWORD_BCRYPT)
            )
        );
    }
}