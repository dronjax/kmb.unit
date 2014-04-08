<?php

class KusaladhanaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('viewanggaran','viewbrosur'),
				'users'=>array('*'),
			),
			array('allow',
				'expression'=>'!Yii::app()->user->isGuest && Users::model()->IsAdmin()>=1',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new brosur model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateBrosur()
	{
        $model = new UploadBrosurKusaladhana;
		$modeldata = new BrosurKusaladhana;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (isset($_POST['UploadBrosurKusaladhana']))
		{
			// Save File
			$model->attributes=$_POST['UploadBrosurKusaladhana'];
            $model->brosurimg=CUploadedFile::getInstance($model,'brosurimg');
 
			$model->brosurimg->saveAs(Yii::app()->basePath.'/../images/Brosur/'.$model->brosurimg->name);
		
			$modeldata->brosurimg = $model->brosurimg->name;
			$modeldata->create_at = date('Y-m-d',time());
			if($modeldata->save())
				echo "sukses";
		}

		$this->render('createbrosur',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Displays list of model.
	 */
	public function actionViewBrosur()
	{
		$dataProvider=new CActiveDataProvider('BrosurKusaladhana',array(
					'criteria'=>array(
						'order'=>'create_at DESC',
					),'pagination'=>array(
						'pageSize'=>2,
					),));
		$this->render('viewbrosur',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Creates a new adik asuh model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateAdikAsuh()
	{
        $model = new UploadBrosurKusaladhana;
		$modeldata = new BrosurKusaladhana;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (isset($_POST['UploadBrosurKusaladhana']))
		{
			// Save File
			$model->attributes=$_POST['UploadBrosurKusaladhana'];
            $model->brosurimg=CUploadedFile::getInstance($model,'brosurimg');
 
			$model->brosurimg->saveAs(Yii::app()->basePath.'/../images/Brosur/'.$model->brosurimg->name);
		
			$modeldata->brosurimg = Yii::app()->baseUrl.'/images/Brosur/'.$model->brosurimg->name;
			$modeldata->create_at = date('Y-m-d',time());
			if($modeldata->save())
				echo "sukses";
		}

		$this->render('createbrosur',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Creates a new anggaran model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateAnggaran()
	{
        $model = new UploadAnggaranKusaladhana;
		$modeldata = new AnggaranKusaladhana;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (isset($_POST['UploadAnggaranKusaladhana']))
		{
			// Save File
			$model->attributes=$_POST['UploadAnggaranKusaladhana'];
            $model->anggaranimg=CUploadedFile::getInstance($model,'anggaranimg');
 
			$model->anggaranimg->saveAs(Yii::app()->basePath.'/../images/Anggaran/'.$model->anggaranimg->name);
		
			$modeldata->anggaranimg = $model->anggaranimg->name;
			$modeldata->create_at = date('Y-m-d',time());
			if($modeldata->save())
				echo "sukses";
		}

		$this->render('createanggaran',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays list of model.
	 */
	public function actionViewAnggaran()
	{
		$dataProvider=new CActiveDataProvider('AnggaranKusaladhana',array(
					'criteria'=>array(
						'order'=>'create_at DESC',
					),'pagination'=>array(
						'pageSize'=>2,
					),));
		$this->render('viewanggaran',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bb']))
		{
			$model->attributes=$_POST['Bb'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->ID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
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

	
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Bb',array(
					'criteria'=>array(
						'order'=>'ID DESC',
					),'pagination'=>array(
						'pageSize'=>6,
					),));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Bb('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Bb']))
			$model->attributes=$_GET['Bb'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Bb::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bb-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
