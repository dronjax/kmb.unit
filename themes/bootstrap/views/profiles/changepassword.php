<?php 
$this->breadcrumbs=array(
	"Profile" => array('/user/profile'),
	"Change Password",
);
$this->menu=array(
    array('label'=>'Profil', 'url'=>array('/profiles/profiles')),
    array('label'=>'Edit Profil', 'url'=>array('edit')),
);
?>

<div id="title_head">
	<h3>Mengganti Sandi</h3>
	<hr />
</div>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
	<?php echo $form->label($model,'password'); ?>
	<?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->label($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword'); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>
	
	
	<div class="row submit">
	<?php echo CHtml::submitButton("Save"); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->