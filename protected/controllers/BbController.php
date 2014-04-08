<?php

class BbController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Bb;
        $model2 = new UploadBB;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if((isset($_POST['bulan']))&&(isset($_POST['tahun']))&&(isset($_POST['tema']))&&(isset($_POST['UploadBB'])))
		{
			// Save File
			$model2->attributes=$_POST['UploadBB'];
            $model2->cover=CUploadedFile::getInstance($model2,'cover');
            $model2->isi=CUploadedFile::getInstance($model2,'isi');
 
			$model2->cover->saveAs(Yii::app()->basePath.'/../images/BB/'.$model2->cover->name);
			$model2->isi->saveAs(Yii::app()->basePath.'/../download/BB/'.$model2->isi->name);
		
			$model->bulan = $_POST['bulan'];
			$model->tahun = $_POST['tahun'];
			$model->tema = $_POST['tema'];
			$model->link_cover = $model2->cover->name;
			$model->link_download = $model2->isi->name;
			if($model->save())
				$this->redirect(array('index','id'=>$model->ID));
		}

		$this->render('create',array(
			'model'=>$model,
			'model2'=>$model2,
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
