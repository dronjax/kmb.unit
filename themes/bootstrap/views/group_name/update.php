<?php
$this->breadcrumbs=array(
	'Grup'=>array('admin'),
	'Mengubah',
);
?>

<div id="title_head">
	<h3>Mengubah Grup</h3>
	<hr />
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>