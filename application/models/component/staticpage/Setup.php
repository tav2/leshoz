<?php
class Setup extends MY_Model {
    protected $_table_1 = 'staticpage';
    protected $_table_2 = 'staticpage_content';
    protected $_table_3 = 'staticpage_file';
    protected $_fields_1 = array();
    protected $_fields_2 = array();
    protected $_fields_3 = array();
    protected $version = '1.0.0';
    public function install($component, $reinstall = false)
    {
        if($reinstall === true)
        {
            $this->dbforge->drop_table($this->_table_1);
            $this->dbforge->drop_table($this->_table_2);
            $this->dbforge->drop_table($this->_table_3);
        }
        $this->_fields_1 = array(
            'staticpage_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'staticpage_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
        );
        $this->dbforge->add_field($this->_fields_1);
        $this->dbforge->add_key('staticpage_id', TRUE);
        $this->dbforge->create_table($this->_table_1, true, array('ENGINE' => 'InnoDB'));
		$this->_fields_2 = array(
            'staticpage_content_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
			'staticpage_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            ),
            'staticpage_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
			'staticpage_text' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
			'staticpage_lang' => array(
                'type' => 'VARCHAR',
                'constraint' => '2',
            ),
        );
        $this->dbforge->add_field($this->_fields_2);
        $this->dbforge->add_key('staticpage_content_id', TRUE);
        $this->dbforge->create_table($this->_table_2, true, array('ENGINE' => 'InnoDB'));

        // файлы страниц - картинки, прайсы и пр
        $this->_fields_3 = array(
            'staticpage_file_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'staticpage_file_adres' => array(
                'type' => 'VARCHAR',
                'constraint' => 128
            ),
            'staticpage_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            )
        );
        $this->dbforge->add_field($this->_fields_3);
        $this->dbforge->add_key('staticpage_file_id', TRUE);
        $this->dbforge->create_table($this->_table_3, true, array('ENGINE' => 'InnoDB'));

        $this->db->insert('components', array('component_name' => $component, 'component_version' => $this->version));
    }
}