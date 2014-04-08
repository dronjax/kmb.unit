<?php
$this->breadcrumbs=array(
	'Sms',
);

$this->menu=array(
	array('label'=>'Create Sms', 'url'=>array('create')),
	array('label'=>'Manage Sms', 'url'=>array('admin')),
);
?>

<h1>Sms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
