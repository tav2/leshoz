edit_news
<div class="row">

	<h2>Ваши новости:</h2>

		<?php foreach ($news as $item): ?>

			<!-- берем небольшой отрезок из новости -->
			<?php $preview = $this->dbmodel->get_preview($item['news_text']); ?>

			<div class="col-md-4 ">
			<h2><?=$item['news_name'];?></h2>
			<p><?=$preview;?></p>
			<p><?=$item['news_date'];?> от <?=$this->dbmodel->get_user($item['user_id']);?> - </p>

			<p><a class="btn btn-default" href="/admin/components/news/add_news/<?=$item['news_id'];?>" role="button">редактировать &raquo;</a>
			<a class="btn btn-default" href="/admin/components/news/dell_news/<?=$item['news_id'];?>" role="button">удалить &raquo;</a></p>
			
			</div>
			<?php $img = $this->dbmodel->get_img($item['news_id']); ?>
			<?php //echo $img;?>
					<div>
						<h2>картинка</h2>
						<img src="<?=$img;?>" alt="картинок нет">
						<br>
						<?php if ($img!='') { ?>
						<a class="btn btn-default" href="/admin/components/news/dell_img/<?=$item['news_id'];?>" role="button">удалить картинку &raquo;</a></p>
						<?php } ?>
					</div>
					<hr>
		<?php endforeach ?>
</div>
<?php echo $this->pagination->create_links();?>

