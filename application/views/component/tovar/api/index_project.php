<?php foreach($tovar as $item): ?>
	<div class="item">
		<!-- PRODUCT -->
		<div class="col-md-12">
			<div class="product-block">
				<div class="product-image">
					<a href="welcome/tovar/<?php echo $item['tovar_id'] ?>">
						<figure class="product-display">
							<?php if ($item['tovar_skidka']!=0) 
								{ ?>

							<span class="product-label-special label">
								<i>Sale</i>
								<span class="special"><?php echo $item['tovar_skidka'] ?>%</span>
							</span>

							<?php } ?>
							<img data-src="<?php echo $this->tovar_api->get_img1($item['tovar_id']); ?>" alt="" class="lazyOwl product-mainpic" src="<?php echo $this->tovar_api->get_img2($item['tovar_id']); ?>">
							<img src="<?php echo $this->tovar_api->get_img2($item['tovar_id']); ?>" alt="" class="product-secondpic">
						</figure>
					</a>
				</div>
				<div class="product-meta">
					<div class="product-action">
						<a href="javascript:;" class="addcart">
							<i class="icon-basket"></i>
							В корзину</a>

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
						<h5 class="product-name"><?php echo $item['tovar_name'] ?></h5>
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
		<!-- END PRODUCT -->
	</div>
<?php endforeach ?>