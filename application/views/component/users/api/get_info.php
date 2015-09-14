
<?php foreach($customer as $item): ?>
	<h4>Вы вошли как:</h4>
	<?php echo $item['customer_name'] ?>
	<h4>Ваш емайл:</h4>
	<?php echo $item['customer_email'] ?>
	<h4>Ваши контактные данные:</h4>
	<?php echo $item['customer_contact'] ?>
	<br>

<?php endforeach ?>