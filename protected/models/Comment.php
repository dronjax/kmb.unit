<?php

/**
 * This is the model class for table "webkmb2.{{comment}}".
 *
 * The followings are the available columns in table 'webkmb2.{{comment}}':
 * @property integer $id
 * @property string $content
 * @property integer $create_time
 * @property string $username
 * @property integer $post_id
 *
 * The followings are the available model relations:
 * @property Users $username0
 * @property Post $post
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return '{{comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content', 'required'),
			array('create_time, post_id', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, content, create_time, username, post_id', 'safe', 'on'=>'search'),
		);
	}

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->create_time=time();
				return true;
			}
		}
		else
			return false;
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'username' => array(self::BELONGS_TO, 'Users', 'username'),
			'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'content' => 'Comment',
			'create_time' => 'Create Time',
			'username' => 'Username',
			'post_id' => 'Post',
		);
	}

	public function findRecentComments($limit)
    {
        return $this->with('post')->findAll(array(
            'order'=>'t.create_time DESC',
            'limit'=>$limit,
        ));
    }
	
	public function getAuthor()
	{
		return CHtml::encode($this->username);
	}
	
	public function getUrl($post=null)
	{
		if($post===null)
			$post=$this->post;
		return $post->url.'#c'.$this->id;
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
		$criteria->compare('content',$this->content,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('post_id',$this->post_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}