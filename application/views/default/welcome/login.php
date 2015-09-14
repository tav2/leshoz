
<section class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="content-box">

					<span class="label label-success"><?php echo $this->session->flashdata('login_success'); ?></span>

					<form class="form" method="post">
						<fieldset>
							<legend>Вход</legend>
							<div class="form-group">
								<label for="inputName10" class="control-label">Ваш емайл</label>
								<input required type="text" name="name_login" class="form-control" id="inputName10" placeholder="Имя">
							</div>
							<div class="form-group">
								<label for="inputPassword10" class="control-label">Пароль</label>
								<input required type="password" name='password_login' class="form-control" id="inputPassword10" placeholder="Пароль">
							</div>
							<!-- <div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox">Запомнить меня?
									</label>
								</div>
							</div> -->
							<div class="form-group">
								<!-- <button type="button" class="btn btn-primary">Войти</button> -->
								<input type="submit" value="Войти" class="btn-black">
								<!-- <button type="button" class="btn btn-default">Reset</button> -->
							</div>
						</fieldset>
					</form>
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-box">

					<?php echo validation_errors(); ?>
					<!-- <span class="label label-warning"><?php //echo validation_errors(); ?></span> -->
		
					<span class="label label-success"><?php echo $this->session->flashdata('customer_success'); ?></span>

					<?php echo form_open('welcome/login'); ?>
						<fieldset>
							<legend>Создать пользователя</legend>
							<div class="form-group">
								<label for="inputEmail11" class="control-label">Емайл</label>
								<input required type="email" name="email_create" class="form-control" id="inputEmail11" placeholder="Ваш емайл">
								<!-- <small>May contain letters, digits, dashes and underscores, and should be between 2 and 20 characters long.</small> -->
							</div>
							<div class="form-group">
								<label for="inputPassword11" class="control-label">Имя</label>
								<input required type="text" name="name_create" class="form-control" id="inputPassword11" placeholder="ваше имя">
							</div>
							<div class="form-group">
								<label for="inputPassword12" class="control-label">Пароль</label>
								<input required type="password" name="password_create" class="form-control" id="inputPassword12" placeholder="Пароль">
							</div>
							<div class="form-group">
								<label for="inputPasswords12" class="control-label">Повторите пароль</label>
								<input required type="password" name="password_create_povtor" class="form-control" id="inputPasswords12" placeholder="Повторите пароль">
							</div>
							<div class="form-group">
								<label for="inputPasswords12" class="control-label">Телефон или другую информацию</label>
								<input type="text" name="contact_create" class="form-control" id="inputPasswords12" placeholder="Контакты">
							</div>
							<div class="form-group">
								<div class="well">
									<p>
										Так же аккаунт создаются при приобретени товаров.
									</p>
								</div>
							</div>
							<!-- <div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox">Sign me up for the newsletter (provided by MailChimp)
									</label>
								</div>
							</div> -->
							<div class="form-group">
								<!-- <button type="button" class="btn btn-primary">Создать</button> -->
								<input type="submit" value="Создать" class="btn-black">
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
