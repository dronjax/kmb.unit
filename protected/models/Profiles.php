<?php

/**
 * This is the model class for table "webkmb2.{{profiles}}".
 *
 * The followings are the available columns in table 'webkmb2.{{profiles}}':
 * @property integer $user_id
 * @property string $lastname
 * @property string $firstname
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Profiles extends UActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profiles the static model class
	 */
	 
	public $regMode = false;
	
	private $_model;
	private $_modelReg;
	private $_rules = array();
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{profiles}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		
		if (!$this->_rules) 
		{
			$required = array();
			$numerical = array();		
			$rules = array();
			
			$model=$this->getFields();
			
			foreach ($model as $field) 
			{
				$field_rule = array();
				if ($field->required==ProfilesFields::REQUIRED_YES_NOT_SHOW_REG||$field->required==ProfilesFields::REQUIRED_YES_SHOW_REG)
					array_push($required,$field->varname);
				if ($field->field_type=='FLOAT'||$field->field_type=='INT')
					array_push($numerical,$field->varname);
				if ($field->field_type=='VARCHAR'||$field->field_type=='TEXT') {
					$field_rule = array($field->varname, 'length', 'max'=>$field->field_size, 'min' => $field->field_size_min);
					if ($field->error_message) $field_rule['message'] = $field->error_message;
					array_push($rules,$field_rule);
				}
				if ($field->other_validator) 
				{
					if (strpos($field->other_validator,'{')===0) {
						$validator = (array)CJavaScript::jsonDecode($field->other_validator);
						foreach ($validator as $name=>$val) {
							$field_rule = array($field->varname, $name);
							$field_rule = array_merge($field_rule,(array)$validator[$name]);
							if ($field->error_message) $field_rule['message'] = $field->error_message;
							array_push($rules,$field_rule);
						}
					} else {
						$field_rule = array($field->varname, $field->other_validator);
						if ($field->error_message) $field_rule['message'] = $field->error_message;
						array_push($rules,$field_rule);
					}
				} elseif ($field->field_type=='DATE') {
					$field_rule = array($field->varname, 'type', 'type' => 'date', 'dateFormat' => 'yyyy-mm-dd', 'allowEmpty'=>true);
					if ($field->error_message) $field_rule['message'] = $field->error_message;
					array_push($rules,$field_rule);
				}
				if ($field->match) {
					$field_rule = array($field->varname, 'match', 'pattern' => $field->match);
					if ($field->error_message) $field_rule['message'] = $field->error_message;
					array_push($rules,$field_rule);
				}
				if ($field->range) {
					$temp = self::rangeRules($field->range);
					$field_rule = array($field->varname, 'in', 'range' => $temp);
					if ($field->error_message) $field_rule['message'] = $field->error_message;
					array_push($rules,$field_rule);
				}
			}
			
			array_push($rules,array(implode(',',$required), 'required'));
			array_push($rules,array(implode(',',$numerical), 'numerical', 'integerOnly'=>true));
			$this->_rules = $rules;
		}
		return $this->_rules;
		
		/*
		return array(
			array('lastname, firstname', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, lastname, firstname', 'safe', 'on'=>'search'),
		);
		*/
	}
	
	public function getFields() {
		if ($this->regMode) {
			if (!$this->_modelReg)
				$this->_modelReg=ProfilesFields::model()->forRegistration()->findAll();
			return $this->_modelReg;
		} else {
			if (!$this->_model)
				$this->_model=ProfilesFields::model()->forOwner()->findAll();
			return $this->_model;
		}
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		$relations = array(
			'users'=>array(self::HAS_ONE, 'Users', 'id'),
		);
		return $relations;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$labels = array(
			'user_id' => 'User ID',
		);
		$model=$this->getFields();
		
		foreach ($model as $field)
			$labels[$field->varname] = ($field->title);
			
		return $labels;
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	private function rangeRules($str) {
		$rules = explode('-',$str);
		$temp=0;
		for ($i=$rules[0];$i<=$rules[1];$i++) {
			$array[$temp] = $i;
			$temp++;
		}
		return $array;
	}
	
	static public function range($str,$fieldValue=NULL) {
		$rules = explode('-',$str);
		$array = array();
		for ($i=$rules[0];$i<=$rules[1];$i++) {
			$array[$i]=$i;
		}
		if (isset($fieldValue)) 
			if (isset($array[$fieldValue])) return $array[$fieldValue]; else return '';
		else
			return $array;
	}
	
	public function findCloseBirthday ()
	{		
		$temp=$this->findAllBySql("SELECT * FROM ".$this->tableName()." ORDER BY tgllahir");
		$user=Users::model()->findByAttributes(array('username'=>Yii::app()->user->name));
		$back=array();
		for ($i=0;$i<count($temp);$i++)
		{
			if ($user->id!=$temp[$i]->user_id)
			{
				$birthdate = date_create($temp[$i]->tgllahir);
				$tempstring = explode('-',$temp[$i]->tgllahir);
				$todays_date = date_create($tempstring[0].date("-m-d"));
				/*$diff = date_diff($todays_date, $birthdate);
				if (($diff->format("%a")<7)&&($diff->format("%a")>=0))
				{
					array_push($back, $temp[$i]);
				}*/
				if (($todays_date->format("m"))==($birthdate->format("m")))
				{
					if ((((intval($todays_date->format("d"))-intval($birthdate->format("d"))))>=-7)&&((intval($todays_date->format("d"))-intval($birthdate->format("d")))<=0))
						array_push($back, $temp[$i]);
				}
				else if ((((intval($birthdate->format("m"))-intval($todays_date->format("m")))<=1)&&((intval($birthdate->format("m"))-intval($todays_date->format("m")))>=0))||((intval($birthdate->format("m"))==1)&&(intval($todays_date->format("m"))==12)))
				{
					if (intval($todays_date->format("d"))<intval($birthdate->format("d")))
					{
						if (((intval($todays_date->format("d"))+30-intval($birthdate->format("d")))>=-7)&&((intval($todays_date->format("d"))+30-intval($birthdate->format("d")))<=0))
							array_push($back, $temp[$i]);
					}
					else
					{
						if (((intval($todays_date->format("d"))-(intval($birthdate->format("d"))+30))>=-7)&&((intval($todays_date->format("d"))-(intval($birthdate->format("d"))+30))<=0))
							array_push($back, $temp[$i]);
					}
				}
			}
		}
		return $back;
	}
	
	public function widgetAttributes() {
		$data = array();
		$model=$this->getFields();
		
		foreach ($model as $field) {
			if ($field->widget) $data[$field->varname]=$field->widget;
		}
		return $data;
	}
	
	public function widgetParams($fieldName) {
		$data = array();
		$model=$this->getFields();
		
		foreach ($model as $field) {
			if ($field->widget) $data[$field->varname]=$field->widgetparams;
		}
		return $data[$fieldName];
	}
}