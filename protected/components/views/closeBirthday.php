<ul>
	<?php foreach($this->getCloseBirthday() as $birthday):
			$user=Users::model()->notsafe()->findByAttributes(array('id'=>$birthday->user_id));?>
	<li><?php echo CHtml::link(CHtml::encode($user->profiles->name), Yii::app()->createUrl('profiles/view', array(
            'username'=>$user->username,
			)));?> pada
		<?php 
			list($year, $month, $day) = explode('-', $birthday->tgllahir);
			echo date('j F',mktime(0,0,0,$month,$day,$year));
			?>
	</li>
	<?php endforeach; ?>
</ul>