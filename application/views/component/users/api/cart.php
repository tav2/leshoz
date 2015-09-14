<?php foreach($cart as $item): ?>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo $item['customer_cart_date'] ?></h3>
		</div>
		<div class="panel-body">
			<?php foreach($this->api_users->get_tovar($item['customer_cart_id']) as $item_tovar): ?>
				Товар: <?php echo $item_tovar['customer_cart_date'] ?>
			<?php endforeach ?>
		</div>
	</div>

<?php endforeach ?>