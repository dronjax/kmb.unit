<ul>
	<?php foreach($this->getRecentComments() as $comment): ?>
	<li><?php echo CHtml::link(CHtml::encode($comment->author), Yii::app()->createUrl('profiles/view', array(
            'username'=>$comment->author,
			)), array(
			'submit' => Yii::app()->createUrl('profiles/view', array(
            'username'=>$comment->author,
			))
		));?> pada
		<?php echo CHtml::link(CHtml::encode($comment->post->title), $comment->getUrl()); ?>
	</li>
	<?php endforeach; ?>
</ul>