
<div class="topslider fullwidth">
	<div class="sequence-theme">
		<div id="sequence">

			<img class="sequence-prev" src="assets/images/bt-prev.png" alt="Previous Frame" />
			<img class="sequence-next" src="assets/images/bt-next.png" alt="Next Frame" />

			<ul class="sequence-canvas">
				<li class="animate-in" >
					<div class="seq-bg" style="background:url('<?php echo $slaider_fon_1 ?>');background-size:cover;-webkit-background-size:cover;-moz-background-size:cover;"></div>

					<?php foreach($slaider_text_1 as $id): ?>
					<h2 class="title"><?php echo $id['staticpage_title'] ?></h2>
					<h3 class="subtitle"><?php echo $id['staticpage_text'] ?></h3>
					<?php endforeach ?>

					<img class="model" src="<?php echo $slaider_1 ?>" alt="Model 1" />
				</li>
				<li>
					<div class="seq-bg" style="background:url('<?php echo $slaider_fon_2 ?>');background-size:cover;-webkit-background-size:cover;-moz-background-size:cover;"></div>
					
					<?php foreach($slaider_text_2 as $id): ?>
					<h2 class="title"><?php echo $id['staticpage_title'] ?></h2>
					<h3 class="subtitle"><?php echo $id['staticpage_text'] ?></h3>
					<?php endforeach ?>

					<img class="model" src="<?php echo $slaider_2 ?>" alt="Model 2" />
				</li>
				<li>
					<div class="seq-bg" style="background:url('<?php echo $slaider_fon_3 ?>');background-size:cover;-webkit-background-size:cover;-moz-background-size:cover;"></div>
					
					<?php foreach($slaider_text_3 as $id): ?>
					<h2 class="title"><?php echo $id['staticpage_title'] ?></h2>
					<h3 class="subtitle"><?php echo $id['staticpage_text'] ?></h3>
					<?php endforeach ?>

					<img class="model" src="<?php echo $slaider_3 ?>" alt="Model 3" />
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- END SLIDER -->
<div class="container">
	<div class="row">
		<div class="col-md-3 col-sm-6">
			<div class="content-box">
				<div class="icon-text-box">
					<div class="itb-icon">
						<i class="glyphicon glyphicon-resize-small"></i>
					</div>
					<span class="itb-title">
						Партнерство
					</span>
					<span class="itb-content">
						Многолетние отношения связывающие нас и партнеров.
					</span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6">
			<div class="content-box">
				<div class="icon-text-box">
					<div class="itb-icon">
						<i class="glyphicon glyphicon-eye-open"></i>
					</div>
					<span class="itb-title">
						Честность
					</span>
					<span class="itb-content">
						Доброжелательность и честность в работе с клиентами.
					</span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6">
			<div class="content-box">
				<div class="icon-text-box">
					<div class="itb-icon">
						<i class="glyphicon glyphicon-tower"></i>
					</div>
					<span class="itb-title">
						Качество
					</span>
					<span class="itb-content">
						Высокое качество поставляемой нами продукции.
					</span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6">
			<div class="content-box">
				<div class="icon-text-box">
					<div class="itb-icon">
						<i class="glyphicon glyphicon-check"></i>
					</div>
					<span class="itb-title">
						Ответственность
					</span>
					<span class="itb-content">
						Четкость и обязательность в работе со всеми партнерами и клиентами.
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- BEGIN CONTENT INDEX BUSINESS -->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box-title">
				<h2>Наши услуги</h2>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="content-box">
				<!-- презентация -->
				<?php foreach($prezent as $id): ?>
					<h3><?php echo $id['staticpage_title'] ?></h3>
					<p><?php echo $id['staticpage_text'] ?></p>
				<?php endforeach ?>

				<div class="responsive-video">
					<!-- <iframe src="http://player.vimeo.com/video/50194334?title=0&amp;byline=0&amp;portrait=0&amp;color=7ac144" width="500" height="281" allowfullscreen></iframe> -->
					<video controls> 
						<source src="<?php echo $video ?>" type="video/mp4"> 
					</video>

				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="content-box">
				<!-- направления -->
				<?php foreach($napravl as $id): ?>
					<h3><?php echo $id['staticpage_title'] ?></h3>
					<p><?php echo $id['staticpage_text'] ?></p>
				<?php endforeach ?>

				<div class="panel-group" id="accordion">

					<?php foreach($napravleniya as $id): ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $id['staticpage_content_id'] ?>">
									<?php echo $id['staticpage_title'] ?>
								</a>
							</h4>
						</div>
						<div id="collapse<?php echo $id['staticpage_content_id'] ?>" class="panel-collapse collapse">
							<div class="panel-body">
								<p>
									<?php echo $id['staticpage_text'] ?>
								</p>
							</div>
						</div>
					</div>
					<?php endforeach ?>

				</div>
			</div>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-md-12">
			<div class="box-title">
				<h2>Наши партнеры</h2>
			</div>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<div class="promo">
				<div class="promo-box">
					<a href="javascript:;">
						<figure class="promo-img">
							<img src="assets/images/banner-top-2.jpg" alt="GET 50% OFF WHEN YOU SPEND $100">
							<span class="promo-block"></span>
						</figure>
						<div class="promo-info">
							<h3 class="promo-title">Предприятие 1</h3>
							<p>
								Урал | город</p>
						</div>
						<!--/.promo-info -->
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 ">
			<div class="promo">
				<div class="promo-box">
					<a href="javascript:;">
						<figure class="promo-img">
							<img src="assets/images/banner-top-1.jpg" alt="GET 50% OFF WHEN YOU SPEND $100">
							<span class="promo-block"></span>
						</figure>
						<div class="promo-info">
							<h3 class="promo-title">Предприятие 2</h3>
							<p>
								Сибирь | город</p>
						</div>
						<!--/.promo-info -->
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/.container -->
<!-- END INDEX CONTENT