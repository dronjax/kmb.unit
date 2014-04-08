<div class="view">
	<li class="box">
		<div class="postim">
			<div class="btitle">
				<h2><a href="<?php echo CHtml::encode(Yii::app()->baseUrl.'/download/BB/'.$data->link_download); ?>" target="_blank"><?php echo CHtml::encode($data->tema); ?></a></h2>
			</div>
			<span class="inwriter"><?php echo CHtml::encode($data->bulan); echo" "; echo CHtml::encode($data->tahun); ?></span>
			<a href="<?php echo CHtml::encode(Yii::app()->baseUrl.'/download/BB/'.$data->link_download); ?>" target="_blank">
				<img class="bookcover" src="<?php echo CHtml::encode(Yii::app()->baseUrl.'/images/BB/'.$data->link_cover); ?>" alt=""/>
			</a>
		</div>
	</li>
</div>