<?php
$this->breadcrumbs=array(
	'Bbs'=>array('index'),
	'Manage',
);

?>

<h1>Mengatur Bhadra Bodhi</h1>
<hr />

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bb-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'bulan',
		'tahun',
		'tema',
		'link_cover',
		'link_download',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
