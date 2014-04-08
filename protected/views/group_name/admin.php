<?php
$this->breadcrumbs=array(
	'Group_Name'=>array('index'),
	'Manage',
);

?>

<h1>Mengatur Grup</h1>
<hr />
<span style="float:right;">
	<?php echo CHtml::ajaxButton('Buat Grup', Yii::app()->request->baseUrl.'/group_name/create', array(
		'type' => 'POST',
		'data'=> array(
				"Group_name[nama]"=> "js:$(\"#Nama_Grup\").val()",
			),
		'success' => "function(data, textStatus, XMLHttpRequest) {".
			"$('#users-grid').yiiGridView.update('users-grid');".
			"$('#Nama_Grup').val('');}"
		), array(
			'class'=>'link_blue'
		));
	?>
</span>
<span style="float:right;margin-right:7px;">
	<?php 
		echo CHtml::textField("Nama_Grup","");
	?>
</span>
<div style="clear:both"></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'nama',
		'total',
		array(
			'class'=>'CButtonColumn',
		),
	),
	'summaryText' => 'Menampilkan {start}-{end} dari {count}.',
)); ?>
