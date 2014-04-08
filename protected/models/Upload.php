<?php 
class Uploadbb extends CActiveRecord
{
    public $cover;
	public $isi;
  
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
            array('cover', 'file', 'types'=>'jpg, png'),
			array('isi', 'file', 'types'=>'pdf'),
        );
    }
	
	public function attributeLabels()
	{
		return array(
			'cover' => 'File Cover (jpg/png)',
			'isi' => 'File BB (pdf)',
		);
	}
}
?>