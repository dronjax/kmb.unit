<?php Yii::import('zii.widgets.CPortlet');
 
class menudemiadmin extends CPortlet
{
	public $title='Menu Demi Admin';
	 
    protected function renderContent()
    {
        $this->render('menudemiadmin');
    }
}?>