<?php

class PostController extends Controller
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
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','view','view2'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
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
	public function actionView()
	{		
		$post=$this->loadModel();
		$comment=$this->newComment($post);
		
		$this->render('view',array(
			'model'=>$post,
			'comment'=>$comment,
		));
	}
	
	protected function newComment($post)
	{
		$comment=new Comment;
		
	    if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}
 
		if(isset($_POST['Comment']))
		{
			$comment->attributes=$_POST['Comment'];
			if($post->addComment($comment))
			{
				$this->refresh();
			}
		}
		return $comment;
	}

	private $_model;
	 
	 /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	 
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				$this->_model=Post::model()->findByPk($_GET['id'], '');
			}
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Post;
		$model2 = new UploadPostimg;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			$images = CUploadedFile::getInstancesByName('images');
			
			if (isset($images) && count($images) > 0)
			{
				if($model->save())
				{
					foreach ($images as $image => $pic)
					{
						if ($pic->saveAs(Yii::app()->basePath.'/../images/Post/'.$pic->name))
						{
							require_once('ThumbLib.inc.php');
							
							echo $pic->name."<br />";
							$img_add = new Images();
							$img_add->image_url = $pic->name;
							$img_add->post_id = $model->id;
							
							$img_add->save();
							  
							$thumb = PhpThumbFactory::create(Yii::app()->basePath.'/../images/Post/'.$pic->name,array("jpegQuality"=>70));  
							$thumb->resize(0, 600)->save(Yii::app()->basePath.'/../images/Post/'.$pic->name); 
						}					
					}
					$this->redirect(array('index','id'=>$model->id));
				}
				else
				{
					throw new CHttpException(404,'Server sedang mengalami masalah, coba lagi.');
				}
			}
		}
		else
		{
			$this->render('create',array(
				'model'=>$model,
				'model2'=>$model2,
			));
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model2 = new UploadPostimg;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$images = CUploadedFile::getInstancesByName('images');
			
			if (isset($images) && count($images) > 0)
			{
				foreach ($images as $image => $pic)
				{
					if ($pic->saveAs(Yii::app()->basePath.'/../images/Post/'.$pic->name))
					{
						require_once('ThumbLib.inc.php');
						
						echo $pic->name."<br />";
						$img_add = new Images();
						$img_add->image_url = $pic->name;
						$img_add->post_id = $model->id;
						
						$img_add->save();
						  
						$thumb = PhpThumbFactory::create(Yii::app()->basePath.'/../images/Post/'.$pic->name,array("jpegQuality"=>70));  
						$thumb->resize(0, 600)->save(Yii::app()->basePath.'/../images/Post/'.$pic->name); 
					}					
				}
				
			}
			$model->attributes=$_POST['Post'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
			else
			{
				throw new CHttpException(404,'Server sedang mengalami masalah, coba lagi.');
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'model2'=>$model2,
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
		$dataProvider=new CActiveDataProvider('Post', array(
					'criteria'=>array(
						'order'=>'create_time DESC',
					),'pagination'=>array(
						'pageSize'=>5,
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
		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

		$this->render('admin',array(
			'model'=>$model,
		));
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
