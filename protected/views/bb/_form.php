<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bb-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->label($model,'bulan'); ?>
		<?php echo $form->textField($model,'bulan',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'bulan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tahun'); ?>
		<?php echo $form->textField($model,'tahun'); ?>
		<?php echo $form->error($model,'tahun'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tema'); ?>
		<?php echo $form->textArea($model,'tema',array('rows'=>2, 'cols'=>50)); ?>
		<?php echo $form->error($model,'tema'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'link_cover'); ?>
		<?php if ($model->isNewRecord) echo '<textarea rows="2" cols="50" name="Bb[link_cover]" id="Bb_link_cover">/betterkmb/images/BB/namafile</textarea>';
				else echo $form->textArea($model,'link_cover',array('rows'=>2, 'cols'=>50)); ?>
		<?php echo $form->error($model,'link_cover'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'link_download'); ?>
		<?php if ($model->isNewRecord) echo'<textarea rows="2" cols="50" name="Bb[link_download]" id="Bb_link_download">/betterkmb/download/BB/namafile</textarea>';
				else echo $form->textArea($model,'link_download',array('rows'=>2, 'cols'=>50)); ?>
		<?php echo $form->error($model,'link_download'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Buat' : 'Simpan'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->