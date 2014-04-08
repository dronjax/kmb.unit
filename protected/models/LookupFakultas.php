<?php

/**
 * This is the model class for table "webkmb2.{{lookup_fakultas}}".
 *
 * The followings are the available columns in table 'webkmb2.{{lookup_fakultas}}':
 * @property integer $id
 * @property string $name
 * @property integer $code
 * @property integer $position
 *
 * The followings are the available model relations:
 * @property LookupJurusan[] $lookupJurusans
 */
class LookupFakultas extends CActiveRecord
{
	private static $_items;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LookupFakultas the static model class
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
		return '{{lookup_fakultas}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, code, position', 'required'),
			array('code, position', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, code, position', 'safe', 'on'=>'search'),
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
			'lookupJurusans' => array(self::HAS_MANY, 'LookupJurusan', 'parentname'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'code' => 'Code',
			'position' => 'Position',
		);
	}

	/**
	 * Returns the items for the specified type.
	 * @param string item type (e.g. 'PostStatus').
	 * @return array item names indexed by item code. The items are order by their position values.
	 * An empty array is returned if the item type does not exist.
	 */
	public function items()
	{
		if(!isset(self::$_items))
			self::loadItems();
		return self::$_items;
	}
	
	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	private function loadItems()
	{
		self::$_items=array();
		$models=self::model()->findAllbySql('SELECT * FROM '.self::tableName());
		foreach($models as $model)
			self::$_items[$model->name]=$model->name;
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}