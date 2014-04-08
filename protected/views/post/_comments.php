<?php 
$temp=Users::model()->findByAttributes(array('username'=>$data->author));
$profile=Profiles::model()->findByAttributes(array('user_id'=>$temp->id));
?>
<div class="comment" id="c<?php echo $data->id; ?>">

	<?php 
	if ($data->author==Yii::app()->user->name || Users::model()->isAdmin())
	{
		echo CHtml::link("Hapus", '/betterkmb/index.php/comment/delete/'.$data->id, array(
			'confirm'=>'Apakah anda yakin?',
			'submit' => '/betterkmb/index.php/comment/delete/'.$data->id,
			'params' => array(
				'url' => Yii::app()->createUrl('/post/'.$post->id.'/'),
			),
			'class'=>'cid',
			'title'=>'Hapus komen ini',
		)); 
	}
	?>

	<div class="author">
		<?php echo $data->author . ' ('. $profile->name .')'; ?> says:
	</div>

	<div class="time">
		<?php echo date('F j, Y \a\t h:i a',$data->create_time); ?>
	</div>

	<div class="content">
		<?php echo nl2br(CHtml::encode($data->content)); ?>
	</div>

</div><!-- comment -->