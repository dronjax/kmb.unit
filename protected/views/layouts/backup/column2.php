<?php $this->beginContent('//layouts/main'); ?>
<div class="span-18">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-6 last">
	<div id="sidebar">
	<?php
		$user=Users::model()->IsAdmin();
		if (!Yii::app()->user->IsGuest)
		{
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operations',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		}
		if ($user>=1)
		{
			$this->widget('UserMenu'); 
		}
		if ($user>=2)
		{
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Admin',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
					array('label'=>'Manage Users', 'url'=>array('/users/admin')),
				),
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		}
		if (!Yii::app()->user->isGuest)
		{
			$this->widget('CloseBirthday');
			$this->widget('RecentComments');
		}
		?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>