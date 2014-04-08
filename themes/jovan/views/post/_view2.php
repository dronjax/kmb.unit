<div class="post">
	<div class="title">
		<div class="datebox">
			<span class="month"><?php echo date('M',$data->create_time); ?></span>
			<span class="date"><?php echo date('d',$data->create_time); ?></span>
		</div>
		<h2>
			<?php 
				echo CHtml::encode($data->title);
				$profile=Profiles::model()->findByAttributes(array('user_id'=>$data->author->id));
				$images=Images::model()->findAllByAttributes(array('post_id'=>$data->id));
			?>
		</h2>
	</div>
	
	<div class="cover">
		<?php
			if (count($images)>0)
			{
		?>
				<div class="kiri">
					<a href="javascript:kiri<?php echo $data->id ?>()">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/segitiga.png" />
					</a>
				</div>
				<div class="outer_container" >
					<div id="inner_container<?php echo $data->id ?>" class="inner_container" >
						<?php
							$i = 0;
							foreach($images as $image)
							{
								$i++;
								echo '<div class="item_images" >';
									echo '<img id="gambar_'.$image->id.'" class="post_image"  src="'.Yii::app()->baseUrl."/images/Post/".$image->image_url.'" />';
								echo '</div>';
							}
						?>
					</div>
				</div>
				<div class="kanan">
					<a href="javascript:kanan<?php echo $data->id ?>()">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/segitiga.png" />
					</a>
				</div>
		<?php
			}
		?>
		<div class="clear"></div>
		<div class="entry">
			<?php
				$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
				echo $data->content;
				$this->endWidget();
			?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="singleinfo">
		<?php
			if (Yii::app()->user->isGuest)
			{
		?>
			<span class="comm"> Ditulis  <?php echo ' pada ' . date('j F Y',$data->create_time); ?></span>
		<?php
			}
			else
			{
		?>
			<span class="comm"> Ditulis oleh 
			<?php
				echo CHtml::link(CHtml::encode($data->author->username . ' ('. $profile->name .')'), Yii::app()->createUrl('profiles/view', array(
					'username'=>$data->author->username,
					)), array(
					'submit' => Yii::app()->createUrl('profiles/view', array(
					'username'=>$data->author->username,
					))
				));
				echo ' pada ' . date('j F Y',$data->create_time) ?></span>
			<span class="morer"> <?php echo CHtml::link("{$data->commentCount} Komentar",$data->url.'#comments'); ?> </span>
		<?php
			}
		?>
	</div>
