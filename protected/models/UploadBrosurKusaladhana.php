<?php 
class UploadBrosurKusaladhana extends CActiveRecord
{
    public $brosurimg;
  
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UploadBrosurKusaladhana the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{upload}}';
	}
  
    public function rules()
    {
        return array(
            array('brosurimg', 'file', 'types'=>'jpg, png'),
        );
    }
	
	public function attributeLabels()
	{
		return array(
			'brosurimg' => 'File Brosur (jpg/png)',
		);
	}
}
?>