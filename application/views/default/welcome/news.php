
<section class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h1 class="page-title">Наши новости</h1>
					<span class="page-desc"> Тут вы узнаете все о жизни компании «Горбань» и важных событиях в сфере строительства и недвижимости.
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				<!-- START BLOG POST -->
				<!-- POST -->
				<?php //echo $api_get_category ?>
				<?php 

					foreach($news as $item)
					{

						if( $item['news_type']=='0' )//текстовые новости
							{ ?>
								<article class="post">
									<div class="post-meta">
										<a class="post-icon" href="welcome/single/<?=$item['news_id'];?>"><i class="fa fa-file-text-o"></i></a>
										<h5>Опубликовано</h5>
										<span class="published"><?=$item['news_date'];?></span>
										<h5>Тэги</h5>
										<span><a href="javascript:;">Standard</a>
										</span>
										<h5>Комментарии</h5>
										<span><a href="javascript:;">2</a>
										</span>
									</div>
									<h2 class="post-title"><a href="welcome/single/<?=$item['news_id'];?>"><?=$item['news_name'];?></a>
									</h2>
									<div class="post-content">
										<p><?=$item['news_text'];?></p>
										<p><a href="welcome/single/<?=$item['news_id'];?>" class="read-more">Узнать больше</a>
										</p>
									</div>
								</article>
							<?php
							}

						if( $item['news_type']=='1' ) //новости с картинкой
							{ ?>
								<article class="post">
									<figure>
										<a href="welcome/single/<?=$item['news_id'];?>">
											<img src="<?=$this->news_model->get_img_put($item['news_id']);?>" alt="">
										</a>
									</figure>
									<div class="post-meta">
										<a class="post-icon" href="welcome/single/<?=$item['news_id'];?>"><i class="fa fa-camera"></i></a>
										<h5>Опубликованно</h5>
										<span class="published"><?=$item['news_date'];?></span>
										<h5>Тэги</h5>
										<span><a href="javascript:;">Картинки</a>
										</span>
										<h5>Комментарии</h5>
										<span><a href="javascript:;">2</a>
										</span>
									</div>
									<h2 class="post-title"><a href="welcome/single/<?=$item['news_id'];?>"><?=$item['news_name'];?> </a>
									</h2>
									<div class="post-content">
										<p><?=$item['news_text'];?></p>
										<p><a href="welcome/single/<?=$item['news_id'];?>" class="read-more">Узнать больше</a>
										</p>
									</div>
								</article>
							<?php
							}

						if( $item['news_type']=='2' )//единичное сообщение
							{ ?>
								<article class="post">
									<div class="post-meta">
										<a class="post-icon" href="news"><i class="fa fa-pencil"></i></a>
									</div>
									<div class="post-content">
										<p><?=$item['news_name'];?></p>
									</div>
								</article>
							<?php
							}
					}


					?>
				<!-- END BLOG POST -->
				<!-- BLOG PAGINATION -->
				<ul class="pagination">
					<li class="pag-prev"><a href="#">&larr; прдыдущее</a>
					</li>
					<li class="active"><a href="#">1</a>
					</li>
					<li><a href="#">2</a>
					</li>
					<li><a href="#">3</a>
					</li>
					<li class="pag-next"><a href="#">следующее &rarr;</a>
					</li>
				</ul>
				<!-- END -->
			</div>
			<!-- .shop-navbar -->
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-12">
						<div class="widget-box sidebar">
							<h3 class="wdgt-title">Топ продаж</h3>
							<ul class="wdgt-product">
								<li>
									<a href="javascript:;">
										<img src="assets/images/product-45x45.jpg" alt="">Дом большой светлый
									</a>
									<span class="price">
										$300
									</span>
								</li>
								<li>
									<a href="javascript:;">
										<img src="assets/images/product-45x45.jpg" alt="">Доски ровные длинные
									</a>
									<span class="price">
										$300
									</span>
								</li>
								<li>
									<a href="javascript:;">
										<img src="assets/images/product-45x45.jpg" alt="">Беседка узорная дачная
									</a>
									<span class="price">
										$300
									</span>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-12">
						<div class="widget-box sidebar">
							<h3 class="wdgt-title">ТЭГИ</h3>
							<ul class="wdgt-tags">
								<li><a href="javascript:;">Стулья</a>
								</li>
								<li><a href="javascript:;">Дома</a>
								</li>
								<li><a href="javascript:;">Сообщение</a>
								</li>
								<li><a href="javascript:;">Эксклюзив</a>
								</li>
								<li><a href="javascript:;">Видео</a>
								</li>
								<li><a href="javascript:;">Картинки</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-12">
						<div class="widget-box sidebar">
							<h3 class="wdgt-title">РАССЫЛКА</h3>
							<p>Введине свой емайл чтобы получать новости</p>
							<form>
								<input type="text" name="newsletter" class="input-black">
								<input type="submit" name="Subscribe" class="btn-black" value="отправить">
							</form>
						</div>
					</div>
					<div class="col-md-12">
						<div class="widget-box sidebar">
							<h3 class="wdgt-title">Покупайте у нас</h3>
							<ul class="wdgt-ul">
								<li><a href="javascript:;">Дома</a>
								</li>
								<li><a href="javascript:;">Бани</a>
								</li>
								<li><a href="javascript:;">Погонаж</a>
								</li>
								<li><a href="javascript:;">Беседки</a>
								</li>
								<li><a href="javascript:;">Мебель</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--/.shop-navbar-->
		</div>
	</div>
	<!-- /.container -->
</section>
<!-- END DETAIL PRODUCT CONTENT