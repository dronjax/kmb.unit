<?php
$this->breadcrumbs=array(
	'Kusaladhana'=>array('index'),
	'Tambah Anggaran',
);
?>

<h1>Tambah Anggaran Kusaladhana</h1>
<hr/>

<div class="form">

<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>

	<div class="row">
		<?php echo CHtml::activeLabel($model,'anggaranimg'); ?>
		<?php echo CHtml::activeFileField($model, 'anggaranimg'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Buat'); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->