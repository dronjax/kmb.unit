<?php 
$this->breadcrumbs=array(
	"Profiles"=>array('profiles'),
	"Edit",
);
$this->menu=array(
	array('label'=>'Profil', 'url'=>array('/profiles/profiles')),
    array('label'=>'Ganti Sandi', 'url'=>array('changepassword')),
);
?>

<div id="title_head">
	<h3>Edit Profil</h3>
	<hr />
</div>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
	<div class="flash_success">
		<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
	</div>
<?php endif; ?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<?php echo $form->label($profile,$field->varname);
		
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->field_type=='fakul') {
			$temp=LookupFakultas::model()->items();
			echo $form->dropDownList($profile,$field->varname,$temp,
				array(
					'ajax'=>array(
						'type'=>'POST',
						'url'=>CController::createUrl('site/Dynamicjurusan'),
						'update'=>'#'.CHtml::activeId($profile,'jurusan')),
					'options'=>array($profile->fakultas=>array('selected'=>'selected')),
			));
		} elseif ($field->field_type=='jurus') {
			$data=LookupJurusan::model()->findAll('parentname=:parentname',
				array(':parentname'=>$profile->fakultas));
			$data=CHtml::listData($data,'name','name');
			echo $form->dropDownList($profile,$field->varname,$data,
				array(
					'options'=>array($profile->jurusan=>array('selected'=>'selected')),
					)
			);
		} elseif ($field->range) {
			$temp=Profiles::range($field->range);
			echo $form->dropDownList($profile,$field->varname,$temp,
				array(
					'options'=>array($profile->angkatan=>array('selected'=>'selected')),
			));
			//echo $form->dropDownList($profile,$field->varname,Profiles::range($field->range));
		} elseif ($field->field_type=='gambar') {
			echo $form->fileField($profile,$field->varname);
		} elseif ($field->field_type=="DATE"){
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'language'=>'en',
			'model'=>$profile,
			'value'=>$profile->tgllahir,
			'name'=>'Profiles['.$field->varname.']',
			'id'=>'Profiles_'.$field->varname,
			// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'yy-mm-dd',
				'defaultDate'=>'$( ".selector" ).datepicker( "option", "defaultDate", -18y );',
			),
		));
		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		echo $form->error($profile,$field->varname); ?>
	</div>	
			<?php
			}
		}
?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
