<?php
class UploadController extends Controller
{
	public $layout='//layouts/column2';
	
    public function actionUploadBB()
    {
        $model=new Upload;
        if(isset($_POST['Upload']))
        {
            $model->attributes=$_POST['Upload'];
            $model->cover=CUploadedFile::getInstance($model,'cover');
            $model->isi=CUploadedFile::getInstance($model,'isi');
 
			$model->cover->saveAs(Yii::app()->basePath.'/../images/BB/'.$model->cover->name);
			$model->isi->saveAs(Yii::app()->basePath.'/../download/BB/'.$model->isi->name);
			// redirect to success page
			$this->redirect(Yii::app()->request->baseUrl.'/index.php/bb/create');
        }
		else
		{
			$this->render('uploadBB', array('model'=>$model));
		}
    }
}
?>