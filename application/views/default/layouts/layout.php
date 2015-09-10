<!doctype html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Tumbas Multipurpose Business Theme">
	<meta name="author" content="Develpixel">

	<!-- нужно обязательно чтобы лайаут работал -->
	<base href="<?php echo base_url(); ?>">

	<link rel="shortcut icon" href="assets/images/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="assets/images/favicon/favicon.ico" type="image/x-icon">

	<title>Лесхоз</title>

	<!-- Bootstrap core CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome CSS -->
	<link href="assets/css/lib/font-awesome.css" rel="stylesheet">
	<!-- Zocial CSS -->
	<link href="assets/css/lib/zocial.css" rel="stylesheet">
	<!-- Animated CSS-->
	<link href="assets/css/lib/animate.css" rel="stylesheet">
	<!-- OWL CSS-->
	<link href="assets/css/lib/owl.carousel.css" rel="stylesheet">
	<link href="assets/css/lib/owl.theme.css" rel="stylesheet">
	<!-- SequenceSlider CSS о компании-->
	<link href="assets/css/lib/sequencejs-theme.sliding-horizontal-parallax.css" rel="stylesheet">
	<!-- Smoothproducts CSS -->
	<link href="assets/css/lib/smoothproducts.css" rel="stylesheet">
	<!-- Costumize Font CSS -->
	<link href="assets/css/lib/costumizefont.css" rel="stylesheet" type="text/css">
	<!-- Selectbox CSS -->
	<link href="assets/css/lib/jquery.selectbox.css" rel="stylesheet">
	<!-- STYLE CSS -->
	<link href="assets/css/style.css" rel="stylesheet">
	<!-- Color Scheme CSS -->
	<link href="assets/css/scheme/green.css" rel="stylesheet">
	<!-- лайтбокс -->
	<link href="assets/css/litebox/lightbox.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="assets/js/html5shiv.js"></script>
	  <script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div class="outter">
	<!-- BEGIN HEADER -->
	<section class="header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="sitelogo-block">
						<div class="logo">
							<a href="javascript:;">
								<img src="assets/images/logo2.jpg" alt="">
							</a>
						</div>
						<!--/.logo-->
						<div class="titledesc">
							<h1>Горбань</h1>
							<span>Изделия из древесины </span>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="topinfo-block">
						<form method="POST">
							<input type="text" class="input-search" name="search" value="" placeholder="поиск">
							<button type='submit' class="submit-search" name='submit'><i class="icon-search"></i>
							</button>
						</form>
						<a href="login" class='info login'>
							<span class="icon"><i class="icon-lock"></i>
							</span>Войти</a>
						<a href="cart" class='info cart'>
							<span class="icon"><i class="icon-basket"></i>
							</span>Товаров
							<span><?=$cart_count?></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<!--/.container -->
	</section>
	<!-- END HEADER -->
	<!-- BEGIN NAVIGATION -->
	<section class="navigation">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar-default" role="navigation">
						<div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>

							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav">
									<li><a href="index">Главная</a>
									<li class="dropdown">
										<a href="" class="dropdown-toggle" data-toggle="dropdown">Компания <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="kompany">О нас</a>
											</li>
											<li><a href="otziv">Отзывы</a>
											</li>
											<li><a href="akcii">Акции</a>
											</li>
											<li><a href="statyi">Статьи</a>
											</li>
											<li><a href="news">Новости</a>
											</li>
											<li><a href="vopr">Вопросы</a>
											</li>
										</ul>
									</li>
									</li>
									<li><a href="galereya">Галерея</a></li>
									<li><a href="/magazin">Товары</a></li>
									<li class="dropdown">
										<a href="galeriya_all" class="dropdown-toggle" data-toggle="dropdown">Проекты<b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="/magazin_project">Готовые проекты</a>
											</li>
											<li><a href="/magazin_project_zakaz">Проекты на заказ</a>
											</li>
										</ul>
									</li>
									<li><a href="/prices">Прайс</a></li>

									<li><a href="/kontakt">Контакты</a>
									</li>
								</ul>
							</div>
							<!-- /.navbar-collapse -->
						</div>
						<!-- /.container-fluid -->
					</nav>
				</div>
			</div>
		</div>
	</section>
		<!-- END NAVIGATION -->

	<?php echo $content; ?>

	<footer>
		<!-- WIDGET ABOUT -->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="wdgt-about">
						<div class="row">
							<div class="col-md-3">
								<div class="row">
									<div class="col-md-3">
										<img src="assets/images/logo-black_my_cr2.png" alt="" class="logo-bottom">
									</div>

									<div class="col-md-9">
									<br>
										<h3>ГОРБАНЬ</h3>
									</div>
									
									
								</div>
							</div>
							<div class="col-md-5">
								<!-- о нас -->
								<?php foreach($about as $id): ?>
								<h3 class="wdgt-title"><?php echo $id['staticpage_title'] ?></h3>
								<p>
									<?php echo $id['staticpage_text'] ?>
								</p>
								<?php endforeach ?>

								<a href="javascript:;" class="iconize">
									<i class="fa fa-facebook"></i>
								</a>
								<a href="javascript:;" class="iconize">
									<i class="fa fa-twitter"></i>
								</a>
								<a href="javascript:;" class="iconize">
									<i class="fa fa-google-plus"></i>
								</a>
								<a href="javascript:;" class="iconize">
									<i class="fa fa-rss"></i>
								</a>
							</div>
							<div class="col-md-4">
								<h3 class="wdgt-title">Рассылка новостей</h3>
								<p>Тут можно подписаться на новости.</p>
								<form>
									<input type="text" name="newsletter" class="input-black">
									<input type="submit" name="submit" class="btn-black">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END WIDGET ABOUT -->
		<!-- BEGIN WIDGET BOTTOM -->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<section class="wdgt-bottom">
						<div class="row">
							<div class="col-md-3 col-sm-6">
								<div class="widget-box">
									<!-- рабочее время -->
									<?php foreach($time as $id): ?>
									<h3 class="wdgt-title"><?php echo $id['staticpage_title'] ?></h3>
									<p>
										<?php echo $id['staticpage_text'] ?>
									</p>
									<?php endforeach ?>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="widget-box">
									<h3 class="wdgt-title">Покупайте у нас</h3>
									<ul class="wdgt-ul">
										<li><a href="magazin">Погонаж</a>
										</li>
										<li><a href="magazin">Бани</a>
										</li>
										<li><a href="magazin">Дома</a>
										</li>
										<li><a href="magazin">Беседки</a>
										</li>
										<li><a href="magazin">Архитектурные формы</a>
										</li>
										<li><a href="magazin">Бондарные изделия</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="widget-box">
									<h3 class="wdgt-title">МОЙ АККАУНТ</h3>
									<ul class="wdgt-ul">
										<li><a href="javascript:;">Мой аккаунт</a>
										</li>
										<li><a href="cart.html">Покупки</a>
										</li>
										<li><a href="javascript:;">Настройки</a>
										</li>
										<li><a href="javascript:;">Рефералы</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="widget-box">
									<!-- контакты -->
									<?php foreach($kontakt as $id): ?>
									<h3 class="wdgt-title"><?php echo $id['staticpage_title'] ?></h3>
									<p>
										<?php echo $id['staticpage_text'] ?>
									</p>
									<?php endforeach ?>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="shop-info">
						<p class="pull-left">&copy; 2015 <a href="http://web.com.kz" target="_blank">Создание сайтов в Казахстане</a> mr@web.com.kz</p>
						</p>
					</div>
				</div>
			</div>
		</div>
		<!-- END WIDGET BOTTOM -->
	</footer>
	<!-- END FOOTER -->

</div>
	<!--      -->
	<!-- END OUTER -->
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="assets/js/jquery-1.10.2.min.js"></script>
	<!-- SelectBox JS -->
	<script src="assets/js/lib/jquery.selectbox-0.2.js"></script>
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- Waypoints JS -->
	<script src="assets/js/lib/waypoints.min.js"></script>
	<!-- OWL JS -->
	<script src="assets/js/lib/owl.carousel.min.js"></script>
	<!-- Sequence JS о компании -->
	<script src="assets/js/lib/jquery.sequence-min.js"></script>
	<!-- FitVid JS -->
	<script src="assets/js/lib/jquery.fitvid.js"></script>
	<!-- Smooth Products JS -->
	<script src="assets/js/lib/smoothproducts.js"></script>
	<!-- Media Element JS -->
	<script src="assets/js/lib/mediaelement.min.js"></script>
	<!-- JS For Menjual -->
	<script src="assets/js/main.js"></script>
	<!-- лайтбокс -->
			<script src="assets/js/litebox/lightbox.js"></script>
			<script>
				lightbox.option({
				  'maxHeight': 600
				})
			</script>
</body>
</html>
<!-- TUMBAS шаблон-->