<?php

class Config extends CFormModel
{
	public $about;
	public $registration;
	public $admin_email;
	public $email_pass;
	
	public function rules()
	{
		return array(
			array('about, admin_email, email_pass', 'required'),
			array('registration', 'boolean'),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'about'=>"Perihal",
			'admin_email'=>"Email Admin",
			'email_pass'=>"Password Email Admin",
			'registration'=>"Buka Pendaftaran",
		);
	}
	
	public function save()
	{
		if (file_put_contents(dirname(__FILE__)."/../config/kmb_config.json", json_encode($this->attributes)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}