<?php $this->beginContent('//layouts/main'); ?>
<div class="content">
    <div class="mainbar">
		<?php echo $content; ?>
	</div><!-- content -->
	<?php 
		if (Yii::app()->user->IsGuest)
		{
			$user = -1;
		}
		else
		{
			$user=Users::model()->IsAdmin();
		}
	?>
		<div class="sidebar">
            <?php
			if ($user!=-1)
			{
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title'=>'Menu Pengguna',
					'htmlOptions'=>array('class'=>'gadget'),
				));
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'gadget'),
				));
				$this->endWidget();
				if ($user>=1)
				{
					$this->widget('menudemiadmin');
				}
				if ($user>=2)
				{
					$this->beginWidget('zii.widgets.CPortlet', array(
							'title'=>'Menu Admin',
							'htmlOptions'=>array('class'=>'gadget'),
					));
					$this->widget('zii.widgets.CMenu', array(
							'items'=>array(
									array('label'=>'Mengatur Pengguna', 'url'=>array('/users/admin')),
									array('label'=>'Mengatur Grup', 'url'=>array('/group_name/admin')),
									array('label'=>'Mengatur Website', 'url'=>array('/site/config')),
							),
							'htmlOptions'=>array('class'=>'gadget'),
					));
				
					$this->endWidget();
				}
				$this->widget('CloseBirthday');
				$this->widget('RecentComments');
			}
			if (Yii::app()->params["production"])
			{
				echo '<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FKMB.Dhammanano.ITB&amp;width=292&amp;height=290&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=true&amp;header=true&amp;appId=192855437509108" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:290px;" allowTransparency="true"></iframe>';
				echo '<br />';
				echo '<br />';
				echo '<a class="twitter-timeline" href="https://twitter.com/kmb_itb" data-widget-id="343579763341938689">Tweets by @kmb_itb</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
			}
		?>         
	</div><!-- sidebar -->
	<div class="clr"></div>
</div><!-- content -->
<?php $this->endContent(); ?>
