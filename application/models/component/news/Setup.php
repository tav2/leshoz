<?php
class Setup extends CI_Model {
    protected $_table_1 = 'news';//таблицановостей
    protected $_table_2 = 'news_comments';//комментарии к новостям
    protected $_table_3 = 'ips';//просмотры новостей
    protected $_table_4 = 'img';//дополнительные изображения
    protected $_fields_1 = array();
    protected $_fields_2 = array();
    protected $_fields_3 = array();
    protected $_fields_4 = array();
    protected $version = '1.0.0';

    public function install($component, $reinstall = false)
    {
        if($reinstall === true)
        {
            $this->dbforge->drop_table($this->_table_1);
            $this->dbforge->drop_table($this->_table_2);
            $this->dbforge->drop_table($this->_table_3);
            $this->dbforge->drop_table($this->_table_4);
        }
        $this->_fields_1 = array(
            'news_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'news_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            ),
            'news_text' => array(
                'type' => 'text',
            ),
            'news_date' => array(
                'type' => 'date',
            ),
            'news_lang' => array(
                'type' => 'VARCHAR',
                'constraint' => '2',
            ),
            'news_type' => array(
                'type' => 'INT',
                'constraint' => '3',
                'unsigned' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            )
        );
        $this->dbforge->add_field($this->_fields_1);
        $this->dbforge->add_key('news_id', TRUE);
        $this->dbforge->create_table($this->_table_1, true, array('ENGINE' => 'InnoDB'));

        $this->_fields_2 = array(
            'news_comment_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'news_comment_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            ),
            'news_comment_text' => array(
                'type' => 'text',
            ),
            'news_comment_date' => array(
                'type' => 'date',
            ),
            'news_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            )
        );
        $this->dbforge->add_field($this->_fields_2);
        $this->dbforge->add_key('news_comment_id', TRUE);
        $this->dbforge->create_table($this->_table_2, true, array('ENGINE' => 'InnoDB'));

        $this->_fields_3 = array(
            'news_ips_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'ip_adres' => array(
                'type' => 'VARCHAR',
                'constraint' => 32
            ),
            'ips_date' => array(
                'type' => 'date',
            ),
            'news_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            ),

        );
        $this->dbforge->add_field($this->_fields_3);
        $this->dbforge->add_key('news_ips_id', TRUE);
        $this->dbforge->create_table($this->_table_3, true, array('ENGINE' => 'InnoDB'));

        $this->_fields_4 = array(
            'img_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'img_adres' => array(
                'type' => 'VARCHAR',
                'constraint' => 64
            ),
            'news_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            ),

        );
        $this->dbforge->add_field($this->_fields_4);
        $this->dbforge->add_key('img_id', TRUE);
        $this->dbforge->create_table($this->_table_4, true, array('ENGINE' => 'InnoDB'));

        $this->db->insert('components', array('component_name' => $component, 'component_version' => $this->version));
    }
}