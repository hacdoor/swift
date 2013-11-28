<?php


/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $realname
 * @property integer $is_active
 * @property string $create_time
 * @property string $update_time
 * @property integer $group_id
 *
 * The followings are the available model relations:
 * @property Group $group
 * @property AdminPermission[] $adminPermissions
 */
class Admin extends CActiveRecord
{
	private $_permissions = null;
	public $confirm_password;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Admin the static model class
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
		return 'admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, create_time, update_time, group_id, confirm_password', 'required'),
			array('is_active, group_id', 'numerical', 'integerOnly'=>true),
			array('username, password, email, realname', 'length', 'max'=>255),
			array('username, email', 'unique'),
			array('password', 'compare', 'compareAttribute' => 'confirm_password'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, realname, is_active, create_time, update_time, group_id', 'safe', 'on'=>'search'),
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
			'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
			'adminPermissions' => array(self::HAS_MANY, 'AdminPermission', 'admin_id'),
		);
	}

	/**
	 * @return array behaviors
	 */
	public function behaviors()
	{
		return array(
			'timestamp' => array('class'=>'application.extensions.behaviors.TimestampBehavior'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'realname' => 'Realname',
			'is_active' => 'Is Active',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'group_id' => 'Group',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('group_id',$this->group_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function hasPermissions($perms, $op = 'OR') {
		$ret = false;
		$has = array();

		$this->getPermissions();

		if ($this->_permissions) {
			foreach ($this->_permissions as $p) {
				if ($p['name'] == 'system.root') {
					$has = array(true);
					break;
				} else {
					if (is_array($perms)) {
						foreach ($perms as $pp) {
							//if ($p['name'] == $pp) $has[] = true;
							if (preg_match('/' . str_replace('*', '.+', $pp) . '/', $p['name'])) $has[] = true;
						}
					} else {
						//if ($p['name'] == $perms) $has[] = true;
						if (preg_match('/' . str_replace('*', '.+', $perms) . '/', $p['name'])) $has[] = true;
					}
				}
			}
		}

		foreach ($has as $h) {
			if ($op == 'AND') {
				if (!$h) {
					$ret = false;
					break;
				} else {
					$ret = true;
				}
			} else {
				if ($h) {
					$ret = true;
					break;
				}
			}
		}

		return $ret;
	}

	public function getPermissions() {
		if (!$this->_permissions) $this->_populatePermissions();
		return $this->_permissions;
	}

	private function _populatePermissions() {
		$this->_permissions = array();

		// Inherited from group
		foreach ($this->group->groupPermissions as $gp) {
			if ($gp->allow) {
				$this->_permissions[] = array(
					'name' => $gp->permission->name,
					'description' => $gp->permission->description,
				);
			}
		}

		// User permission
		foreach ($this->adminPermissions as $ap) {
			$key = $ap->permission->name;
			$description = $ap->permission->description;
			$allow = $ap->allow;

			$exist = false;
			foreach ($this->_permissions as $p) {
				if ($key == $p['name']) {
					$exist = true;
					break;
				}
			}

			if ($exist) {
				if (!$allow) {
					$i = 0;
					foreach ($this->_permissions as $k => $v) {
						if ($key == $v['name']) {
							unset($this->_permissions[$k]);
						}
					}
					$i++;
				}
			} else {
				if ($allow) {
					$this->_permissions[] = array(
						'name' => $key,
						'description' => $description,
					);
				}
			}
		}
	}
}