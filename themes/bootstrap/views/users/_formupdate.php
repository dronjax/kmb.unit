<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->label($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'superuser'); ?>
		<?php echo $form->dropDownList($model,'superuser',array(1=>1,2=>2),array(
					'options'=>array($model->superuser=>array('selected'=>'selected')))); ?>
		<?php echo $form->error($model,'superuser'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Ubah'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->