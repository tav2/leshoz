<div class="col-md-12">
	<h3>Галерея наших проектов</h3>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
				<ul class="nav navbar-nav">
<!-- 					<li><a href="got">Бани</a>
					<li><a href="got">Дома</a>
					<li><a href="got">Малые архитектурные формы</a>
					<li><a href="got">Бондарные изделия</a>
					<li><a href="got">Зоны отдыха</a>
					<li><a href="got">Наше производство</a> -->
					<?php echo $api_get_galereya_menu ?>
					
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	<article class="post">

		<?php echo $api_get_galereya_text ?>
		<hr>

		<div class="row">

			<?php echo $api_get_galereya_img ?>

			<!-- <div class="col-md-3">
				<figure>
					<a href="galeriya">
						<a href="assets/images/bani/b1.png" data-lightbox="roadtrip" data-title=""><img src="assets/images/bani/b1.png" alt="" ></a>
					</a>
				</figure>
			</div> -->

		</div>
		<?php echo $this->pagination->create_links(); ?>
<!-- 		<div class="row">
			<ul class="pagination">

				<li class="pag-prev"><a href="#">&larr; прдыдущее</a>
				</li>
				<li class="active"><a href="#">1</a>
				</li>
				<li><a href="#">2</a>
				</li>
				<li><a href="#">3</a>
				</li>
				<li class="pag-next"><a href="#">следующее &rarr;</a>
				</li>
			</ul>
		</div> -->
		<div class="post-meta">
			<i class="fa fa-camera"></i>
			<h5>Заснято</h5>
			<span class="published"><?php echo $api_get_galereya_date ?></span>
			
		</div>
	</article>
</div>


