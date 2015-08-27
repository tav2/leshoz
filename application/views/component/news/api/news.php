<?php 

foreach($rez as $item)
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