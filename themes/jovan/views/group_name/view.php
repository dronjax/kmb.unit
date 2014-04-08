<?php
$this->breadcrumbs=array(
	'Group'=>array('index'),
	'Manage',
);

?>

<h1>Mengatur <?php echo $namagrup; ?></h1>
<hr />
<span style="float:right;">
	<?php echo CHtml::ajaxButton('Tambah Anggota', Yii::app()->request->baseUrl.'/group_name/addmember', array(
		'type' => 'POST',
		'data'=> array(
				"group_id"=> "$id",
				"user_id"=> "js:$(\"#user_lookup\").val().substring(0,$(\"#user_lookup\").val().indexOf('.'))",
			),
		'success' => "function(data, textStatus, XMLHttpRequest) {".
			"$('#users-grid').yiiGridView.update('users-grid');".
			"$('#user_lookup').val('');}"
		), array(
			'class'=>'link_blue'
		));
	?>
</span>
<span style="float:right;margin-right:7px;"> 
	<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',
          array(
                'name' => 'user_lookup',
                'sourceUrl' => array('userlookup'),
             ));
    ?>
</span>
<div style="clear:both"></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search($id),
	'columns'=>array(
		'user_id::Id',
		'nama',
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}{delete}',
			'viewButtonUrl' => 'Yii::app()->controller->createUrl(\'/profiles/view\', array(\'id\' => $data->user_id))',
            'deleteButtonUrl' => 'Yii::app()->controller->createUrl(\'/group_name/removefromgroup\', array(\'user_id\' => $data->user_id, \'group_id\' => $data->group_id))',
		),
	),
	'summaryText' => 'Menampilkan {start}-{end} dari {count}.',
)); ?>
