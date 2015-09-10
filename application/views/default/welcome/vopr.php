
<div class="container">
	<h3>Часто задаваемые вопросы</h3>
	<!-- ACCORDION -->
	<div class="panel-group" id="accordion">

		<!-- вопросы -->
		<?php foreach($voprosi as $id): ?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $id['staticpage_content_id'] ?>">
						<?php echo $id['staticpage_title'] ?>
					</a>
				</h4>
			</div>
			<div id="collapse<?php echo $id['staticpage_content_id'] ?>" class="panel-collapse collapse">
				<div class="panel-body">
					<p>
						<?php echo $id['staticpage_text'] ?>
					</p>
				</div>
			</div>
		</div>

		<?php endforeach ?>



	</div>
</div>
	<!-- END ABOUT CONTENT