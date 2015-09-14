<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Base_Controller {

	protected $controller = __CLASS__;

	public function before()//прединсталяция
	{
		$this->load->model('news_model');
		$this->load->model('cart');
		$this->load->model('reg_model');
		// $this->load->model('component/news/api_news', 'news_api');
		$this->load->model('component/tovar/Api_tovar', 'tovar_api');
		$this->load->model('component/users/Api_users', 'users_api');
		$this->load->model('component/galereya/Api_galereya', 'galereya_api');
		$this->load->model('component/pricelist/api_pricelist', 'prices_api');
		// $this->load->model('component/tovar/database', 'dbmodel');
		// подключаем модель для обрабоки переменных из бд используемых статично
		$this->load->model('Staticpage_model');
	}
//------------------------------------------------------------------
	public function action_index()//главная
	{
		// $this->render('index');
			$this->render('index', array(
			'api_get_pogonaj' => $this->tovar_api->get_pogonaj_forindex(),
			'api_get_project' => $this->tovar_api->get_project_forindex(),
			'slider_img_1' => $this->Staticpage_model->get_file(1, 0),
			'slider_img_2' => $this->Staticpage_model->get_file(1, 1),
			'slider_img_3' => $this->Staticpage_model->get_file(1, 2),
			));
	}
//------------------------------------------------------------------
	public function action_kontakt()//контакты
	{
		// $this->render('kontakt');
		$this->render('kontakt', array(
			'kontakt1' => $this->Staticpage_model->get_zapis(3, 1),
			'kontakt2' => $this->Staticpage_model->get_zapis(3, 2),
			));
	}
//------------------------------------------------------------------
	public function action_magazin($selector_sub_cat='x', $selector_sort='y')//магазин
	{
		// $this->render('magazin');
		$this->render('magazin', array(
			'api_get_tovar' => $this->tovar_api->get_all($selector_sub_cat, $selector_sort)
			));
	}
//------------------------------------------------------------------
	public function action_magazin_project($selector_sub_cat='x', $selector_sort='y')//магазин проектов
	{
		// $this->render('magazin');
		$this->render('magazin_project', array(
			'api_get_project' => $this->tovar_api->get_all_project($selector_sub_cat, $selector_sort)
			));
	}
//------------------------------------------------------------------
	public function action_magazin_project_zakaz($selector_sub_cat='x', $selector_sort='y')//магазин разработок проектов
	{
		// $this->render('magazin');
		$this->render('magazin_project_zakaz', array(
			'api_get_project_zakaz' => $this->tovar_api->get_all_project_zakaz($selector_sub_cat, $selector_sort)
			));
	}
//------------------------------------------------------------------
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
//------------------------------------------------------------------
	public function action_galeriya_all()
	{
		$this->render('galeriya_all');
	}
//------------------------------------------------------------------
	public function action_news()//новости
	{
		$data_view['news'] = $this->news_model->get_all_news();


		$this->render('news', $data_view);
		// $this->render('news', array('api_get_category' => $this->news_api->get_all()));
	}
//------------------------------------------------------------------
	public function action_kompany()//о нашей компании
	{
		// $this->render('kompany');
		$this->render('kompany', array(
			'slaider_text_1' => $this->Staticpage_model->get_zapis(6, 1),
			'slaider_text_2' => $this->Staticpage_model->get_zapis(6, 2),
			'slaider_text_3' => $this->Staticpage_model->get_zapis(6, 3),
			'prezent' => $this->Staticpage_model->get_zapis(6, 4),
			'napravl' => $this->Staticpage_model->get_zapis(6, 5),
			'napravleniya' => $this->Staticpage_model->get_zapis(6),
			'video' => $this->Staticpage_model->get_file(6, 0),
			'slaider_fon_1' => $this->Staticpage_model->get_file(6, 1),
			'slaider_fon_2' => $this->Staticpage_model->get_file(6, 2),
			'slaider_fon_3' => $this->Staticpage_model->get_file(6, 3),
			'slaider_1' => $this->Staticpage_model->get_file(6, 4),
			'slaider_2' => $this->Staticpage_model->get_file(6, 5),
			'slaider_3' => $this->Staticpage_model->get_file(6, 6),
			));
	}
//------------------------------------------------------------------
	public function action_otziv()
	{
		$this->render('otziv');
	}
//------------------------------------------------------------------
	public function action_sotr()
	{
		$this->render('sotr');
	}
//------------------------------------------------------------------
	public function action_akcii()
	{
		$this->render('akcii');
	}
//------------------------------------------------------------------
	public function action_vopr()//часто задаваемые вопросы
	{
		// $this->render('vopr');
		$this->render('vopr', array(
			'voprosi' => $this->Staticpage_model->get_zapis(4),
			));
	}
//------------------------------------------------------------------
	public function action_klienti()
	{
		$this->render('klienti');
	}
//------------------------------------------------------------------
	//галерея
	public function action_galereya($id_menu='8')
	{
		// $this->render('galeriya');
		$this->render('galereya', array(
			'api_get_galereya_menu' => $this->galereya_api->get_galereya_menu_viev(),
			'api_get_galereya_img' => $this->galereya_api->get_galereya_img_viev($id_menu),
			'api_get_galereya_date' => $this->galereya_api->get_galereya_date_viev($id_menu),
			'api_get_galereya_text' => $this->galereya_api->get_galereya_text_viev($id_menu)
			));
	}
//------------------------------------------------------------------
	public function action_proizv()
	{
		$this->render('proizv');
	}
//------------------------------------------------------------------
	public function action_statyi()
	{
		$this->render('statyi');
	}
//------------------------------------------------------------------
	public function action_tovar($tovar_id)//еденичный товар
	{
		// $this->render('tovar');

			$this->render('tovar', array(
			'api_get_tovar_ed' => $this->tovar_api->get_tovar_ed($tovar_id)
			));
	}
//------------------------------------------------------------------
	public function action_prices($download = '', $value = '')
	{
		// $data['email'] = $_POST['email'];
		// if(mail($data['email'], 'Email Test', 'Testing the email class.'))
		// 				{echo "письмо отправленно";}
		// $this->render('prais');
		// $this->render('price', array(
		// 	'price_text' => $this->Staticpage_model->get_zapis(7, 1),
		// 	'price_file' => $this->Staticpage_model->get_file(7, 0),
		// 	));

		if ($download != '' AND $value != '')
		{
			if(file_exists(FCPATH.'upload/prices/' . $download) AND $value = 'download')
			{
				header('Content-type: application/pdf');
				header('Content-Disposition: attachment; filename="price_leshoz_company_'.date('Y_m_d').'_'.$download.'"');
				readfile(FCPATH.'upload/prices/' . $download);
				redirect('/prices');
			}
		}
		if(null !== $this->input->post('file'))
		{

			$this->load->library('form_validation');

			$this->form_validation->set_rules('email', 'email', 'required|valid_email');
			if ($this->form_validation->run() == FALSE)
			{
				$error['error'] = validation_errors();
				echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=/cost">';
			} else {
				$this->load->library('email');
				$config['mailtype'] = 'html';

				$this->email->initialize($config);
				$this->email->from('info@vels.kz', 'Прайс лист с сайта www.vels.kz');
				$this->email->to($this->input->post('email', true));

				$this->email->subject('Прайс лист с сайта www.vels.kz');
				$this->email->message('Вам был отправлен прайс лист с сайта <a href="http://www.leshoz.kz">www.leshoz.kz</a>.<br>Пожалуйста не отвечайте на данное письмо!');
				$this->email->attach(FCPATH.'upload/prices/' . $this->input->post('file'));

				$this->email->send();
				echo $this->email->print_debugger(array('headers', 'subject', 'body'));
				$error['error'] = 'Сообщение успешно отправлено!';
			}
		}


		$this->render('prices', array('api_get_prices' => $this->prices_api->get_prices()));
	}

//------------------------------------------------------------------
	public function action_cart($action = '', $id = '')//корзина
	{
		// echo "мы не тут";
		if ($action == 'add') 
		{
			$this->cart->add_to_cart(
					$this->input->post('amount'),
					$this->input->post('product_id')
				);
			$this->session->set_flashdata('cart_add', 'Продукция добавлена в корзину! Вы можете посмотреть заказы в разделе <a href="/cart" target=_blank>Корзина</a> или вернуться в <a href="welcome/magazin/'.$this->input->post('product_catalog_id').'/y" target=_blank>Каталог</a>');
			redirect($_SERVER['HTTP_REFERER']);
		}

		if ($action == 'delete') 
		{
			$this->cart->delete_cart_item($id);
			redirect('cart');
		}

		if ($action == 'order') 
		{
			//если ссессия загружена
			if($this->session->userdata('logged_in'))
			{
				$customer_info = $this->users_api->get_customer_info();
			} 
			else
			{
				$customer_info = $this->users_api->take_customer_info();
			}

			if ($this->input->post('cfselect')) 
			{
				// $post=$this->input->post('cfmail');
				$this->cart->confirtm_order();
				//нужно будет сделать очистку базы таблицы cart и создать пользователя с историей покупок и послать почту для 
				// подтверждения регистрации


				//выводим сообщение об этом всем
				$this->session->set_flashdata('cart_order1', 'Заказ получен. Вам отправленно письмо с регистрационными данными - для входа на наш сайт.');
				
				// redirect('cart');
			}

			$this->render('checkout', array(
				'items' => $this->cart->get_cart_items(),
				'customer_info' => $customer_info
				));
		} 
		else 
		{
			$this->render('cart', array('items' => $this->cart->get_cart_items()));
		}
	}
//------------------------------------------------------------------
	public function action_checkout()//оплата
	{
		$this->render('checkout');
	}
//------------------------------------------------------------------
	public function action_account()//страница пользователя
	{

		if ($this->input->post('vihod'))
		{
			$this->session->unset_userdata('usermail');
			$this->session->unset_userdata('logged_in');
			$this->render('index', array(
			'api_get_pogonaj' => $this->tovar_api->get_pogonaj_forindex(),
			'api_get_project' => $this->tovar_api->get_project_forindex(),
			'slider_img_1' => $this->Staticpage_model->get_file(1, 0),
			'slider_img_2' => $this->Staticpage_model->get_file(1, 1),
			'slider_img_3' => $this->Staticpage_model->get_file(1, 2),
			));
		} 
		else
		{
			$this->render('account', array(
			'api_get_cart' => $this->users_api->get_all_cart(),
			));
		}

	}
//------------------------------------------------------------------
	public function action_login()//регистрация и логин
	{
		//если нажали выход
		if ($this->input->post('vihod'))
		{
			$this->session->unset_userdata('usermail');
			$this->session->unset_userdata('logged_in');
			$this->render('index', array(
			'api_get_pogonaj' => $this->tovar_api->get_pogonaj_forindex(),
			'api_get_project' => $this->tovar_api->get_project_forindex(),
			'slider_img_1' => $this->Staticpage_model->get_file(1, 0),
			'slider_img_2' => $this->Staticpage_model->get_file(1, 1),
			'slider_img_3' => $this->Staticpage_model->get_file(1, 2),
			));
			return 0;
		} 

		//если нажали войти
		if ($this->input->post('name_login'))
		{

			//проверяем пользователя и включаем его сессию 
			$test=$this->reg_model->vhod_proverka($this->input->post('name_login'), $this->input->post('password_login'));
			if ($test) 
			{
				//устанавливаем данные сессии
				$newdata = array(
				'usermail'  => $test,
				'logged_in' => TRUE
				);
				$this->session->set_userdata($newdata);
				$this->session->set_flashdata('login_success', 'Вы успешно авторизировались!');
				// рендер в личный кабинет
				$this->render('account', array(
					'api_get_cart' => $this->users_api->get_all_cart(),
					));
				return 0;
			}
			else 
			{
				$this->session->set_flashdata('login_success', 'Логин или пароль неверен!');
			}
			// echo "login";
		}

		//форма регистрации
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		// формируем массивы сообщений валидации
		if ($this->input->post('name_create')) 
		{
			$name = array('required' => 'Введите имя пользователя.');
			$pass = array('required' => 'Вы дожны выбрать %s.');
			$email = array('required' => 'Введите емайл.');
			$this->form_validation->set_rules('name_create', 'Username', 'required', $name);
			$this->form_validation->set_rules('password_create', 'Password', 'required|matches[password_create_povtor]', $pass);
			$this->form_validation->set_rules('password_create_povtor', 'Password Confirmation', 'required');
			$this->form_validation->set_rules('email_create', 'Email', 'required|valid_email|callback_email_check', $email);
		}

			// если проверку не прошол
			if (($this->form_validation->run() == FALSE))
			{
				$this->render('login');
			}
			else
			{
				//создаем пользователя
				$this->reg_model->reg_create($this->input->post('email_create'), $this->input->post('name_create'), $this->input->post('password_create'), $this->input->post('contact_create'));
				$this->session->set_flashdata('customer_success', 'Пользователь успешно создан!');
				$this->render('login');
			}
		

	}

//функции валидации
//------------------------------------------------------------------

		function email_check($str)
	{

		// $this->load->model('reg_model');
		if(!$this->reg_model->reg_proverka($str))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('email_check', 'Такой %s уже существует');
			return FALSE;
		}
	}
//------------------------------------------------------------------

}
