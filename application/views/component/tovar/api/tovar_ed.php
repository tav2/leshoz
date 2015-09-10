<div class="row">

	<?php foreach($tovar_ed as $item): ?>

	<div class="col-md-4">
		<div class="content-box">
			<!-- Begin Img Thumbnail -->
			<div class="sp-wrap">

			<?php foreach($this->tovar_api->get_img_all($item['tovar_id']) as $pic): ?>

				<a href="<?php echo $pic['tovar_img_adres'] ?>">
					<img src="<?php echo $pic['tovar_img_adres'] ?>" alt="">
				</a>

			<?php endforeach ?>

			</div>
			<!-- end Img Thumbnail -->
			<ul class="product-option">
				<li>
					<a href="javascript:;"><?php echo $item['tovar_name'] ?></a>
					<span class="opt-available">Доступно</span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-8">
		<div class="content-box">
			<div class="product-meta">
				<h1 class="product-title"><?php echo $item['tovar_name'].$item['tovar_razmer'].$this->tovar_api->get_material($item['tovar_material_id']) ?></h1>
				<ul class="product-breadcrumb">
					<li><a href="index">Главная</a>
					</li>
					<li><a href="magazin">Товары</a>
					</li>
					<li><a href="welcome/magazin/1/y/"><?php echo $name_sub_category ?></a>
					</li>
					<li class="current"><a href="javscript:;"><?php echo $item['tovar_name'] ?></a>
					</li>
				</ul>
				<div class="product-rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-o"></i>
				</div>
			</div>
			<div class="product-desc">
				<div class="product-price">
					<div class="price-new">Цена A
					<!-- <div class="price-old">Цена A -->
						<span><?php echo $item['tovar_prise'] ?> Тг.</span>
					</div>

					<?php if ($item['tovar_prise_ab']) { ?>

					<div class="price-new">Цена АБ
						<span><?php echo $item['tovar_prise_ab'] ?> Тг.</span>
					</div>

					<?php }?>
					<?php if ($item['tovar_prise_b']) { ?>

					<div class="price-new">Цена Б
						<span><?php echo $item['tovar_prise_b'] ?> Тг.</span>
					</div>

					<?php }?>
					<?php if ($item['tovar_prise_c']) { ?>

					<div class="price-new">Цена С
						<span><?php echo $item['tovar_prise_c'] ?> Тг.</span>
					</div>

					<?php }?>
					<?php if ($item['tovar_skidka']) { ?>

					<div class="price-sale">Скидка
						<span><?php echo $item['tovar_skidka'] ?>%</span>
					</div>

					<?php }?>

				</div>
				<div >
				<h4><?php echo $this->session->flashdata('cart_add'); ?></h4>
						<form action="welcome/cart/add" method="post">
							<input required type="number" name="amount" class="input-black w70" placeholder="1" value="1">
							<input type="hidden" name="product_id" value="<?php echo $item['tovar_id'] ?>">
							<input type="hidden" name="product_catalog_id" value="<?php echo $item['tovar_sub_category_id'] ?>">
							<!-- <button class="btn-black" type="button">В корзину</button> -->
							<input type="submit" class="btn-black" value="В корзину">
						</form>

				</div><!-- /input-group -->
				<hr>

				<?php echo $this->tovar_api->get_sub_category_text($item['tovar_id']) ?>

				<ul class="nav nav-tabs">
					<li class="active"><a href="#desc" data-toggle="tab">Описание</a>
					</li>
					<li><a href="#addinfo" data-toggle="tab">Техническая информация</a>
					</li>
					<li><a href="#reviews" data-toggle="tab">Отзывы (1)</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane fade in active" id="desc">
						<p>
							<strong><?php echo $item['tovar_name'] ?></strong>
						</p>
						<hr/>
						<?php echo $item['tovar_text'] ?>
					</div>
					<div class="tab-pane fade" id="addinfo">
						<p>
							<strong>Размеры, цвета, схемы, материал</strong>
						</p>
						<hr/>
						<table class="product-shop-info">
							<tbody>
								<tr>
									<th>Размер</th>
									<td>
										<p><?php echo $item['tovar_razmer'] ?></p>
									</td>
								</tr>
								<tr>
									<th>Цвет</th>
									<td>
										<p><?php echo $this->tovar_api->get_color_name($item['tovar_id']) ?></p>
									</td>
								</tr>
								<!-- <tr>
									<th>Размер стекла</th>
									<td>
										<p>5 на 8, 6 на 2</p>
									</td>
								</tr> -->
								<tr>
									<th>Материал</th>
									<td>
										<p><?php echo $this->tovar_api->get_material($item['tovar_material_id']) ?></p>
									</td>
								</tr>
								<tr>
									<th>Другая информация</th>
									<td>
										<p><?php echo $item['tovar_uther'] ?></p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="tab-pane fade" id="reviews">
						<p>
							<strong>Отзывы о товаре</strong>
						</p>
						<hr/>
						<div class="media">
							<a class="pull-left" href="javascript:;">
								<img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/avatar-1.jpg" style="width: 64px; height: 64px;">
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</div>
							</a>
							<div class="media-body">
								<h5 class="media-heading">John Donec</h5>
								<p>О Джоне информация</p>
							</div>
						</div>
						<hr/>
						<h4>Добавте ваш отзыв</h4>
						<p></p>
						<form role="form">
							<div class="form-group">
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Имя">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Емайл">
							</div>
							<div class="form-group">
								<select class="form-control">
									<option>сжег 1 звезда</option>
									<option>отдал 2 звезды</option>
									<option>использую 3 звезды</option>
									<option>использую и хвалю 4 звезды</option>
									<option>берегу и ненарадуюсь 5 звезд</option>
								</select>
							</div>
							<div class="form-group">
								<textarea class="form-control" rows="5"></textarea>
							</div>
							<button type="submit" class="btn-black">Отправить отзыв</button>
						</form>
					</div>
				</div>
				<!-- END TAB -->
			</div>
		</div>
	</div>

	<?php endforeach ?>

</div>