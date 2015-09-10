<?php echo $this->session->flashdata('success'); ?><br>
<form enctype="multipart/form-data" action="<?php $put='/admin/components/galereya/add_galereya_img/'.$id; ?>" method="POST">

	<p>Изображение товара</p>
	<!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
	<!-- <input type="hidden" name="MAX_FILE_SIZE" value="3000000" /> -->
	<!-- Название элемента input определяет имя в массиве $_FILES -->
	Загрузить файл: <input name="userfile" type="file" /><br>
	<input type="submit" value="Добавить &raquo;" class="btn btn-primary btn-lg">
</form>
<br><br>
<div>
<a href="/admin/components/galereya/edit_galereya">назад</a>
</div>