<?php

class SurveyController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	static private $_users=array();
	public $layout='//layouts/column1';
	
	public function accessRules()
	{
		return array(
			array('deny',  // deny all users
				'actions'=>array('Registration'),
				'users'=>array('*'),
			),
		);
	}
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$listTables = Yii::app()->db->schema->tableNames;
		$filteredTables = array();
		$surveyName = array();
		$surveyAdmin = array();
		$i = 0;
		foreach ($listTables as $table) {
				if(substr($table,0,12)=='lime_tokens_' && $table != 'lime_tokens_dummy'){
					$surveyAdmin[$i] = SurveyAdmin::model()->findByAttributes(array('sid'=>substr($table,12,5)));
					$surveyName[$i] = SurveyName::model()->findByAttributes(array('surveyls_survey_id'=>substr($table,12,5)));
					$newModel= SurveyToken::model()->set_tablename($table);
					$filteredTables[$i]= SurveyToken::model()->findByAttributes(array('firstname'=>Yii::app()->user->name));
					$i++;
				}
		}
		//$check = SurveyKoor::model()->set_tablename('lime_tokens_46258');
		//$check = SurveyKoor::model()->tableSchema;
		//$check = $check0['_md:CActiveRecord:private'];//->metaData->tableSchema->schemaName;
		//$modelkoor = SurveyKoor::model()->findByAttributes(array('firstname'=>Yii::app()->user->name));
		//$modelanggota = SurveyAnggota::model()->findByAttributes(array('firstname'=>Yii::app()->user->name));
		//$modelwakil = SurveyWakil::model()->findByAttributes(array('firstname'=>Yii::app()->user->name));
		
		$this->render('index',array('table'=>$filteredTables,
									'surveyid'=>$surveyName,
									'admin'=> $surveyAdmin));
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
	private function lastViset() {
		$lastVisit = Users::model()->notsafe()->findByAttributes(array('username'=>Yii::app()->user->name));
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}
	
	public function actionDynamicjurusan()
	{
		$data=LookupJurusan::model()->findAll('parentname=:parentname',
				array(':parentname'=>$_POST['Profiles']['fakultas']));

		$data=CHtml::listData($data,'name','name');
		foreach($data as $value=>$subcategory)  {
			echo CHtml::tag('option',
			   array('value'=>$value),CHtml::encode($subcategory),true);
		}
	}
	
	/**
	 * Registration user
	 */
	public function actionRegistration() {
		$model = new RegistrationForm;
		$profile=new Profiles;
		$profile->regMode = true;
		
		// ajax validator
		if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
		{
			echo UActiveForm::validate(array($model,$profile));
			Yii::app()->end();
		}
		
		if (Yii::app()->user->id) {
			$this->redirect("../profiles/profiles");
		} else {
			if(isset($_POST['RegistrationForm'])) {
				$model->attributes=$_POST['RegistrationForm'];
				$profile->attributes=((isset($_POST['Profiles'])?$_POST['Profiles']:array()));
				if($model->validate()&&$profile->validate())
				{
					$soucePassword = $model->password;
					//$model->activkey=md5(microtime().$model->password);
					$model->password=md5($model->password);
					$model->verifyPassword=md5($model->verifyPassword);
					$model->superuser=0;
					$model->create_at=time();
					
					if ($model->save()) {
						$profile->user_id=$model->id;
						$profile->save();
						Yii::app()->user->setFlash('registration',"Terima kasih telah registrasi. Selamat datang di KMB Dhammanano ITB. Website ini saat ini sedang maintenance, simpan username dan sandi anda untuk login setelah selesai maintenance.");
							$this->refresh();
					}
				} else $profile->validate();
			}
			$this->render('../users/registration',array('model'=>$model,'profile'=>$profile));
		}
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}