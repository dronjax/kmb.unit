<?php
$this->breadcrumbs=array(
	'Sms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Sms', 'url'=>array('index')),
	array('label'=>'Manage Sms', 'url'=>array('admin')),
);
?>

<h1>Create Sms</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>