<?php

/**
 * This is the model class for table "webkmb2.{{users}}".
 *
 * The followings are the available columns in table 'webkmb2.{{users}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $create_at
 * @property string $lastvisit
 * @property integer $superuser
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Post[] $posts
 * @property Profiles $profiles
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, create_at', 'required'),
			array('superuser', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			array('password', 'length', 'max'=>128),
			array('lastvisit', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, UserName, Angkatan, Asal, superuser', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'username'),
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
			'profiles' => array(self::HAS_ONE, 'Profiles', 'user_id'),
			'group' => array(self::HAS_MANY, 'Group', 'user_id'),
		);
	}

	private $_name = null;
	public function getUserName()
	{
		if ($this->_name === null && $this->profiles !== null)
			$this->_name = $this->profiles->name;
		return $this->_name;
	}
	public function setUserName($value)
	{
		$this->_name = $value;
	}
	
	private $_angkatan = null;
	public function getAngkatan()
	{
		if ($this->_angkatan === null && $this->profiles !== null)
			$this->_angkatan = $this->profiles->angkatan;
		return $this->_angkatan;
	}
	public function setAngkatan($value)
	{
		$this->_angkatan = $value;
	}
	
	private $_asal = null;
	public function getAsal()
	{
		if ($this->_asal === null && $this->profiles !== null)
			$this->_asal = $this->profiles->asal;
		return $this->_asal;
	}
	public function setAsal($value)
	{
		$this->_asal = $value;
	}
	
	public function FindGroup()
	{
		$temp = self::model()->findByAttributes(array('username'=>Yii::app()->user->name));
		$groups = Group::model()->findAllByAttributes(array('user_id'=>$temp->id));
		return $groups;
	}
	
	public function IsAdmin()
	{
		$temp=self::model()->notsafe()->findByAttributes(array('username'=>Yii::app()->user->name));
		return $temp->superuser;
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Sandi',
			'create_at' => 'Mendaftar Sejak',
			'lastvisit' => 'Kunjungan Terakhir',
			'superuser' => 'Superuser',
			'verifyPassword' => 'Ulangi Sandi'
		);
	}

	public function scopes()
    {
        return array(
            'superuser'=>array(
                'condition'=>'superuser=1',
            ),
            'notsafe'=>array(
            	'select' => 'id, username, password, create_at, superuser, lastvisit',
            ),
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
		$criteria->with = "profiles";
		
		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('superuser',$this->superuser);
		$criteria->compare('profiles.name',$this->UserName,true);
		$criteria->compare('profiles.angkatan',$this->Angkatan,true);
		$criteria->compare('profiles.asal',$this->Asal,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>15,
			),
		));
	}
	
	public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'AdminStatus' => array(
				'0' => 'No',
				'1' => 'Yes',
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
	
}