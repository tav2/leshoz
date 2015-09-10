
<section class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="content-box">
					<h3>Карта Астана</h3>
					<div >
					<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=cG-q8VbPaHBIsRZ0wuOkIiZ1Cw-JUkyd&width=&height=450"></script>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-box">

					<!-- контакты -->
					<?php foreach($kontakt1 as $id): ?>
					<h3 ><?php echo $id['staticpage_title'] ?></h3>
					<p>
						<?php echo $id['staticpage_text'] ?>
					</p>
					<?php endforeach ?>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="content-box">
					<h3>Карта Тараз</h3>
					<div >
						<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=2h7leWyicJyXEv8XGLFF9mHgI9tJqWL6&width=&height=450"></script>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-box">

					<!-- контакты -->
					<?php foreach($kontakt2 as $id): ?>
					<h3 ><?php echo $id['staticpage_title'] ?></h3>
					<p>
						<?php echo $id['staticpage_text'] ?>
					</p>
					<?php endforeach ?>

				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<div class="box-title">
						<h2>Написать письмо</h2>
					</div>
				</div>
			</div>
					<form role="form">
						<div class="form-group">
							<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ваш Емайл">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Ваше имя">
						</div>
						<div class="form-group">
							<textarea class="form-control" rows="5"></textarea>
						</div>
						<!-- <div class="checkbox">
							<label>
								<input type="checkbox">Check me out
							</label>
						</div> -->
						<button type="submit" class="btn btn-default">Отправить Емайл</button>
					</form>
		</div>
	</div>
</section>
<!-- END CONTACT CONTENT