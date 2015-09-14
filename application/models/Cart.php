<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('string');
		$this->load->helper('cookie');
		$this->load->library('encrypt');
		$this->encrypt->set_cipher(MCRYPT_RC2);
	}

	public function check_cart()
	{
		if (is_null($this->input->cookie('cart_hash', true))) {
			$hash = random_string('alnum', 16);
			$this->input->set_cookie('cart_hash', $hash, 31536000);
			$this->db->insert('cart', array(
					'cart_hash' => $hash
				));
		}
	}

	public function add_to_cart($amount, $product_id)
	{
		$id = $this->db->get_where('cart', array('cart_hash' => $this->input->cookie('cart_hash', true)))->row_array();
		$this->db->insert('cart_product', array(
				'cart_id' => $id['cart_id'],
				'cart_product_amount' => $amount,
				'tovar_id' => $product_id
			));
	}

	public function get_cart_items()
	{
		$id = $this->db->get_where('cart', array('cart_hash' => $this->input->cookie('cart_hash', true)))->row_array();
		$this->db->select('*');
		$this->db->from('cart_product');
		$this->db->join('tovar', 'tovar.tovar_id = cart_product.tovar_id');
		$this->db->where('cart_product.cart_id', $id['cart_id']);
		$items = $this->db->get();
		return $items->result_array();
	}

	public function delete_cart_item($id)
	{
		$id_cart = $this->db->get_where(
			'cart',
			array('cart_hash' => $this->input->cookie('cart_hash', true)))
		->row_array();
		$this->db->delete('cart_product', array('cart_product_id' => $id, 'cart_id' => $id_cart['cart_id']));
	}

	//возвращаем число товаров в корзине
	public function cart_get_num()
	{
		$id_cart = $this->db->get_where(
			'cart',
			array('cart_hash' => $this->input->cookie('cart_hash', true)))
		->row_array();

		// $this->db->where('cart_id', $id_cart['cart_id']);
		$rez = $this->db->query("SELECT count(*) AS num FROM cart_product WHERE cart_id = '{$id_cart['cart_id']}'");
		return $rez->result_array();
		// $this->db->delete('cart_product', array('cart_product_id' => $id, 'cart_id' => $id_cart['cart_id']));
	}

	// //из таблицы товара берем поля по названию и id
	// public function tovar_get_pole($tovar_id, $pole_name='tovar_name')
	// {
	// 	$this->db->where('tovar_id', $tovar_id);
	// 	$rez=$this->db->get('tovar');
	// 	foreach ($rez->result_array() as $item) {$rez2 = $item[$pole_name] ;}
	// 	return $rez2;
	// }

	public function confirtm_order()
	{
		//если пользовательль вошел
		if($this->session->userdata('logged_in'))
		{
			// берем данные пользователя из базы
			$customer_info = $this->users_api->get_customer_info();
			foreach($customer_info as $item)
			{
				$customer_name = $item['customer_name'];
				$customer_email = $item['customer_email'];
				$customer_contact = $item['customer_contact'];
				$customer_id = $item['customer_id'];
			}
		}
		else
		{
			// берем данные пользователя из формы
			$customer_name = $this->input->post('cfname', true);
			$customer_email = $this->input->post('cfemail', true);
			$customer_contact = $this->input->post('cfcontact', true);
			$customer_password = rand(10000,99999);

			//создаем нового пользователя
			// подключаем модель 
			$this->load->model('Reg_model');
			// добавляем в базу нового пользователя
			$this->reg_model->reg_create($customer_email, $customer_name, $customer_password, $customer_contact);
			//берем его ид
			$customer_id = $this->reg_model->get_customer_id($customer_email);
		}

		$id = $this->db->get_where('cart', array('cart_hash' => $this->input->cookie('cart_hash', true)))->row_array();
		$this->db->select('*');
		$this->db->from('cart_product');
		$this->db->join('tovar', 'tovar.tovar_id = cart_product.cart_product_id');
		$this->db->where('cart_product.cart_id', $id['cart_id']);
		$items = $this->db->get()->result_array();

		$sum = 0;
		$result = '';
		foreach ($items as $item) {
			$price = preg_replace('~\D+~','', $item['tovar_prise'])*$item['cart_product_amount'];
			$sum = $sum+$price;
			$result .= 'Продукция: '.$item['tovar_name'].$item['tovar_razmer'].'<br>Цена:'.$item['tovar_prise'].'<br>Количество: '.$item['cart_product_amount'].'<br>Сумма: '.number_format($price, 0, '', ' ').' тенге<hr style="width: 150px">';
		}

		$this->load->library('email');

		$config['mailtype'] = 'html';

		$this->email->initialize($config);

		$this->email->from('noreply@leshoz.kz', 'Компания leshoz, online заказ');
		$this->email->to('info@leshoz.kz');
		$this->email->reply_to($this->input->post('cfemail', true));

		$this->email->subject('Заказ с сайта www.leshoz.kz');
		$this->email->message(
				'<strong>Заказ с сайта</strong><br>'.
				'Имя: '.$customer_name.'<br>'.
				'E-mail: '.$customer_email.'<br>'.
				'Сообщение: '.$customer_contact.'<br>'.
				'Товар: '.$result.'<br>'

			);

		$this->email->send();

		// echo $this->email->print_debugger();

		//записываем в базу покупателя данные о покупке и чистим базу корзины

		// создаем запись в таблице customer_cart
		$this->load->helper('date');
		date_default_timezone_set('Asia/Almaty');
		$datestring = '%Y:%m:%d';

		$data['customer_cart_date'] = mdate($datestring);
		$data['customer_cart_paid'] = 0;
		$data['customer_id'] = $customer_id;
		
		$this->db->insert('customer_cart', $data);

		// копируем записи из таблицы в customer_cart_product
		$sql = "INSERT INTO customer_cart_product (customer_product_amount, customer_product_id) SELECT cart_product.* FROM cart_product WHERE cart_id = '{$id['cart_id']}'";
		$this->db->query($sql);
		// создаем запись в таблице customer_cart
		$data = array(
				'title' => $title,
				'name' => $name,
				'date' => $date
			);

		$this->db->where('id', $id);
		$this->db->update('mytable', $data); 

	}
}
