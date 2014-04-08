<?php
$this->breadcrumbs=array(
	'Bbs',
);
?>

<h1><strong>Bhadra Bodhi</strong></h1>
<ul id="shelf">
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'ajaxUpdate' => false,
		'template'=>"{items}\n{pager}",
	)); ?>
</ul>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/booklet.js"></script>