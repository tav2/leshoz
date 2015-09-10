<?php

class Tovar extends Admin_Controller {

	public function before()
	{
		$this->load->model('component/'.strtolower(__CLASS__).'/database', 'dbmodel');
		// $this->load->helper(array('form', 'url'));
		// $this->load->library('pagination');
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

	// удаление товара
	public function action_dell_tovar($id)
	{
		// $data['id'] = $id;
		$this->dbmodel->dell_tovar($id);
		$this->dbmodel->dell_all_img($id);
		$this->session->set_flashdata('success', 'Товар удален');
		redirect('/admin/components/tovar/edit_tovar');
	}

	// удаление изображения
	public function action_dell_img($id)
	{
		$this->dbmodel->dell_img($id);

		$this->session->set_flashdata('success', 'Изображение удалено');
		redirect('/admin/components/tovar/edit_tovar');
	}

	// удаление изображения подкатегории
	public function action_delete_sub_category_img($id)
	{
		$this->dbmodel->delete_sub_category_img($id);

		$this->session->set_flashdata('success', 'Изображение удалено');
		redirect('/admin/components/tovar/edit_sub_category');
	}

	// удаление подкатегории
	public function action_delete_sub_category($id)
	{
		$this->dbmodel->delete_sub_category($id);

		$this->session->set_flashdata('success', 'Подкатегория удалена');
		redirect('/admin/components/tovar/edit_tovar');
	}

	// редактирование товаров
	public function action_edit_tovar()
	{
		// выводим меню из селекторов
		$data['category_menu'] = $this->dbmodel->get_all_category();
		$data['sub_category_menu'] = $this->dbmodel->get_all_sub_category();
		$data['tovar_menu'] = $this->dbmodel->get_all_tovar();
		$data['tovar'] = array();
		$data['tovar_img'] = array();

		// если выбрали категория
		if($this->input->post('category_select'))
		{
			$data['sub_category_menu'] = $this->dbmodel->get_sub_category_menu($this->input->post('category_select'));
			// $data['tovar_menu'] = $this->dbmodel->get_tovar_cat($this->input->post('category_select'));
			// $data['tovar'] = 'Товар не выбран';
			// $data['mesage'] = "Выбрали категорию:".$this->input->post('category_select');
		}

		// если выбрали подкатегория
		if($this->input->post('sub_category_select'))
		{
			// $data['sub_category_menu'] = $this->dbmodel->get_all_sub_category();
			$data['tovar_menu'] = $this->dbmodel->get_tovar_sub($this->input->post('sub_category_select'));
			// $data['tovar'] = 'Товар не выбран';
			// $data['mesage'] = "Выбрали подкатегорию:".$this->input->post('sub_category_select');
		}

		// если выбрали товар
		if($this->input->post('tovar_select'))
		{
			// $data['sub_category_menu'] = $this->dbmodel->get_sub_category_menu($this->input->post('tovar_select'));
			// $data['tovar_menu'] = $this->dbmodel->get_tovar_sub_category($this->input->post('tovar_select'));
			$data['tovar'] = $this->dbmodel->get_tovar($this->input->post('tovar_select'));
			$data['tovar_img'] = $this->dbmodel->get_tovar_img($this->input->post('tovar_select'));
			// $data['mesage'] = "Выбрали товар:".$this->input->post('tovar_select');
		}


		// выводим товар

		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->load->view('component/tovar/edit_tovar', $data, true)
		));
	}

	// редактирование материала
	public function action_edit_material()
	{

		if($this->input->post('dell_material'))
		{
			// удаляем из базы
			 $this->dbmodel->delete_item($this->input->post('dell_material'));
			// выводим сообщение
			$this->session->set_flashdata('success', 'Материал удален');
			redirect('/admin/components/tovar/edit_material');
			// echo "user".$_POST["delluser"];
		}

		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->load->view('component/tovar/edit_material', array(
			'all_material_select' => $this->dbmodel->get_all_material()
			), true)
		));
	}

	// редактирование категории
	public function action_edit_category()
	{

		if($this->input->post('dell_category'))
		{
			// удаляем из базы
			 $this->dbmodel->delete_category($this->input->post('dell_category'));
			// выводим сообщение
			$this->session->set_flashdata('success', 'Категория удалена');
			redirect('/admin/components/tovar/edit_category');
			// echo "user".$_POST["delluser"];
		}

		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->load->view('component/tovar/edit_category', array(
				'all_category_select' => $this->dbmodel->get_all_category()
			), true)
		));
	}

	// редактирование подкатегории
	public function action_edit_sub_category()
	{
		$data['tovar_sub_category'] = array();
		$data['tovar_sub_category_img'] = array();
		$data['tovar_sub_category_text'] = array();

		// если выбрали подкатегорию
		if($this->input->post('tovar_sub_category_select'))
		{
			$data['tovar_sub_category'] = $this->dbmodel->get_tovar_sub_category($this->input->post('tovar_sub_category_select'));
			$data['tovar_sub_category_img'] = $this->dbmodel->get_tovar_sub_category_img($this->input->post('tovar_sub_category_select'));
			$data['tovar_sub_category_text'] = $this->dbmodel->get_tovar_sub_category_text($this->input->post('tovar_sub_category_select'));
		}

		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->load->view('component/tovar/edit_sub_category', array(
				'all_sub_category_select' => $this->dbmodel->get_all_sub_category(),
				'tovar_sub_category' => $data['tovar_sub_category'],
				'tovar_sub_category_img' => $data['tovar_sub_category_img'],
				'tovar_sub_category_text' => $data['tovar_sub_category_text']
			), true)
		));
	}

	// редактирование цветов
	public function action_edit_color()
	{

		if($this->input->post('dell_color'))
		{
			// удаляем из базы
			 $this->dbmodel->delete_color($this->input->post('dell_color'));
			// выводим сообщение
			$this->session->set_flashdata('success', 'Цвет удален');
			redirect('/admin/components/tovar/edit_color');
			// echo "user".$_POST["delluser"];
		}

		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->load->view('component/tovar/edit_color', array(
				'all_color_select' => $this->dbmodel->get_all_color()
			), true)
		));
	}

	
	// добавление материала
	public function action_add_material()
	{

		// если нажали добавить
		if($this->input->post('material'))
		{
			//добавляем в базу
			$data = array(
				'tovar_material_name' => $this->input->post('material') 
			);

			$this->dbmodel->add_data_material($data);

			// выводим сообщение
			$this->session->set_flashdata('success', 'Материал добавлен');
			redirect('/admin/components/tovar/edit_material');
		}

		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->load->view('component/tovar/add_material', array(

			), true)
		));
	}

	// добавление цвета
	public function action_add_color()
	{

		// если нажали добавить
		if($this->input->post('color'))
		{
			//добавляем в базу
			$data = array(
				'tovar_color_name' => $this->input->post('color') 
			);

			$this->dbmodel->add_data_color($data);

			// выводим сообщение
			$this->session->set_flashdata('success', 'Цвет добавлен');
			redirect('/admin/components/tovar/edit_color');
		}

		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->load->view('component/tovar/add_color', array(

			), true)
		));
	}

	// добавление категории
	public function action_add_category()
	{

		// если нажали добавить
		if($this->input->post('category'))
		{
			//добавляем в базу
			$data = array(
				'tovar_category_name' => $this->input->post('category') 
			);

			$this->dbmodel->add_data_category($data);

			// выводим сообщение
			$this->session->set_flashdata('success', 'Категория добавлена');
			redirect('/admin/components/tovar/edit_category');
		}

		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->load->view('component/tovar/add_category', array(

			), true)
		));
	}

	// добавление подкатегории
	public function action_add_sub_category($id='')
	{

		// если нажали добавить
		if($this->input->post('sub_category'))
		{
			//добавляем в базу
			$data = array(
				'tovar_sub_category_name' => $this->input->post('sub_category'),
				'tovar_category_id' => $this->input->post('category'),
				'tovar_sub_category_text' => $this->input->post('tovar_sub_category_text')
			);

			$this->dbmodel->add_data_sub_category($data, $id);

			// выводим сообщение
			$this->session->set_flashdata('success', 'Категория добавлена');
			redirect('/admin/components/tovar/edit_sub_category');
		}

		if ($id) //если редактируем
		{
			foreach ($this->dbmodel->get_tovar_sub_category($id) as $item) 
			{
				$sub_category_red['tovar_sub_category_name'] = $item['tovar_sub_category_name'];
				$sub_category_red['tovar_sub_category_text'] = $item['tovar_sub_category_text'];
			}
		}
		else
		{
			$sub_category_red['tovar_sub_category_name'] = '';
			$sub_category_red['tovar_sub_category_text'] = '';
		}


		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment', 'ckeditor/ckeditor')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->load->view('component/tovar/add_sub_category', array(
			'all_category_select' => $this->dbmodel->get_all_category(),
			'sub_category_red' => $sub_category_red
			), true)
		));
	}

	// добавление товара
	public function action_add_tovar($id='')
	{

		// если нажали добавить
		if($this->input->post('tovar_name'))
		{
			//добавляем в базу
			$data = array(
				'tovar_name' => $this->input->post('tovar_name'),
				'tovar_prise' => $this->input->post('tovar_prise'),
				'tovar_prise_ab' => $this->input->post('tovar_prise_ab'),
				'tovar_prise_b' => $this->input->post('tovar_prise_b'),
				'tovar_prise_c' => $this->input->post('tovar_prise_c'),
				'tovar_skidka' => $this->input->post('tovar_skidka'),
				'tovar_text' => $this->input->post('tovar_text'),
				// 'tovar_reit' => $this->input->post('tovar_reit'),
				'tovar_razmer' => $this->input->post('tovar_razmer'),
				'tovar_uther' => $this->input->post('tovar_uther'),
				'tovar_dostupnost' => $this->input->post('tovar_dostupnost'),
				'tovar_sub_category_id' => $this->input->post('sub_category'),
				'tovar_material_id' => $this->input->post('material'),
				'tovar_color_id' => $this->input->post('color'),
				// 'id' => $id
			);

			$this->dbmodel->add_data_tovar($data, $id);

			// выводим сообщение
			$this->session->set_flashdata('success', 'Товар добавлен');
			redirect('/admin/components/tovar/edit_tovar');
		}

		if($id)//если редактируем
		{

			foreach ($this->dbmodel->get_tovar($id) as $item) 
			{
				$tovar_red['tovar_name'] = $item['tovar_name'];
				$tovar_red['tovar_prise'] = $item['tovar_prise'];
				$tovar_red['tovar_prise_ab'] = $item['tovar_prise_ab'];
				$tovar_red['tovar_prise_b'] = $item['tovar_prise_b'];
				$tovar_red['tovar_prise_c'] = $item['tovar_prise_c'];
				$tovar_red['tovar_skidka'] = $item['tovar_skidka'];
				$tovar_red['tovar_text'] = $item['tovar_text'];
				$tovar_red['tovar_razmer'] = $item['tovar_razmer'];
				$tovar_red['tovar_uther'] = $item['tovar_uther'];
				$tovar_red['tovar_dostupnost'] = $item['tovar_dostupnost'];
				$tovar_red['tovar_sub_category_id'] = $item['tovar_sub_category_id'];
				$tovar_red['tovar_material_id'] = $item['tovar_material_id'];
				$tovar_red['tovar_name'] = $item['tovar_name'];
				$tovar_red['tovar_color_id'] = $item['tovar_color_id'];
				$tovar_red['id'] = $id;
			}
		} 
		else 
		{
				$tovar_red['tovar_name'] = '';
				$tovar_red['tovar_prise'] = 0;
				$tovar_red['tovar_prise_ab'] = 0;
				$tovar_red['tovar_prise_b'] = 0;
				$tovar_red['tovar_prise_c'] = 0;
				$tovar_red['tovar_skidka'] = 0;
				$tovar_red['tovar_text'] = '';
				$tovar_red['tovar_razmer'] = '';
				$tovar_red['tovar_uther'] = '';
				$tovar_red['tovar_dostupnost'] = '';
				$tovar_red['id'] = '';

		}

		$this->render('dashboard', array(
			'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
			'js' => $this->asset->js(array('jquery', 'uikit', 'moment', 'ckeditor/ckeditor')),
			'component_menu' => $this->component->get_navigation(),
			'component' => $this->load->view('component/tovar/add_tovar', array(
				'all_sub_category_select' => $this->dbmodel->get_all_sub_category(),
				'all_material_select' => $this->dbmodel->get_all_material(),
				'all_color_select' => $this->dbmodel->get_all_color(),
				'tovar_red' => $tovar_red
			), true)
		));
	}

	// добавление изображений
	public function action_add_img($id)
	{

			// конфигурируем загрузчик картинок
			$config['upload_path'] = 'assets/img/tovar/'; // путь к папке куда будем сохранять изображение
			$config['allowed_types'] = 'gif|jpg|png'; // разрешенные форматы файлов
			$config['max_size']	= 3000000; // максимальный вес файла
			$config['encrypt_name'] = TRUE; // переименование файла в уникальное название
			$config['remove_spaces'] = TRUE; // убирает пробелы из названия файлов

			$this->load->library('upload', $config); // загружаем библиотеку

			if ( ! $this->upload->do_upload('userfile'))
			{
				$this->session->set_flashdata('success', 'ошибка');
			} 
			else 
			{

				/* Начало занесения имени файла в БД*/
				$upload_data = $this->upload->data(); // получаем информацию о загруженном файле
				$add['tovar_img_adres'] = $config['upload_path'].$upload_data['file_name']; // сохраняем имя файла в элемент массива add
				$add['tovar_img_type'] = $this->input->post('tovar_img_type'); // сохраняем тип изображения в элемент массива add
				$add['tovar_id'] = $id; // сохраняем айди товара в элемент массива add
				$this->db->insert('tovar_img',$add); // заносим это значение в таблицу tovar_img
				/* Конец занесения имени файла в БД*/

				// выводим сообщение
				$this->session->set_flashdata('success', 'Изображение добавлено');
				redirect('/admin/components/tovar/edit_tovar');
			}

			$this->render('dashboard', array(
				'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
				'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
				'component_menu' => $this->component->get_navigation(),
				'component' => $this->load->view('component/tovar/add_img', array(
					// 'all_category_select' => $this->dbmodel->get_all_tovar();
					'id' => $id
				), true)
			));
	}

	// добавление изображений плдкатегории
	public function action_add_sub_category_img($id)
	{
			// создаем папку если ее нет
			$pass = 'assets/img/sub_category/';

			if (!is_dir($pass)) {
				mkdir($pass, 0700, true);
			}
			// конфигурируем загрузчик картинок
			$config['upload_path'] = 'assets/img/sub_category/'; // путь к папке куда будем сохранять изображение
			$config['allowed_types'] = 'gif|jpg|png'; // разрешенные форматы файлов
			$config['max_size']	= 3000000; // максимальный вес файла
			$config['encrypt_name'] = TRUE; // переименование файла в уникальное название
			$config['remove_spaces'] = TRUE; // убирает пробелы из названия файлов

			$this->load->library('upload', $config); // загружаем библиотеку

			if ( ! $this->upload->do_upload('userfile'))
			{
				$this->session->set_flashdata('success', 'ошибка');
			} 
			else 
			{

				/* Начало занесения имени файла в БД*/
				$upload_data = $this->upload->data(); // получаем информацию о загруженном файле
				$add['tovar_img_adres'] = $config['upload_path'].$upload_data['file_name']; // сохраняем имя файла в элемент массива add
				// $add['tovar_img_type'] = $this->input->post('tovar_img_type'); // сохраняем тип изображения в элемент массива add
				$add['tovar_sub_category_id'] = $id; // сохраняем айди подкатегории в элемент массива add
				$this->db->insert('tovar_sub_category_img',$add); // заносим это значение в таблицу tovar_img
				/* Конец занесения имени файла в БД*/

				// выводим сообщение
				$this->session->set_flashdata('success', 'Изображение добавлено');
				redirect('/admin/components/tovar/edit_sub_category');
			}

			$this->render('dashboard', array(
				'css' => $this->asset->css(array('uikit', 'style', 'font-awesome')),
				'js' => $this->asset->js(array('jquery', 'uikit', 'moment')),
				'component_menu' => $this->component->get_navigation(),
				'component' => $this->load->view('component/tovar/add_sub_category_img', array(
					// 'all_category_select' => $this->dbmodel->get_all_tovar();
					'id' => $id
				), true)
			));
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