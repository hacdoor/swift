<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'is_active = 1 AND username = :username AND password = :password';
		$criteria->params = array(':username' => $this->username, ':password' => Yii::app()->util->encryptPassword($this->password));

		$admin = Admin::model()->find($criteria);
		if (!$admin) {
			$criteria = new CDbCriteria;
			$criteria->condition = 'is_active = 1 AND username = :email AND password = :password';
			$criteria->params = array(':email' => $this->username, ':password' => Yii::app()->util->encryptPassword($this->password));
		}

		if (!$admin) {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else {
			$this->_id = $admin->id;
			Yii::app()->user->setState('admin', $admin);
			$this->errorCode=self::ERROR_NONE;
		}
		
		return !$this->errorCode;
	}

	public function getId() {
		return $this->_id;
	}
}