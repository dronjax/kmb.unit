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
class SurveyToken extends CActiveRecord
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
			
		return 'lime_tokens_dummy';
	}

	public function set_tablename($check)
	{
			$this->tableSchema->name = $check;
			$this->tableSchema->rawName = $check;
		return true;
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

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('lastvisit',$this->lastvisit,true);
		$criteria->compare('superuser',$this->superuser);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
}