<?php
	Yii::import('zii.widgets.CPortlet');
 
	class CloseBirthday extends CPortlet
	{
		public $title='Ulang Tahun';
	 
		public function getCloseBirthday()
		{
			return Profiles::model()->findCloseBirthday();
		}
	 
		protected function renderContent()
		{
			$this->render('closeBirthday');
		}
	}
?>