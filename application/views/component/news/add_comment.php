add coment
<?php echo $this->session->flashdata('success'); ?>

		<?php $put='/admin/components/news/add_comment/'.$id ?>
		<?php echo form_open($put); ?>

			<p>Редактирование комментария</p>
				<!-- <textarea required name="zagolovok_comment" rows="1" cols="55" wrap="virtual"><?=$title;?></textarea> -->
			<p>Комментарий</p>
				<textarea required name="editor2" id="editor2" rows="10" cols="80"><?=$body;?></textarea>
			<script>
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
				CKEDITOR.replace( 'editor2' );
			</script>
			<input type="submit" value="Добавить &raquo;" class="btn btn-primary btn-lg">
		</form>