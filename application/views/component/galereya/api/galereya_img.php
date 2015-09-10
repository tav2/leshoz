
<?php foreach($galereya_img as $item): ?>

			<div class="col-md-3">
				<figure>
						<a href="<?php echo $item['galereya_img_adres'] ?>" data-lightbox="roadtrip" data-title=""><img src="<?php echo $item['galereya_img_adres'] ?>" alt="" ></a>
				</figure>
			</div>

<?php endforeach ?>