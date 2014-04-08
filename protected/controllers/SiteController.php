<?php

class SiteController extends Controller
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
	
	public function actionAbout()
	{
		$this->render('about');
	}
	
	public function actionSejarah()
	{
		$this->render('sejarah');
	}


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->redirect('/post/index');
	}

	public function actionCalendar()
	{
		$this->render('calendar');
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

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					$this->redirect(Yii::app()->user->returnUrl);
				}
				else
				{
					throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
				}
			}
			// display the login form
			$this->render('../users/login',array('model'=>$model));
		} else
			$this->redirect(Yii::app()->user->returnUrl);
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
		$profile = new Profiles;
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
