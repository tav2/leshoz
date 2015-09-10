<?php //echo $this->session->flashdata('success'); ?>

		<?php //$put=''; ?>
		<form enctype="multipart/form-data" action="<?php $put='/admin/components/tovar/add_img/'.$id; ?>" method="POST">
		<?php //echo form_open_multipart($put);?>
		<?php //echo "путь:".$put; ?>

			<!-- <p>Название изображения</p>
				<textarea name="tovar_img_name" rows="1" cols="55" wrap="virtual"></textarea> -->
			<p>тип изображения</p>
				   <p><select name="tovar_img_type">
					<option selected disabled>Выберите тип</option>
					<option  value="0">Вид товара</option>
					<option  value="1">Схема</option>
					<option  value="2">Другое</option>
					<!-- <option  value="3">С видео</option> -->
				   </select></p>
			
			<p>Изображение товара</p>
			<!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
			<!-- <input type="hidden" name="MAX_FILE_SIZE" value="3000000" /> -->
			<!-- Название элемента input определяет имя в массиве $_FILES -->
			Загрузить файл: <input name="userfile" type="file" /><br>
			<input type="submit" value="Добавить &raquo;" class="btn btn-primary btn-lg">
		</form>
		<br><br>
		<div>
		<a href="/admin/components/tovar/edit_tovar">назад</a>
		</div>