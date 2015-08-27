addnews
<?php echo $this->session->flashdata('success'); ?>

		<?php //$put='/admin/components/news/add_news/'.$id ?>
		<form enctype="multipart/form-data" action="<?php $put='/admin/components/news/add_news/'.$id ?>" method="POST">

			<p>Название новости</p>
				<textarea required name="zagolovok" rows="1" cols="55" wrap="virtual"><?=$title;?></textarea>
			<p>тип новости</p>
				   <p><select size="2" multiple name="type">
				    <option disabled>Выберите тип</option>
				    <option <?=$selekt0;?> value="0">Текстовая</option>
				    <option <?=$selekt1;?> value="1">С картинкой</option>
				    <option <?=$selekt2;?> value="2">Единичное сообщение</option>
				    <option <?=$selekt3;?> value="3">С видео</option>
				   </select></p>
			<p>Новость</p>
				<textarea required name="editor1" id="editor1" rows="10" cols="80"><?=$body;?></textarea>
			<script>
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
				CKEDITOR.replace( 'editor1' );
			</script>
			<p>Дополнительная картинка</p>
		    <!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
		    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
		    <!-- Название элемента input определяет имя в массиве $_FILES -->
		    Загрузить этот файл: <input name="upload" type="file" />
			<input type="submit" value="Добавить &raquo;" class="btn btn-primary btn-lg">
		</form>
		<br><br>
		<!-- подгружаем картинку -->
		<p>Дополнительная картинка</p>
			<?php echo $this->session->flashdata('success'); ?>
		<div>
			<!-- <img src="<?php //if(isset($uploadfile)) echo $uploadfile; ?>" alt="пусто"> -->
			<?php echo $this->session->flashdata('success'); ?>
		</div>