<?php $this->beginContent('//layouts/main'); ?>
<div class="content">
	<div class="content_resize">
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
					$this->widget('CloseBirthday');
					$this->widget('RecentComments');
				}
				else
				{
					echo '<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FKMB.Dhammanano.ITB&amp;width=220&amp;height=427&amp;colorscheme=light&amp;show_faces=false&amp;border_color&amp;stream=true&amp;header=true&amp;appId=192855437509108" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:220px; height:427px;" allowTransparency="true"></iframe>';
				}
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
						),
						'htmlOptions'=>array('class'=>'gadget'),
					));
					
					$this->endWidget();
				}
			?>         
		</div><!-- sidebar -->
		<div class="clr"></div>
	</div>
</div><!-- content -->
<?php $this->endContent(); ?>