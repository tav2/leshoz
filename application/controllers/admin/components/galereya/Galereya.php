<?php

class Galereya extends Admin_Controller {

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

	// редактирование галереи
	public function action_edit_galereya()
	{
		// выводим меню из селекторов
		$data['all_galereya_menu_select'] = $this->dbmodel->get_all_galereya_menu();
		$data['galereya_menu'] = array();
		$data['galereya_img'] = array();

		// если выбрали из меню галереи
		if($this->input->post('edit_galereya_menu_select'))
		{
			$data['galereya_menu'] = $this->dbmodel->get_galereya_menu($this->input->post('edit_galereya_menu_select'));
			$data['galereya_img'] = $this->dbmodel->get_galereya_img($this->input->post('edit_galereya_menu_select'));
			// $data['tovar_img'] = $this->dbmodel->get_tovar_img($this->input->post('tovar_select'));
		}


		// выводим галерею

		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->load->view('component/galereya/edit_galereya', $data, true)
		));
	}

	// добавление меню
	public function action_add_galereya_menu($id='')
	{

		// если нажали добавить
		if($this->input->post('galereya_menu_name'))
		{
			//добавляем в базу
			$data = array(
				'galereya_menu_name' => $this->input->post('galereya_menu_name'),
				'galereya_menu_date' => $this->input->post('galereya_menu_date'),
				'galereya_menu_text' => $this->input->post('galereya_menu_text')
			);

			$this->dbmodel->add_data_galereya_menu($data, $id);

			// выводим сообщение
			$this->session->set_flashdata('success', 'Менюшка добавлена');
			redirect('/admin/components/galereya/edit_galereya');
		}

		// если редактируем
		if ($id)
		{
			foreach ($this->dbmodel->get_galereya_menu($id) as $item)
			{
				$galereya_red['galereya_menu_name'] = $item['galereya_menu_name'];
				$galereya_red['galereya_menu_date'] = $item['galereya_menu_date'];
				$galereya_red['galereya_menu_ext'] = $item['galereya_menu_text'];
			}
		}
		else
		{
			$galereya_red['galereya_menu_name'] = '';
			$galereya_red['galereya_menu_date'] = '';
			$galereya_red['galereya_menu_text'] = '';
		}

		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->load->view('component/galereya/add_galereya_menu', array(
				'galereya_red' => $galereya_red
			), true)
		));
	}

	// добавление изображений для галереи
	public function action_add_galereya_img($id)
	{
			// создаем папку assets/img/galereya/'.$id.'/ если ее нет
			$pass = 'assets/img/galereya/'.$id.'/';

			if (!is_dir($pass)) {
				mkdir($pass, 0700, true);
			}
			// конфигурируем загрузчик картинок
			$config['upload_path'] = $pass; // путь к папке куда будем сохранять изображение
			$config['allowed_types'] = 'gif|jpg|png'; // разрешенные форматы файлов
			$config['max_size']	= 10000000; // максимальный вес файла
			$config['encrypt_name'] = TRUE; // переименование файла в уникальное название
			$config['remove_spaces'] = TRUE; // убирает пробелы из названия файлов

			$this->load->library('upload', $config); // загружаем библиотеку

			if ( ! $this->upload->do_upload('userfile'))
			{
				$this->session->set_flashdata('success',  $this->upload->display_errors());
				// redirect('/admin/components/galereya/edit_galereya');
			} 
			else 
			{
				/* Начало занесения имени файла в БД*/
				$upload_data = $this->upload->data(); // получаем информацию о загруженном файле
				$add['galereya_img_adres'] = $config['upload_path'].$upload_data['file_name']; // сохраняем имя файла в элемент массива add
				$add['galereya_menu_id'] = $id; // сохраняем айди галереи в элемент массива add
				$this->db->insert('galereya_img',$add); // заносим это значение в таблицу tovar_img
				/* Конец занесения имени файла в БД*/

				// выводим сообщение
				$this->session->set_flashdata('success', 'Изображение добавлено');
				// redirect('/admin/components/galereya/edit_galereya');
			}

			$this->render('dashboard', array(
				'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
				'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
				'component_menu' => $this->component->get_navigation(),
				'component' => $this->load->view('component/galereya/add_galereya_img', array(
					'id' => $id
				), true)
			));
	}

	// удаление меюшки галереи
	public function action_delete_galereya_menu($id)
	{
		$this->dbmodel->delete_galereya_menu($id);//почистили таблицу галереи
		$this->dbmodel->delete_galereya_img_menu($id);//почистили таблицу картинок галереи
		$this->dbmodel->delete_all_galereya_img($id);//почистили изображения с сервера
		$this->session->set_flashdata('success', 'Меню галереи удалено');
		redirect('/admin/components/galereya/edit_galereya');
	}

	// удаление одного фото меюшки галереи
	public function action_delete_galereya_img($id)
	{
		$this->dbmodel->delete_galereya_img($id);//почистили изображение с сервера
		$this->dbmodel->delete_galereya_img_menu($id);//почистили таблицу картинок галереи
		$this->session->set_flashdata('success', 'Изображение удалено');
		redirect('/admin/components/galereya/edit_galereya');
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