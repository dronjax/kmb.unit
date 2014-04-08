<?php
	Yii::import('zii.widgets.CPortlet');
 
	class RecentComments extends CPortlet
	{
		public $title='Komentar Terbaru';
		public $maxComments=5;
	 
		public function getRecentComments()
		{
			return Comment::model()->findRecentComments(7);
		}
	 
		protected function renderContent()
		{
			$this->render('recentComments');
		}
	}
?>