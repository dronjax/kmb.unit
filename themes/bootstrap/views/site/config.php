<?php
	$this->breadcrumbs=array(
		"Konfigurasi",
	);
?>

<div id="title_head">
	<h3>Konfigurasi</h3>
	<hr />
</div>

<?php if(Yii::app()->user->hasFlash('configMessage')): ?>
	<div class="success">
		<?php echo Yii::app()->user->getFlash('configMessage'); ?>
	</div>
<?php endif; ?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
		convert_urls : false,
		relative_urls : false,
        plugins : "autolink,lists,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,preview,media,contextmenu,fullscreen,noneditable,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "styleselect,formatselect,|,tablecontrols,|,preview,code,fullscreen,|,charmap,emotions,iespell,media,advhr,",
        theme_advanced_buttons2 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,forecolor,backcolor,|,hr,sub,sup,|,image,|,fontselect,fontsizeselect,|,outdent,indent,",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
		
		theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        //theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",

        // Example content CSS (should be your site CSS)
        //content_css : "<?php echo Yii::app()->request->baseUrl; ?>/css/style.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "<?php echo Yii::app()->request->baseUrl; ?>/js/template_list.js",
        external_link_list_url : "<?php echo Yii::app()->request->baseUrl; ?>/js/link_list.js",
        external_image_list_url : "<?php echo Yii::app()->request->baseUrl; ?>/js/image_list.js",
        media_external_list_url : "<?php echo Yii::app()->request->baseUrl; ?>/js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "<?php echo Yii::app()->user->name ?>",
                staffid : "991234"
        }
});
</script>
<div class="form">
	<?php echo CHtml::beginForm(); ?>
		
		<?php echo CHtml::errorSummary($model); ?>
		<div class="row">
			<?php echo CHtml::activeLabel($model,'about'); ?>
			<?php echo CHtml::activeTextArea($model,'about', array("style"=>"width: 800px; height: 400px;")) ?>
		</div>
		<br />
		
		<div class="row">
			<?php echo CHtml::activeLabel($model,'admin_email'); ?>
			<?php echo CHtml::activeTextField($model,'admin_email') ?>
		</div>
		
		<div class="row">
			<?php echo CHtml::activeLabel($model,'email_pass'); ?>
			<?php echo CHtml::activeTextField($model,'email_pass') ?>
		</div>
		
		<div class="row">
			<?php echo CHtml::activeLabel($model,'registration'); ?>
			<?php echo CHtml::activeCheckBox($model,'registration'); ?>
		</div>
	
		<div class="row submit">
			<?php echo CHtml::submitButton('Ubah'); ?>
		</div>
		
	<?php echo CHtml::endForm(); ?>
</div>