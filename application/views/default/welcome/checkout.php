		<!-- ABOUT CONTENT -->
		<section class="content-wrapper">
			<div class="container">
				<div class="row">

					<!-- //выводим корзину -->
					<div class="col-md-12">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Выбрано</th>
									<th>Количество</th>
									<th>Цена</th>
									<th>Итого</th>
									<!-- <th>Убрать</th> -->
									<!-- <th></th> -->
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
									<!-- <td><a href="welcome/cart/delete/<?php //echo $item['cart_product_id']; ?>"><i class="icon-remove">х</i></a> -->
									<!-- </td> -->
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
					</div>

					<h4><?php echo $this->session->flashdata('cart_order1'); ?></h4>
					<h4><?php //echo $test ?></h4>

					<div class="col-md-12">
						<div class="content-box">
							<form class="form-horizontal" method="post">
								<fieldset>
									<legend>Информация о покупателе</legend>

									<?php echo $customer_info; ?>

								</fieldset>
								<fieldset>
									<legend>Метод оплаты</legend>
									<div class="form-group">
										<label for="card_type" class="col-sm-2 control-label">Платеж</label>
										<div class="col-sm-2">
											<select class="form-control" id="card_type" name="cfselect">
												<option>Наличными</option>
												<!-- <option>Visa</option>
												<option>Mastercard</option>
												<option>American Express</option>
												<option>Diners Club</option> -->
											</select>
										</div>
									</div>
									<!-- <div class="form-group">
										<label for="inputPassword5" class="col-sm-2 control-label">Номер карты</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="inputPassword5" placeholder="">
											<small>Написано на вашей карте</small>
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword6" class="col-sm-2 control-label">Проверочный код</label>
										<div class="col-sm-2">
											<input type="text" class="form-control" id="inputPassword6" placeholder="">
										</div>
									</div> -->
									<div class="form-group">
										<div class="col-sm-4 col-md-offset-2 ">
											<!-- <button type="button" class="btn btn-primary">Отправить</button> -->
											<input type="submit" value="Отправить" class="btn btn-primary">
											<!-- <button type="button" class="btn btn-default">Сброс</button> -->
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END ABOUT CONTENT -->