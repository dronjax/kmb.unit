<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

?>

<h1>Create Users</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>