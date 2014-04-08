<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Manage',
);

?>

<h1>Mengatur Berita</h1>
<hr />

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'content',
		'author_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
