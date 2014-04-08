<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->label($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'nama'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tempat'); ?>
		<?php echo $form->textField($model,'tempat',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'tempat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'waktu'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'language'=>'en',
			'model'=>$model,
			'name'=>'Event[waktu]',
			'id'=>'Event_waktu',
			'value'=>$model->waktu,
			// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'yy-mm-dd',
				'defaultDate'=>'$( ".selector" ).datepicker( "option", "defaultDate");',
			),)); ?>
		<?php echo $form->error($model,'waktu'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'jam'); ?>
		<?php echo $form->textField($model,'jam'); ?>
		<?php echo $form->error($model,'jam'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'menit'); ?>
		<?php echo $form->textField($model,'menit'); ?>
		<?php echo $form->error($model,'menit'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Buat' : 'Simpan'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->