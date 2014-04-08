<?php

/**
 * This is the model class for table "{{sms}}".
 *
 * The followings are the available columns in table '{{sms}}':
 * @property integer $ID
 * @property string $tujuan
 * @property string $isi
 */
class Sms extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sms the static model class
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
		return 'webkmb2.{{sms}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tujuan, isi', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, tujuan, isi', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'tujuan' => 'Tujuan',
			'isi' => 'Isi',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('tujuan',$this->tujuan,true);
		$criteria->compare('isi',$this->isi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}