<?php

class Group_nameController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'expression'=>'!Yii::app()->user->isGuest && Users::model()->IsAdmin()>=1',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	private $_model;
	
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				$this->_model=Group_name::model()->findByPk($_GET['id'], '');
			}
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	
	/**
	 * Adding group
	 */
	public function actionCreate()
	{
		$model=new Group_name;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Group_name']))
		{
			$model->attributes=$_POST['Group_name'];
			$model->save();
		}
	}	
	
	/**
	 * Modifying group
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Group_name']))
		{
			$model->attributes=$_POST['Group_name'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}	
	
	/*
	 * Delete group
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/*
	 * Delete from group
	 */
	public function actionRemoveFromGroup($user_id,$group_id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			
			Group::model()->findByAttributes(array('user_id'=>$user_id,'group_id'=>$group_id))->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Group_name('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{		
		$group = new Group('search');
		$model=$this->loadModel($id);
		//print_r(CJSON::encode(Group::model()->with('users')->findAll($group->search($id))));
		$this->render('view',array(
			'model'=>$group,
			'id'=>$id,
			'namagrup'=>$model->nama,
		));
	}
	
	public function actionUserLookup(){
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])){
            $name = $_GET['term'];
            $criteria = new CDbCriteria;
            $criteria->condition = "name LIKE \"%$name%\" ";
            $users = Profiles::model()->findAll($criteria);
            $retval = array();
            foreach ($users as $user) {
                $retval[] = array(
                    'value' => $user->getAttribute('user_id') . '. ' . $user->getAttribute('name'),
                    'label' => $user->getAttribute('user_id') . '. ' . $user->getAttribute('name')
                );
            }
            echo CJSON::encode($retval);
        }
    }
	
	/**
	 * Adding member to group
	 */
	public function actionAddMember()
	{
		$model=new Group;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if ((isset($_POST['group_id']))&&(isset($_POST['user_id'])))
		{
			$model->group_id=$_POST['group_id'];
			$model->user_id=$_POST['user_id'];
			
			if (!Group::model()->findByPk(array('group_id'=>$model->group_id,'user_id'=>$model->user_id)))
				$model->save();
		}

	}	
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
