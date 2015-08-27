<?php

class Tovar extends Admin_Controller {

	public function before()
	{
		$this->load->model('component/'.strtolower(__CLASS__).'/database', 'dbmodel');
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

	// редактирование материала
	public function action_edit_material($id='')
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
				'all_material_select' => $this->dbmodel->get_all_category()
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