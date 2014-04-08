<h1> Upload File BB </h1>

<div class="form">
	<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>

	<div class="row">
		<?php echo CHtml::activeLabel($model,'cover'); ?>
		<?php echo CHtml::activeFileField($model, 'cover'); ?>
	</div>
	<p>File cover akan berada pada link kmb.unit.itb.ac.id/images/BB/namafile</p>
	
	<div class="row">
		<?php echo CHtml::activeLabel($model,'isi'); ?>
		<?php echo CHtml::activeFileField($model, 'isi'); ?>
	</div>
	<p>File BB akan berada pada link kmb.unit.itb.ac.id/download/BB/namafile</p>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Unggah'); ?>
	</div>
	<?php echo CHtml::endForm(); ?>
</div>