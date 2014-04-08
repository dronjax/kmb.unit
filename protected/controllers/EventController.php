<?php

class EventController extends Controller
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
		$model=new Event;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Event']))
		{
			$model->attributes=$_POST['Event'];
			if($model->save())
				$this->redirect('/betterkmb/index.php/post/index');
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Event']))
		{
			$model->attributes=$_POST['Event'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
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
		$isi=Event::model()->findAll();
		foreach($isi as $data)
		{
			list($year, $month, $day) = split('[/.-]', $data->waktu);
			$dayn = date('j',time());
			$monthn = date('n',time());
			$yearn = date('Y',time());
			$bulan=array(31,28,31,30,31,30,31,31,30,31,30,31);
			$temp=0;
			$temp2=0;
			$hari=$day;
			if ((($yearn%4==0)&&($yearn%100!=0))||($yearn%400==0))
			{
				$bulan[2]=29;
			}
			if ($monthn>$month)
			{
				for ($i=$monthn+1;$i<13;$i++)
				{
					$temp+=$bulan[i];
				}
				if (((($yearn+1)%4==0)&&(($yearn+1)%100!=0))||(($yearn+1)%400==0))
				{
					$bulan[2]=29;
				}
				else
				{
					$bulan[2]=28;
				}
				for ($i=1;$i<$month;$i++)
				{
					$temp+=$bulan[i];
				}
			}
			else 
			{
				for ($i=$monthn+1;$i<$month;$i++)
				{
					$temp+=$bulan[i];
				}
			}
			for ($i=$yearn+1;$i<$year;$i++)
			{
				if ((($i%4==0)&&($i%100!=0))||($i%400==0))
				{
					$bulan[2]=29;
				}
				else
				{
					$bulan[2]=28;
				}
				for ($i=1;$i<13;$i++)
				{
					$temp2+=$bulan[i];
				}
			}
			$mark=0;
			if ($year==$yearn)
			{
				if ($month==$monthn)
				{
					if ($day>$dayn)
					{
						$hari=$day-$dayn;
					}
					else if ($day==$dayn)
					{
						$mark=-2;
					}
					else
					{
						$mark=-1;
					}
				}
				else if ($month>$monthn)
				{
					$hari=$bulan[$monthn]-$dayn+$temp+$day;
				}
				else
				{
					$mark=-1;
				}
			}
			else if ($year>$yearn)
			{
				$hari=$bulan[$monthn]-$dayn+$temp+$day+$temp2;
			}
			else
			{
				$mark=-1;
			}
			$jam=$data->jam;
			$menit=$data->menit;
			$detik=0;
			$jamn=date('H',time());
			$menitn=date('i',time());
			$detikn=date('s',time());
			$jamn-=1;
			if ($jamn>$jam)
			{
				$jam=25-$jamn+$jam;
				if ($mark==-2)
				{
					$mark=-1;
				}
			}
			else
			{
				if (($mark==-2)&&($jam==$jamn))
				{
					$mark=-3;
				}
			}
			if ($menitn>$menit)
			{
				$menit=60-$menitn+$menit;
				if ($mark==-3)
				{
					$mark=-1;
				}
			}
			else
			{
				if (($mark==-3)&&($menit==$menitn))
				{
					$mark=-1;
				}
			}
			if ($mark==-1)
			{
				$this->loadModel($data->ID)->delete();
			}
		}
		$dataProvider=new CActiveDataProvider('Event',array(
			'criteria'=>array(
				'limit'=>3,
			),
			'pagination'=>false,
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Event('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Event']))
			$model->attributes=$_GET['Event'];

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
		$model=Event::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='event-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
