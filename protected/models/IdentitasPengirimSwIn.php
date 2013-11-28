<?php


/**
 * This is the model class for table "identitasPengirimSwIn".
 *
 * The followings are the available columns in table 'identitasPengirimSwIn':
 * @property integer $id
 * @property integer $jenis
 * @property integer $swift_id
 *
 * The followings are the available model relations:
 * @property Swift $swift
 * @property NasabahPengirimSwIn[] $nasabahPengirimSwIns
 * @property NonNasabahPengirimSwIn[] $nonNasabahPengirimSwIns
 */
class IdentitasPengirimSwIn extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IdentitasPengirimSwIn the static model class
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
		return 'identitasPengirimSwIn';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('swift_id', 'required'),
			array('jenis, swift_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, jenis, swift_id', 'safe', 'on'=>'search'),
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
			'swift' => array(self::BELONGS_TO, 'Swift', 'swift_id'),
			'nasabahPengirimSwIns' => array(self::HAS_MANY, 'NasabahPengirimSwIn', 'identitasPengirimSwIn_id'),
			'nonNasabahPengirimSwIns' => array(self::HAS_MANY, 'NonNasabahPengirimSwIn', 'identitasPengirimSwIn_id'),
		);
	}

	/**
	 * @return array behaviors
	 */
	public function behaviors()
	{
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'jenis' => 'Jenis',
			'swift_id' => 'Swift',
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
		$criteria->compare('jenis',$this->jenis);
		$criteria->compare('swift_id',$this->swift_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}