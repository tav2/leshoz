edit_comment
<div class="row">

	<h2>Комментарии:</h2>

		<?php foreach ($news_comments as $item): ?>

			<!-- берем небольшой отрезок из новости -->
			<?php $preview = $this->dbmodel->get_preview($item['news_comment_text']); ?>

			<div class="col-md-4 ">
			<p><?=$preview;?></p>
			<p><?=$item['news_comment_date'];?> от <?=$this->dbmodel->get_user($item['user_id']);?></p>

			<p><a class="btn btn-default" href="/admin/components/news/add_comment/<?=$item['news_comment_id'];?>" role="button">редактировать &raquo;</a>
			<a class="btn btn-default" href="/admin/components/news/dell_comment/<?=$item['news_comment_id'];?>" role="button">удалить &raquo;</a></p>
			<hr>
			</div>

		<?php endforeach ?>
</div>
<?php echo $this->pagination->create_links();?>