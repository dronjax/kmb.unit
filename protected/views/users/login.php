<?php
$this->breadcrumbs=array(
	"Login",
);
$model=new UserLogin;
?>

<h1><?php echo "Masuk"; ?></h1>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<div class="form">
<?php echo CHtml::beginForm(); ?>
	
	<?php echo CHtml::errorSummary($model); ?>
	<div class="row">
		<?php echo CHtml::activeLabel($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username') ?>
	</div>
	
	<div class="row">
		<?php echo CHtml::activeLabel($model,'password'); ?>
		<?php echo CHtml::activePasswordField($model,'password') ?>
	</div>
	
	<div class="row rememberMe">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabel($model,'rememberMe'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>
	
<?php echo CHtml::endForm(); ?>
</div><!-- form -->