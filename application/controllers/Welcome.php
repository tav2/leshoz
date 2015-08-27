<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Base_Controller {

	protected $controller = __CLASS__;

	public function before()//прединсталяция
	{
		$this->load->model('news_model');
		$this->load->model('component/news/api_news', 'news_api');
	}

	public function action_index()//главная
	{
		$this->render('index');
	}
	public function action_kontakt()//контакты
	{
		$this->render('kontakt');
	}
	public function action_magazin()//магазин
	{
		$this->render('magazin');
	}

	public function action_single($news_id)//страница одной новости с комментариями
	{

		// если запостили комментарий
		if($this->input->post('comment_name', true))
		{
			//добавляем в базу
			$this->load->helper('date');
			date_default_timezone_set('Asia/Almaty');
			$datestring = '%Y:%m:%d';

			$data = array(
				'news_comment_name' => $_POST["comment_name"] ,
				'news_comment_text' => $_POST["comment_text"] ,
				'news_comment_date' => mdate($datestring) ,
				'news_id' => $news_id ,
				'user_id' => $this->news_model->get_user() ,
			);

			$this->news_model->add_data_comment($data);

			// выводим сообщение
			// $this->session->set_flashdata('success', 'Новость добавлена');
			// redirect('/admin/components/news');
		}

		$data_view['news'] = $this->news_model->get_news($news_id);

		$data_view['comments'] = $this->news_model->get_all_comments($news_id);

		$this->render('single', $data_view);
	}

	public function action_galeriya_all()
	{
		$this->render('galeriya_all');
	}

	public function action_news()//новости
	{
		$data_view['news'] = $this->news_model->get_all_news();


		$this->render('news', $data_view);
		// $this->render('news', array('api_get_category' => $this->news_api->get_all()));
	}

	public function action_kompany()
	{
		$this->render('kompany');
	}
	public function action_otziv()
	{
		$this->render('otziv');
	}
	public function action_sotr()
	{
		$this->render('sotr');
	}
	public function action_akcii()
	{
		$this->render('akcii');
	}
	public function action_vopr()
	{
		$this->render('vopr');
	}
	public function action_klienti()
	{
		$this->render('klienti');
	}
	public function action_got()
	{
		$this->render('got');
	}
	public function action_proizv()
	{
		$this->render('proizv');
	}
	public function action_statyi()
	{
		$this->render('statyi');
	}
	public function action_tovar()
	{
		$this->render('tovar');
	}
	public function action_prais()
	{
		$this->render('prais');
	}
}
