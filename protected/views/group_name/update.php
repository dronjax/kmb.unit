<?php
$this->breadcrumbs=array(
	'Group_name'=>array('index'),
	'Create',
);
?>

<h1>Mengubah Grup</h1>
<hr />

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>