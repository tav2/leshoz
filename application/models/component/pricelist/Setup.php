<?php

class Setup extends CI_Model {

    protected $_table_blank = 'pricelist';
    protected $_fields = '';
    protected $version = '1.0.0';

    public function install($component, $reinstall = false)
    {
        if($reinstall === true)
        {
            $this->dbforge->drop_table($this->_table_blank);
        }

        $this->_fields = array(
            'pricelist_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'pricelist_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'pricelist_file' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
        );
        
        $this->dbforge->add_field($this->_fields);
        $this->dbforge->add_key('pricelist_id', TRUE);
        $this->dbforge->create_table($this->_table_blank, true, array('ENGINE' => 'InnoDB'));

        $this->db->insert('components', array('component_name' => $component, 'component_version' => $this->version));
    }
}
