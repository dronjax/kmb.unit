<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Mengubah data pengguna (<?php echo $model->username; ?>)</h1>

<hr />

<?php echo $this->renderPartial('_formupdate', array('model'=>$model)); ?>