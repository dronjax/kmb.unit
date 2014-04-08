<?php
$this->breadcrumbs=array(
	'Bbs'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

?>

<h1>Update Bb <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>