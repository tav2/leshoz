
		<form enctype="multipart/form-data" action="<?php $put='/admin/components/tovar/add_sub_category_img/'.$id; ?>" method="POST">
			<p>Изображение подкатегории</p>
			<!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
			<!-- <input type="hidden" name="MAX_FILE_SIZE" value="3000000" /> -->
			<!-- Название элемента input определяет имя в массиве $_FILES -->
			Загрузить файл: <input name="userfile" type="file" /><br>
			<input type="submit" value="Добавить &raquo;" class="btn btn-primary btn-lg">
		</form>
		<br><br>
		<div>
		<a href="/admin/components/tovar/edit_sub_category">назад</a>
		</div>