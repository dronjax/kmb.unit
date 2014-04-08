<?php 
class UploadPostimg extends CActiveRecord
{
    public $postimg;
  
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Bb the static model class
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
            array('postimg', 'file', 'types'=>'jpg, png'),
        );
    }
	
	public function attributeLabels()
	{
		return array(
			'postimg' => 'Gambar (jpg/png)',
		);
	}
}
?>