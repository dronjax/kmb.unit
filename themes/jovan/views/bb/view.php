<?php
$this->breadcrumbs=array(
	'Bbs'=>array('index'),
	$model->ID,
);

?>

<h1>View Bb #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'bulan',
		'tahun',
		'tema',
		'link_cover',
		'link_download',
	),
)); ?>
