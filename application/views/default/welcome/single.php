
<section class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h1 class="page-title">Новость</h1>
					<span class="page-desc">Тут вы узнаете все о жизни компании «Горбань» и важных событиях в сфере строительства и недвижимости.</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				<!-- START BLOG POST -->
				<!-- POST -->
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
										<!-- <h5>Тэги</h5>
										<span><a href="javascript:;">Standard</a>
										</span> -->
										<h5>Комментарии</h5>
										<span><a href="javascript:;"><?=$this->news_model->get_num_comment($item['news_id']);?></a>
										</span>
									</div>
									<h2 class="post-title"><a href="welcome/single/<?=$item['news_id'];?>"><?=$item['news_name'];?></a>
									</h2>
									<div class="post-content">
										<p><?=$item['news_text'];?></p>
									</div>
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
										<!-- <h5>Тэги</h5>
										<span><a href="javascript:;">Картинки</a>
										</span> -->
										<h5>Комментарии</h5>
										<span><a href="javascript:;"><?=$this->news_model->get_num_comment($item['news_id']);?></a>
										</span>
									</div>
									<h2 class="post-title"><a href="welcome/single/<?=$item['news_id'];?>"><?=$item['news_name'];?> </a>
									</h2>
									<div class="post-content">
										<p><?=$item['news_text'];?></p>
									</div>
							<?php
							}
							?>
					<hr>
					<h2 class="post-title">Комментариев (<?=$this->news_model->get_num_comment($item['news_id']);?>)</h2>
					<?php
					}
					?>

									<div class="blog-comments">
											<!-- BLOG REPLY -->
											<!-- <h2 class="post-title">оставте сообщение
												<span>Ваш емай адрес не будет опубликован.</span>
											</h2> -->
											<form role="form" method="POST">
<!-- 												<div class="form-group row">
													<div class="col-md-8">
														<input required type="email" name="comment_email" class="form-control col-md-6" placeholder="Ваш емайл">
													</div>
												</div> -->
												<div class="form-group row">
													<div class="col-md-8">
														<input required type="text" name="comment_name" class="form-control" placeholder="Ваше имя">
													</div>
												</div>
												<div class="form-group row">
													<div class="col-lg-11">
														<textarea required class="form-control" name="comment_text" rows="10"></textarea>
													</div>
												</div>
												<br>
												<p>Вы можете использовать эти 
													<abbr title="HyperText Markup Language">HTML</abbr>&nbsp;тэги и атрибуты:
												</p>
												<code>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;strike&gt; &lt;strong&gt;</code>
												<p></p>
												<button type="submit" class="btn btn-default">Отправить комментарий</button>
											</form>
											<!-- END BLOG REPLY -->
											
											<div class="blog-comment-content">
												<ul class="media-list">

												<?php foreach($comments as $item)
												{
												?>
													<li class="media">
														<figure class="pull-left">
															<a href="javascript:;">
																<img class="media-object" src="assets/images/avatar-1.png" alt="comment-1">
															</a>
														</figure>
														<div class="media-body">
															<div class="comment-meta">
																<h4 class="media-heading"><a href="javascript:;"><?=$item['news_comment_name'];?></a>
																</h4>
																<span class="time">
																	<?=$item['news_comment_date'];?>
																</span>
																<div class="comment-extra pull-right">
																	<a href="javascript:;">Ответить <i class="fa fa-share"></i></a>
																</div>
															</div>
															<p>
																<?=$item['news_comment_text'];?>
															</p>
														</div>
													</li>
												<?php 
												}
												?>
												</ul>
											</div>
									</div>

								</article>
				<!-- END BLOG POST -->
				<!-- BLOG PAGINATION -->
				<ul class="pagination">
					<li class="pag-prev"><a href="#">&larr; prev</a>
					</li>
					<li class="pag-next"><a href="#">next &rarr;</a>
					</li>
				</ul>
				<!-- END -->
			</div>
			<!-- .shop-navbar -->
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-12">
						<div class="widget-box sidebar">
							<h3 class="wdgt-title">TOP PRODUCTS</h3>
							<ul class="wdgt-product">
								<li>
									<a href="javascript:;">
										<img src="assets/images/product-45x45.jpg" alt="">Aesop Quill Anti-Oxidant Grooming Kit
									</a>
									<span class="price">
										$300
									</span>
								</li>
								<li>
									<a href="javascript:;">
										<img src="assets/images/product-45x45.jpg" alt="">Aesop Quill Anti-Oxidant Grooming Kit
									</a>
									<span class="price">
										$300
									</span>
								</li>
								<li>
									<a href="javascript:;">
										<img src="assets/images/product-45x45.jpg" alt="">Aesop Quill Anti-Oxidant Grooming Kit
									</a>
									<span class="price">
										$300
									</span>
								</li>
							</ul>
						</div>
					</div>
					<!-- <div class="col-md-12">
						<div class="widget-box sidebar">
							<h3 class="wdgt-title">TAGS</h3>
							<ul class="wdgt-tags">
								<li><a href="javascript:;">Chair</a>
								</li>
								<li><a href="javascript:;">Brown</a>
								</li>
								<li><a href="javascript:;">Good Stuff</a>
								</li>
								<li><a href="javascript:;">Exclusive</a>
								</li>
								<li><a href="javascript:;">Living Room</a>
								</li>
								<li><a href="javascript:;">Big Chair</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-12">
						<div class="widget-box sidebar">
							<h3 class="wdgt-title">NEWSLETTER</h3>
							<p>Phasellus quis lectus metus, at posuere neque pharetra nibh.</p>
							<form>
								<input type="text" name="newsletter" class="input-black">
								<input type="submit" name="Subscribe" class="btn-black" value="Subscribe">
							</form>
						</div>
					</div> -->
					<div class="col-md-12">
						<div class="widget-box sidebar">
							<h3 class="wdgt-title">SHOP BY BRANDS</h3>
							<ul class="wdgt-ul">
								<li><a href="javascript:;">Maroon Sky</a>
								</li>
								<li><a href="javascript:;">Charlizseky</a>
								</li>
								<li><a href="javascript:;">Alamanda Series</a>
								</li>
								<li><a href="javascript:;">HUGO BOSS</a>
								</li>
								<li><a href="javascript:;">Preminioz</a>
								</li>
								<li><a href="javascript:;">Avalantzche</a>
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