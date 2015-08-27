<?php
class Setup extends CI_Model {
    protected $_table_tovar = 'tovar';//таблица товаров
    protected $_table_tovar_category = 'tovar_category';//категории товаров (товар, проекты)
    protected $_table_tovar_sub_category = 'tovar_sub_category';//подкатегории товаров (дома, бани, погонаж, проекты готовые и пр)
    protected $_table_tovar_img = 'tovar_img';// изображения товаров
    protected $_table_tovar_material = 'tovar_material';// материал товаров
    protected $_table_tovar_color = 'tovar_color';// цвет товаров
    protected $_table_tovar_otziv = 'tovar_otziv';// отзывы о товаре

    protected $_fields_tovar = array();
    protected $_fields_tovar_category = array();
    protected $_fields_tovar_sub_category = array();
    protected $_fields_tovar_img = array();
    protected $_fields_tovar_material = array();
    protected $_fields_tovar_color = array();
    protected $_fields_tovar_otziv = array();
    protected $version = '1.0.0';

    public function install($component, $reinstall = false)
    {
        if($reinstall === true)
        {
            $this->dbforge->drop_table($this->_table_tovar);
            $this->dbforge->drop_table($this->_table_tovar_category);
            $this->dbforge->drop_table($this->_table_tovar_sub_category);
            $this->dbforge->drop_table($this->_table_tovar_img);
            $this->dbforge->drop_table($this->_table_tovar_material);
            $this->dbforge->drop_table($this->_table_tovar_color);
            $this->dbforge->drop_table($this->_table_tovar_otziv);
        }

        // таблиц товаров
        $this->_fields_tovar = array(
            // айди
            'tovar_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            // название
            'tovar_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            ),
            // цена
            'tovar_prise' => array(
                'type' => 'INT',
                'constraint' => 8,
                'unsigned' => TRUE
            ),
            // скидка
            'tovar_skidka' => array(
                'type' => 'INT',
                'constraint' => 3,
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            // описание
            'tovar_text' => array(
                'type' => 'text'
            ),
            // рейтинг
            'tovar_reit' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            ),
            // размеры
            'tovar_razmer' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            ),
            // другая информация
            'tovar_uther' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            ),
            // ссылка на сабкатегорию
                'tovar_sub_category_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            ),
            // ссылка на материал
                'tovar_material_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            ),
            // ссылка на цвета
                'tovar_color_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            )
        );
        $this->dbforge->add_field($this->_fields_tovar);
        $this->dbforge->add_key('tovar_id', TRUE);
        $this->dbforge->create_table($this->_table_tovar, true, array('ENGINE' => 'InnoDB'));

        // таблица категорий
        $this->_fields_tovar_category = array(
            'tovar_category_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'tovar_category_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            )
        );
        $this->dbforge->add_field($this->_fields_tovar_category);
        $this->dbforge->add_key('tovar_category_id', TRUE);
        $this->dbforge->create_table($this->_table_tovar_category, true, array('ENGINE' => 'InnoDB'));

        // таблица подкатегорий
        $this->_fields_tovar_sub_category = array(
            'tovar_sub_category_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'tovar_sub_category_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 32
            ),
            'tovar_category_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            )
        );
        $this->dbforge->add_field($this->_fields_tovar_sub_category);
        $this->dbforge->add_key('tovar_sub_category_id', TRUE);
        $this->dbforge->create_table($this->_table_tovar_sub_category, true, array('ENGINE' => 'InnoDB'));

        // картинки товаров
        $this->_fields_tovar_img = array(
            'tovar_img_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'tovar_img_adres' => array(
                'type' => 'VARCHAR',
                'constraint' => 64
            ),
            'tovar_img_type' => array(
                'type' => 'INT',
                'constraint' => '3',
                'unsigned' => TRUE
            ),
            'tovar_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            )
        );
        $this->dbforge->add_field($this->_fields_tovar_img);
        $this->dbforge->add_key('tovar_img_id', TRUE);
        $this->dbforge->create_table($this->_table_tovar_img, true, array('ENGINE' => 'InnoDB'));

        // таблица материалов
        $this->_fields_tovar_material = array(
            'tovar_material_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'tovar_material_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 32
            )
        );
        $this->dbforge->add_field($this->_fields_tovar_material);
        $this->dbforge->add_key('tovar_material_id', TRUE);
        $this->dbforge->create_table($this->_table_tovar_material, true, array('ENGINE' => 'InnoDB'));

        // таблица расцветок
        $this->_fields_tovar_color = array(
            'tovar_color_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'tovar_color_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 32
            )
        );
        $this->dbforge->add_field($this->_fields_tovar_color);
        $this->dbforge->add_key('tovar_color_id', TRUE);
        $this->dbforge->create_table($this->_table_tovar_color, true, array('ENGINE' => 'InnoDB'));

        // таблица отзывов о товаре
        $this->_fields_tovar_otziv = array(
            'tovar_otziv_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'tovar_otziv_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 32
            ),
            'tovar_otziv_text' => array(
                'type' => 'text'
            ),
            'tovar_otziv_reit' => array(
                'type' => 'INT',
                'constraint' => '3',
                'unsigned' => TRUE
            ),
            'tovar_id' => array(
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
        $this->dbforge->add_field($this->_fields_tovar_otziv);
        $this->dbforge->add_key('tovar_otziv_id', TRUE);
        $this->dbforge->create_table($this->_table_tovar_otziv, true, array('ENGINE' => 'InnoDB'));

        $this->db->insert('components', array('component_name' => $component, 'component_version' => $this->version));
    }
}