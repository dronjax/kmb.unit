<?php
$this->breadcrumbs=array(
	'Bbs'=>array('index'),
	'Create',
);
?>

<h1>Tambah Bhadra Bodhi</h1>
<hr/>

<div class="form">

<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::activeLabel($model,'bulan'); ?>
		<?php echo CHtml::dropDownList('bulan', 'Januari', 
              array('Januari' => 'Januari',
					'Februari' => 'Februari',
					'Maret' => 'Maret',
					'April' => 'April',
					'Mei' => 'Mei',
					'Juni' => 'Juni',
					'Juli' => 'Juli',
					'Agustus' => 'Agustus',
					'September' => 'September',
					'Oktober' => 'Oktober',
					'November' => 'November',
					'Desember' => 'Desember')); ?>
		<?php echo CHtml::error($model,'bulan'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabel($model,'tahun'); ?>
		<?php echo CHtml::textField('tahun','',array()); ?>
		<?php echo CHtml::error($model,'tahun'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabel($model,'tema'); ?>
		<?php echo CHtml::textArea('tema','',array('rows'=>2, 'cols'=>50)); ?>
		<?php echo CHtml::error($model,'tema'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabel($model2,'cover'); ?>
		<?php echo CHtml::activeFileField($model2, 'cover'); ?>
	</div>
	
	<div class="row">
		<?php echo CHtml::activeLabel($model2,'isi'); ?>
		<?php echo CHtml::activeFileField($model2, 'isi'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Buat' : 'Simpan'); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->