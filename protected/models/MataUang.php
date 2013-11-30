<?php


/**
 * This is the model class for table "mataUang".
 *
 * The followings are the available columns in table 'mataUang':
 * @property integer $id
 * @property string $nama
 * @property string $simbol
 * @property double $kurs
 * @property integer $negara_id
 */
class MataUang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MataUang the static model class
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
		return 'mata_uang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, simbol, kurs', 'required'),
			array('negara_id', 'numerical', 'integerOnly'=>true),
			array('kurs', 'numerical'),
			array('nama', 'length', 'max'=>255),
			array('simbol', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nama, simbol, kurs, negara_id', 'safe', 'on'=>'search'),
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
                    'negara' => array(self::BELONGS_TO, 'Negara', 'negara_id'),
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
			'nama' => 'Nama',
			'simbol' => 'Simbol',
			'kurs' => 'Kurs',
			'negara_id' => 'Negara',
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
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('simbol',$this->simbol,true);
		$criteria->compare('kurs',$this->kurs);
		$criteria->compare('negara_id',$this->negara_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}