<?php

/**
 * This is the model class for table "{{group}}".
 *
 * The followings are the available columns in table '{{group}}':
 * @property integer $group_id
 * @property integer $user_id
 */
class Group extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Group the static model class
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
		return '{{group}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, user_id', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('group_id, user_id', 'safe', 'on'=>'search'),
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
			'group_name' => array(self::BELONGS_TO, 'Group_name', 'group_id'),
			'users' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'group_id' => 'ID Grup',
			'user_id' => 'ID Pengguna',
		);
	}
	
	private $_nama = null;
	public function getNama()
	{
		if ($this->_nama === null)
			$this->_nama =  Profiles::model()->findByPk($this->user_id)->name;
		return $this->_nama;
	}
	public function setNama($value)
	{
		$this->_nama = $value;
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->addCondition('group_id='.$id.'');
		$criteria->compare('user_id',$this->user_id);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}