</div>
<?php
	if (count($images)>0)
	{
?>
		<script type="text/javascript">
			var cont_pos<?php echo $data->id ?> = $("#inner_container<?php echo $data->id ?>").position();
			cont_pos<?php echo $data->id ?>.left = 62;
			var item_width = $(".item_images").width()+20;
			var items<?php echo $data->id ?> = $("#inner_container<?php echo $data->id ?> > div.item_images").length;
			var item_index<?php echo $data->id ?> = 1;
			var cont_post_temp<?php echo $data->id ?>;
			
			function bindMouseUp<?php echo $data->id ?>() {
				$("#inner_container<?php echo $data->id ?>").draggable({ axis: "x", revert:false});
				$("#inner_container<?php echo $data->id ?>").unbind('mouseup');
				cont_post_temp<?php echo $data->id ?> = $("#inner_container<?php echo $data->id ?>").position().left;
				if (cont_pos<?php echo $data->id ?>.left > cont_post_temp<?php echo $data->id ?> && item_index<?php echo $data->id ?> != items<?php echo $data->id ?>) {
					// swipe to right
					var moveLeftawal = (cont_pos<?php echo $data->id ?>.left - cont_post_temp<?php echo $data->id ?>);
					var moveLeft = Math.abs(item_width - moveLeftawal);
					if (item_width > moveLeftawal)
					{
						$("#inner_container<?php echo $data->id ?>").animate({
							left: '-=' + moveLeft
						}, 500, function() {
							cont_pos<?php echo $data->id ?> = $("#inner_container<?php echo $data->id ?>").position();
							$("#inner_container<?php echo $data->id ?>").bind('mouseup', function() {
								bindMouseUp<?php echo $data->id ?>();
							});
						});
					}
					else
					{
						$("#inner_container<?php echo $data->id ?>").animate({
						left: '+=' + moveLeft
						}, 500, function() {
							cont_pos<?php echo $data->id ?> = $("#inner_container<?php echo $data->id ?>").position();
							$("#inner_container<?php echo $data->id ?>").bind('mouseup', function() {
								bindMouseUp<?php echo $data->id ?>();
							});
						});
					}
					item_index<?php echo $data->id ?>++;;
				} else if (cont_pos<?php echo $data->id ?>.left < cont_post_temp<?php echo $data->id ?> && item_index<?php echo $data->id ?> != 1) {
					// swipe to left
					var moveLeftawal = cont_post_temp<?php echo $data->id ?> - cont_pos<?php echo $data->id ?>.left;
					var moveLeft = Math.abs(item_width - moveLeftawal);
					if (item_width > moveLeftawal)
					{
						$("#inner_container<?php echo $data->id ?>").animate({
							left: '+=' + moveLeft
						}, 500, function() {
							cont_pos<?php echo $data->id ?> = $("#inner_container<?php echo $data->id ?>").position();
							$("#inner_container<?php echo $data->id ?>").bind('mouseup', function() {
								bindMouseUp<?php echo $data->id ?>();
							});
						});
					}
					else
					{
						$("#inner_container<?php echo $data->id ?>").animate({
							left: '-=' + moveLeft
						}, 500, function() {
							cont_pos<?php echo $data->id ?> = $("#inner_container<?php echo $data->id ?>").position();
							$("#inner_container<?php echo $data->id ?>").bind('mouseup', function() {
								bindMouseUp<?php echo $data->id ?>();
							});
						});
					}
					item_index<?php echo $data->id ?> = item_index<?php echo $data->id ?> - 1;
				} else if (cont_pos<?php echo $data->id ?>.left == cont_post_temp<?php echo $data->id ?>)
				{
					$(".post_image").bind("click",clickhandler);
					$("#inner_container<?php echo $data->id ?>").bind('mouseup', function() {
						bindMouseUp<?php echo $data->id ?>();
					});
				} else {
					// on the beginning or end item swipe
					var moveLeft = Math.abs(cont_post_temp<?php echo $data->id ?> - cont_pos<?php echo $data->id ?>.left);
					if (item_index<?php echo $data->id ?> == items<?php echo $data->id ?>)
					{
						$("#inner_container<?php echo $data->id ?>").animate({
							left: '+=' + moveLeft
						}, 500, function() {
							cont_pos<?php echo $data->id ?> = $("#inner_container<?php echo $data->id ?>").position();
							$("#inner_container<?php echo $data->id ?>").bind('mouseup', function() {
								bindMouseUp<?php echo $data->id ?>();
							});
						});
					}
					else
					{
						$("#inner_container<?php echo $data->id ?>").animate({
							left: '-=' + moveLeft
						}, 500, function() {
							cont_pos<?php echo $data->id ?> = $("#inner_container<?php echo $data->id ?>").position();
							$("#inner_container<?php echo $data->id ?>").bind('mouseup', function() {
								bindMouseUp<?php echo $data->id ?>();
							});
						});
					}
				}
			}
			
			$(document).ready(function() {
				
				$("#inner_container<?php echo $data->id ?>").draggable({ axis: "x"});
				
				$("#inner_container<?php echo $data->id ?>").mouseup(function() {
					bindMouseUp<?php echo $data->id ?>();
				});
			});
			
			function kiri<?php echo $data->id ?>()
			{
				if (item_index<?php echo $data->id ?>!=1)
				{
					$("#inner_container<?php echo $data->id ?>").unbind('mouseup');
					$("#inner_container<?php echo $data->id ?>").animate({
						left: '+=' + item_width
					}, 500, function() {
						cont_pos<?php echo $data->id ?> = $("#inner_container<?php echo $data->id ?>").position();
						$("#inner_container<?php echo $data->id ?>").bind('mouseup', function() {
							bindMouseUp<?php echo $data->id ?>();
						});
					});
					item_index<?php echo $data->id ?> = item_index<?php echo $data->id ?> - 1;
				}
			}
			
			function kanan<?php echo $data->id ?>()
			{
				if (item_index<?php echo $data->id ?>!=items<?php echo $data->id ?>)
				{
					$("#inner_container<?php echo $data->id ?>").unbind('mouseup');
					$("#inner_container<?php echo $data->id ?>").animate({
						left: '-=' + item_width
					}, 500, function() {
						cont_pos<?php echo $data->id ?> = $("#inner_container<?php echo $data->id ?>").position();
						$("#inner_container<?php echo $data->id ?>").bind('mouseup', function() {
							bindMouseUp<?php echo $data->id ?>();
						});
					});
					item_index<?php echo $data->id ?>++;
				}
			}
		</script>
<?php
	}
?>