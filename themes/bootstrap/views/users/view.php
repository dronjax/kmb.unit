<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

?>

<h1>Lihat pengguna (<?php echo $model->username; ?>)</h1>
<hr />
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'profiles.name',
		'profiles.tgllahir',
		'profiles.asal',
		'profiles.alamat',
		'profiles.hp',
		'profiles.fakultas',
		'profiles.jurusan',
		'superuser',
	),
)); ?>
