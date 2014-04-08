<?php
$this->breadcrumbs=array(
	'Events',
);

?>

<h1><strong>Acara</strong></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/event/_view',
	'template'=>"{items}\n{pager}",
)); ?>
