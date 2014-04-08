<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

?>

<h1>Mengatur Pengguna</h1>
<hr />
<span style="float:right;"><?php echo CHtml::link("Download CSV",Yii::app()->request->baseUrl."/users/downloadCSV",array("class"=>"link_blue")); ?></span>
<div style="clear:both"></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id::Nomor ID',
		'username::Username',
		'UserName::Nama',
		'Asal',
		'Angkatan',
		'superuser',
		array(
			'class'=>'CButtonColumn',
		),
	),
	'summaryText' => 'Menampilkan {start}-{end} dari {count}.',
)); ?>
