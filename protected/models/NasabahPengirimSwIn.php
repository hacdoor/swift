<?php


/**
 * This is the model class for table "nasabahPengirimSwIn".
 *
 * The followings are the available columns in table 'nasabahPengirimSwIn':
 * @property integer $id
 * @property integer $identitasPengirimSwIn_id
 * @property integer $jenis
 *
 * The followings are the available model relations:
 * @property KorporasiPengirimSwIn[] $korporasiPengirimSwIns
 * @property IdentitasPengirimSwIn $identitasPengirimSwIn
 * @property PeroranganPengirimSwIn[] $peroranganPengirimSwIns
 */
class NasabahPengirimSwIn extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NasabahPengirimSwIn the static model class
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
		return 'nasabahPengirimSwIn';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('identitasPengirimSwIn_id', 'required'),
			array('identitasPengirimSwIn_id, jenis', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, identitasPengirimSwIn_id, jenis', 'safe', 'on'=>'search'),
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
			'korporasiPengirimSwIns' => array(self::HAS_MANY, 'KorporasiPengirimSwIn', 'nasabahPengirimSwIn_id'),
			'identitasPengirimSwIn' => array(self::BELONGS_TO, 'IdentitasPengirimSwIn', 'identitasPengirimSwIn_id'),
			'peroranganPengirimSwIns' => array(self::HAS_MANY, 'PeroranganPengirimSwIn', 'nasabahPengirimSwIn_id'),
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
			'identitasPengirimSwIn_id' => 'Identitas Pengirim Sw In',
			'jenis' => 'Jenis',
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
		$criteria->compare('identitasPengirimSwIn_id',$this->identitasPengirimSwIn_id);
		$criteria->compare('jenis',$this->jenis);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}