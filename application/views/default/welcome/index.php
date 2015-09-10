<!-- BEGIN  TOP SLIDER --> 
<div class="topslider">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
			<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		</ol>
		<div class="carousel-inner">
			<div class="item active animated fadeInUp">
				<img alt="Third slide" src="<?php echo $slider_img_1 ?>">
				<div class="caption">
					<!-- <div class=" slider-title animated fadeInDown delay1">1</div>
					<div class="hidden-xs delay2 slider-desc animated fadeIn">1</div>
					<div class="slider-button animated fadeInUp delay3">
						<a href="javascript:;">PURCHASE</a>
					</div> -->
				</div>
			</div>
			<div class="item  animated fadeInUp">
				<img alt="Third slide" src="<?php echo $slider_img_2 ?>">
				<div class="caption">
					<!-- <div class=" slider-title animated fadeInDown delay1">1</div>
					<div class="hidden-xs delay2 slider-desc animated fadeIn">2</div>
					<div class="slider-button animated fadeInUp delay3">
						<a href="javascript:;">PURCHASE</a>
					</div> -->
				</div>
			</div>
			<div class="item  animated fadeInUp">
				<img alt="Third slide" src="<?php echo $slider_img_3 ?>">
				<div class="caption">
					<!-- <div class=" slider-title animated fadeInDown delay1">1</div>
					<div class="hidden-xs delay2 slider-desc animated fadeIn">3</div>
					<div class="slider-button animated fadeInUp delay3">
						<a href="javascript:;">PURCHASE</a>
					</div> -->
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
			<img src="assets/images/slide-left.png" alt="">
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
			<img src="assets/images/slide-right.png" alt="">
		</a>
	</div>
</div>
	<!-- END SLIDER -->

<!-- END FEATURED -->

<section class="featured">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="box-title">
					<h2>ГОТОВЫЕ ПРОЕКТЫ</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div id="featured-slider" class="owl-carousel">

						<?php echo $api_get_project;?>

					</div>
					<!--END Owl -->
				</div>
			</div>
		</div>
	</div>
	<!--/.container -->
</section>
<!-- END FEATURED -->

<section class="featured">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="box-title">
					<h2>ПОГОНАЖ</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div id="featured-slider2" class="owl-carousel">

						<?php echo $api_get_pogonaj;?>

					</div>
					<!--END Owl -->
				</div>
			</div>
		</div>
	</div>
	<!--/.container -->
</section>
<!-- END FEATURED