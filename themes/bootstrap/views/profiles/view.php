<?php 
$this->breadcrumbs=array(
	"Profile",);
$profileFields=ProfilesFields::model()->forOwner()->sort()->findAll();
?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
	<div class="flash_success">
		<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
	</div>
<?php endif; ?>

<table class="dataGrid">
	<tr>
		<th><?php echo CHtml::encode($model->getAttributeLabel('Username')); ?></th>
	    <td><?php echo CHtml::encode($model->username); ?></td>
	</tr>
	<?php 
		if ($profileFields) {
			foreach($profileFields as $field) {
				//echo "<pre>"; print_r($profile); die();
			?>
	<tr>
		<th><?php echo CHtml::encode($field->title); ?></th>
    	<td><?php 
			if ($field->varname=='tgllahir')
			{
				list($year, $month, $day) = explode('-', $profile->tgllahir);
				echo date('j F Y',mktime(0,0,0,$month,$day,$year));
			}
			else if ($field->varname=='gambar')
			{
				echo CHtml::image(Yii::app()->request->baseUrl."/images/Users/".$profile->gambar, "Profile Picture", array("class"=>"profile_picture_show"));
			}
			else
			{
				echo (($field->widgetView($profile))?$field->widgetView($profile):
				CHtml::encode((($field->range)?Profiles::range($field->range,$profile->getAttribute($field->varname)):
				$profile->getAttribute($field->varname)))); 
			}?>
		</td>
	</tr>
			<?php
			}//$profile->getAttribute($field->varname)
		}
	?>
	<tr>
		<th><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
    	<td><?php echo date('j F Y',$model->create_at); ?></td>
	</tr>
	<tr>
		<th><?php echo CHtml::encode($model->getAttributeLabel('lastvisit')); ?></th>
    	<td><?php echo date('j F Y',$model->lastvisit); ?></td>
	</tr>
</table>