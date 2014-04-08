<?php

class ProfilesController extends Controller
{
	public $defaultAction = 'profile';
	private $_model;
	public $layout='//layouts/column2';

	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated users to access all actions
				'actions'=>array('update'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'expression'=>'!Yii::app()->user->isGuest && Users::model()->IsAdmin()>=1',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionView()
	{
		if(isset($_GET['id']))
		{
			$user=Users::model()->findByAttributes(array('id'=>$_GET['id']));
			$profile=Profiles::model()->findByAttributes(array('user_id'=>$user->id));
			$this->render('view',array(
				'model'=>$user,
				'profile'=>$profile,
			));
		}
		else if(isset($_GET['username']))
		{
			$user=Users::model()->findByAttributes(array('username'=>$_GET['username']));
			$profile=Profiles::model()->findByAttributes(array('user_id'=>$user->id));
			$this->render('view',array(
				'model'=>$user,
				'profile'=>$profile,
			));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	public function actionProfiles()
	{
		$model = $this->loadUser();
	    $this->render('profiles',array(
	    	'model'=>$model,
			'profiles'=>$model->profiles,
	    ));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEdit()
	{
		$model = $this->loadUser();
		$profile=$model->profiles;
		
		// ajax validator
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo UActiveForm::validate(array($model,$profile));
			Yii::app()->end();
		}
		
		if(isset($_POST['Profiles']))
		{
			$profile->attributes=$_POST['Profiles'];
			
			if($profile->validate()) {
				$profile->save();
                //Yii::app()->user->updateSession();
				//Yii::app()->user->setFlash('profileMessage',"Changes is saved.");
				$this->redirect(array('profiles'));
			} else $profile->validate();
		}

		$this->render('edit',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}
	
	/**
	 * Change password
	 */
	public function actionChangepassword() {
		$model = new UserChangePassword;
		if (Yii::app()->user->id) {
			
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form')
			{
				echo UActiveForm::validate($model);
				Yii::app()->end();
			}
			
			if(isset($_POST['UserChangePassword'])) {
					$model->attributes=$_POST['UserChangePassword'];
					if($model->validate()) {
						$new_password = Users::model()->notsafe()->findbyPk(Yii::app()->user->id);
						$new_password->password = md5($model->password);
						$new_password->save();
						Yii::app()->user->setFlash('profileMessage',"New password is saved.");
						$this->redirect(array("profiles"));
					}
			}
			$this->render('changepassword',array('model'=>$model));
	    }
	}
	
	public function loadUser()
	{
		if($this->_model===null)
		{
			if(Yii::app()->user->id)
				$this->_model=$this->user();
			if($this->_model===null)
				$this->redirect('/users/login');
		}
		return $this->_model;
	}
	
	public static function user($id=0,$clearCache=false) {
        if (!$id&&!Yii::app()->user->isGuest)
            $id = Yii::app()->user->id;
		if ($id) {
            if (!isset($_users[$id])||$clearCache)
                $_users[$id] = Users::model()->with(array('profiles'))->findbyPk($id);
			return $_users[$id];
        } else return false;
	}
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}