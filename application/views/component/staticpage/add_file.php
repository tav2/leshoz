<?php echo $this->session->flashdata('success'); ?>

		<?php //$put=''; ?>
		<form enctype="multipart/form-data" action="<?php $put='/admin/components/staticpage/add_file/'.$id; ?>" method="POST">
			<p>Файлы страницы</p><hr>
			Загрузить файл: <input name="userfile" type="file" /><br>
			<input type="submit" value="Добавить &raquo;" class="btn btn-primary btn-lg">
		</form>
		<br><br>
		<div>
		<a href="/admin/components/staticpage/page_edit">назад</a>
		</div>