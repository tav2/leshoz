<?php
class Api_users extends MY_Model {
    protected $_table = 'users';
    protected $_table_content = 'users_content';

    //функции вывода на виев
    function get_all_cart()
    {
        return $this->load->view('component/users/api/cart', array(
            'cart' => $this->get_cart(),
        ), true);
    }

    //выводим меню аккоунта(в подвале)
    function get_account_menu()
    {
        return $this->load->view('component/users/api/account', array(

        ), true);
    }

    // выводим данные вошедшего пользователя(в странице заказа)
    function get_customer_info()
    {
        $this->db->where('customer_email', $this->session->userdata('usermail'));
        $rez=$this->db->get('customer')->result_array();

        return $this->load->view('component/users/api/get_info', array(
            'customer' => $rez
        ), true);
    }

    // выводим форму для получения данных пользователя(в странице заказа)
    function take_customer_info()
    {
        return $this->load->view('component/users/api/take_info', array(

        ), true);
    }



    function get_tovar($customer_cart_id)
    {
        $this->db->select('*');
        $this->db->from('tovar');
        $this->db->join('customer_cart_product', 'tovar.tovar_id = customer_cart_product.customer_product_id');
        $this->db->where('customer_cart_product.customer_cart_id', $customer_cart_id);
        $items = $this->db->get();
        return $items->result_array();
    }

    function get_cart()
    {

        $this->db->where('customer_email', $this->session->userdata('usermail'));
        $rez = $this->db->get('customer');
        foreach ($rez->result_array() as $item) {$rez2 = $item['customer_id'] ;}

        $this->db->where('customer_id', $rez2);
        $rez = $this->db->get('customer_cart');
        if (isset($rez)) {
            $cart = $rez->result_array();
        }else $cart=array();
        return $cart;
    }

    //была тут----------------------------------------------
    public function api_get_content($id, $lang)
    {
        $query = $this->db->get_where($this->_table_users, array(
            'news_id' => $id,
            'news_lang' => $lang
        ));
        return $this->load->view('component/news/api/page', array(
            'page' => $query->row_array()
        ), true);
    }
}