<?php

class Users extends Admin_Controller {

	public function before()
	{
		$this->load->model('component/'.strtolower(__CLASS__).'/database', 'dbmodel');
		// $this->load->helper(array('form', 'url'));
	}

	
	public function action_index()
	{
		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->component->run(strtolower(__CLASS__), array(
				'pages' => $this->dbmodel->get_pages()
			))
		));
	}

	// редактирование зарегестрированных пользователей
	public function action_edit_customer()
	{
		// выводим меню из селекторов
		$data['all_customer_menu_select'] = $this->dbmodel->get_all_customer_menu();
		$data['customer'] = array();
		$data['customer_cart_menu_select'] = array();
		$data['customer_cart_product'] = array();

		// если выбрали из пользователей
		if($this->input->post('edit_customer_menu_select'))
		{
			$data['customer'] = $this->dbmodel->get_customer($this->input->post('edit_customer_menu_select'));
			$data['customer_cart_menu_select'] = $this->dbmodel->get_customer_cart($this->input->post('edit_customer_menu_select'));
		}
		// если выбрали корзину пользователя
		if($this->input->post('cart_customer_menu_select'))
		{
			$data['customer_cart_product'] = $this->dbmodel->get_customer_cart_product($this->input->post('cart_customer_menu_select'));
		}
		// выводим редактор пользователей
		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->load->view('component/users/edit_customer', $data, true)
		));
	}

	// удаление пользоватея
	public function action_delete_customer($customer_id)
	{
		$this->dbmodel->delete_customer($customer_id);//почистили таблицу пользоватея
		$this->session->set_flashdata('success', 'Пользователь удален');
		redirect('/admin/components/users/edit_customer');
	}

	// настраиваем базу данных
	public function action_setup()
	{
		if($this->component->status(strtolower(__CLASS__)) != 1)
		{
			$this->render('dashboard', array(
				'css' => $this->asset->css(array('uikit', 'style')),
				'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
				'component_menu' => $this->component->get_navigation(),
				'component' => $this->component->run(strtolower(__CLASS__), 'setup')
			));
		}
		redirect('admin/components/'.strtolower(__CLASS__));
	}

}