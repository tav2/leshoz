<?php
class Setup extends CI_Model {
    protected $_table_customer = 'customer';//таблица зарегестрированных пользователей сайта
    protected $_table_customer_cart = 'customer_cart';//таблица покупок пользователя
    protected $_table_customer_cart_product = 'customer_cart_product';//таблица товаров в покупке


    protected $_fields_customer = array();
    protected $_fields_customer_cart = array();
    protected $_fields_customer_cart_product = array();

    protected $version = '1.0.0';

    public function install($component, $reinstall = false)
    {
        if($reinstall === true)
        {
            $this->dbforge->drop_table($this->_table_customer);
            $this->dbforge->drop_table($this->_table_customer_cart);
            $this->dbforge->drop_table($this->_table_customer_cart_product);
        }

        // таблица зарегестрированных пользователей сайта
        $this->_fields_customer = array(
            'customer_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'customer_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            ),
            'customer_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            ),
            'customer_email_check' => array(
                'type' => 'BOOLEAN',
            ),
            'customer_password' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            ),
            //дата создания пользователя
            'customer_date' => array( 
                'type' => 'date',
            )
        );
        $this->dbforge->add_field($this->_fields_customer);
        $this->dbforge->add_key('customer_id', TRUE);
        $this->dbforge->create_table($this->_table_customer, true, array('ENGINE' => 'InnoDB'));

        // таблица покупок пользователя
        $this->_fields_customer_cart = array(
            'customer_cart_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'customer_cart_date' => array(
                'type' => 'date'
            ),
            'customer_cart_paid' => array(
                'type' => 'BOOLEAN',
            ),
            'customer_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
            )
        );
        $this->dbforge->add_field($this->_fields_customer_cart);
        $this->dbforge->add_key('customer_cart_id', TRUE);
        $this->dbforge->create_table($this->_table_customer_cart, true, array('ENGINE' => 'InnoDB'));

        // таблица товаров в покупке
        $this->_fields_customer_cart_product = array(
            'customer_cart_product_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'customer_cart_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
            ),
            'customer_product_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
            )
        );
        $this->dbforge->add_field($this->_fields_customer_cart_product);
        $this->dbforge->add_key('customer_cart_product_id', TRUE);
        $this->dbforge->create_table($this->_table_customer_cart_product, true, array('ENGINE' => 'InnoDB'));

        $this->db->insert('components', array('component_name' => $component, 'component_version' => $this->version));
    }
}