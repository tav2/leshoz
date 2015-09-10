<div class="col-md-12">
	<div class="product-meta">
		<h1 class="product-title">Все товары</h1>
		<ul class="product-breadcrumb">
			<li><a href="index">Главная</a>
			</li>
			<li><a href="magazin">Товары</a>
			</li>
			<li class="current"><a href="javscript:;"><?php echo $name_sub_category ?></a>
			</li>
		</ul>
	</div>
</div>
<div class="col-md-9">
	<div class="row">
		<div class="col-md-12">
			<div class="product-order">
				<div class="select-wrapper">
					<select name="country_id" class="country_id" onChange="if(value!=''){location=value}else{options[selectedIndex=0];}">
						<option <?php echo $activ_selector_sort_1 ?> value="welcome/magazin/<?php echo $id_sub_category ?>/1">По поступлению</option>
						<option <?php echo $activ_selector_sort_2 ?> value="welcome/magazin/<?php echo $id_sub_category ?>/2">По цене от дорогих</option>
						<option <?php echo $activ_selector_sort_3 ?> value="welcome/magazin/<?php echo $id_sub_category ?>/3">По цене от недорогих</option>
						<option <?php echo $activ_selector_sort_4 ?> value="welcome/magazin/<?php echo $id_sub_category ?>/4">По отзывам</option>
					</select>
				</div>
				<div class="select-wrapper">
					<select name="category_select" id="" class="country_id" onChange="if(value!=''){location=value}else{options[selectedIndex=0];}">
						<option  >Выберете тип товара</option>
						<?php foreach($sub_category_menu as $id): ?>
							<option value="<?php echo 'welcome/magazin/'.$id['tovar_sub_category_id'] ?>/<?php echo $selector_sort ?>/"><?php echo $id['tovar_sub_category_name'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<!-- <div class="select-wrapper">
					<select name="category_select" id=""  class="country_id" onChange="if(value!=''){location=value}else{options[selectedIndex=0];}">
						<option  >Выбор материала</option>
						<?php //foreach($all_material_select as $id): ?>
							<option value="<?php //echo 'welcome/magazin//'.$id['tovar_material_id'] ?>"><?php //echo $id['tovar_material_name'] ?></option>
						<?php //endforeach ?>
					</select>
				</div> -->
			</div>
		</div>
	</div>

	<div class="row">
		<?php foreach($tovar as $item): ?>
			<div class="col-md-4">
				<div class="product-block">
					<div class="product-image">
						<a href="welcome/tovar/<?php echo $item['tovar_id'] ?>">
							<figure class="product-display">

								<img alt="" class=" product-mainpic" src="<?php echo $this->tovar_api->get_img1($item['tovar_id']); ?>" style="display: block;">
								<img src="<?php echo $this->tovar_api->get_img2($item['tovar_id']); ?>" alt="" class="product-secondpic">
							</figure>
						</a>
					</div>
					<div class="product-meta">
						<div class="product-action">
							<a href="welcome/tovar/<?php echo $item['tovar_id'] ?>" class="addcart">
								<i class="icon-basket"></i>
								В корзину
							</a>
							<a href="javascript:;" class="wishlist">
								<i class="fa fa-heart"></i>
							</a>
							<a href="javascript:;" class="compare">
								<i class="fa fa-retweet"></i>
							</a>
						</div>
					</div>
					<div class="product-info">
						<a href="welcome/tovar/<?php echo $item['tovar_id'] ?>">
							<h5 class="product-name"><?php echo $item['tovar_name'].$item['tovar_razmer'].$this->tovar_api->get_material($item['tovar_material_id']) ?></h5>
						</a>
						<div class="product-price">
							<span><?php echo $item['tovar_prise'] ?></span>
						</div>
					</div>
					<div class="product-rating">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</div>
				</div>
			</div>
		<?php endforeach ?>

	</div>
	<!-- begin pagination -->
	<div class="row">
		<div class="col-md-12">
		<?php echo $this->pagination->create_links();?>
			<ul class="pagination">
				<li class="pag-prev"><a href="#">&larr; предыдущий</a>
				</li>
				<li class="active"><a href="#">1</a>
				</li>
				<li><a href="#">2</a>
				</li>
				<li><a href="#">3</a>
				</li>
				<li class="pag-next"><a href="#">следующий &rarr;</a>
				</li>
			</ul>
		</div>
	</div>
	<!--/.pagination-->
</div>