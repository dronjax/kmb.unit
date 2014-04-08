<?php
$this->breadcrumbs=array(
	'Events'=>array('index'),
	'Create',
);

?>

<h1>Buat Acara</h1>
<hr />

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>