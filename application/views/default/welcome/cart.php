
<section class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Выбрано</th>
							<th>Количество</th>
							<th>Цена</th>
							<th>Итого</th>
							<!-- <th>Убрать</th> -->
							<th></th>
						</tr>
					</thead>
					<tbody>

						<?php $sum = 0; ?>
						<?php foreach($items as $item): ?>

						<tr>
							<td><?php echo $item['tovar_name'].'-'.$item['tovar_razmer'] ?></td>
							<td><?php echo $item['cart_product_amount'] ?></td>
							<td><?php echo $item['tovar_prise'] ?></td>
							<td>
							<?php
										$price = preg_replace('~\D+~','', $item['tovar_prise'])*$item['cart_product_amount'];
										$sum = $sum+$price;
										echo number_format($price, 0, '', ' ');
							?>
							</td>
							<td><a href="welcome/cart/delete/<?php echo $item['cart_product_id']; ?>"><i class="icon-remove">х</i></a>
							</td>
						</tr>

						<?php endforeach ?>

						<tr>
							<td colspan="3">
								<strong>ВСЕГО</strong>
							</td>
							<td>
								<strong><?php echo number_format((int)$sum, 0, '', ' ').' тенге'; ?></strong>
							</td>
							<td></td>
						</tr>
					</tbody>
				</table>
				<div class="form-group">
					<a class="btn btn-default" href="magazin">&larr;&nbsp;&nbsp;Вернуться в магазин</a>
					<a class="btn btn-success pull-right" href="welcome/cart/order">Оплатить&nbsp;&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END ABOUT CONTENT