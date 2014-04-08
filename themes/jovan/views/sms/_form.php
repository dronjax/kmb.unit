<div class="form">

<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'sms-form',
		'enableAjaxValidation'=>false,
	)); 
	$user=Users::model()->notsafe()->findAll();
	$search=array();
	foreach ($user as $use)
	{
		$profile=Profiles::model()->findByPk($use->id);
		$temp=$use->id.'. ' .$profile->name;
		array_push($search,$temp);
	}
?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->label($model,'tujuan'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name'=>'city',
				'source'=>$search,
				// additional javascript options for the autocomplete plugin
				'options'=>array(
					'minLength'=>'2',
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;'
				),
			)); 
		?>
		<?php echo $form->error($model,'tujuan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isi'); ?>
		<?php echo $form->textArea($model,'isi',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'isi'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->