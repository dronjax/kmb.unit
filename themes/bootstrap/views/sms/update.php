<?php
$this->breadcrumbs=array(
	'Sms'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sms', 'url'=>array('index')),
	array('label'=>'Create Sms', 'url'=>array('create')),
	array('label'=>'View Sms', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Sms', 'url'=>array('admin')),
);
?>

<h1>Update Sms <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>