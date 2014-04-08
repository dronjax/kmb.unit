<?php
$this->breadcrumbs=array(
	'Bhadra Bodhi',
);
?>

<div id="title_head">
	<h3>Bhadra Bodhi</h3>
	<hr />
</div>

<ul id="shelf">
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'ajaxUpdate' => false,
		'pager'=>array(
				'header'         => 'Bagian ke-',
				'prevPageLabel'  => 'Sebelumnya',
				'nextPageLabel'  => 'Selanjutnya',
		),
		'template'=>"{items}\n{pager}",
	)); ?>
</ul>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/booklet.js"></script>