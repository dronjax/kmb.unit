<?php
$this->breadcrumbs=array(
	'Brosur Kusaladhana',
);
?>

<h1><strong>Brosur Kusaladhana</strong></h1>
<hr />
<div>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_viewbrosur',
		'ajaxUpdate' => false,
		'template'=>"{items}<div style='clear:both'></div>\n{pager}",
	)); ?>
</div>
<script type="text/javascript">
	$(".brosur").click(
		function()
		{
			var Top = $(document).scrollTop();
			$("body").css("overflow", "hidden");
			$("#blacktrans").css("top",Top);
			$("#blacktrans").css("display","inline");
			$("#backimg").attr("src",$(this).attr("src"));
			$("#framebackimg").css("display","block");
			$("#backimg").css("display","block");
		}
	);
</script>