<?php


/**
 * This is the model class for table "kabupaten".
 *
 * The followings are the available columns in table 'kabupaten':
 * @property integer $id
 * @property string $nama
 * @property integer $no_kota
 * @property integer $propinsi_id
 *
 * The followings are the available model relations:
 * @property Propinsi $propinsi
 */
class Kabupaten extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Kabupaten the static model class
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
		return 'kabupaten';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, no_kota, propinsi_id', 'required'),
			array('no_kota, propinsi_id', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nama, no_kota, propinsi_id', 'safe', 'on'=>'search'),
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
			'propinsi' => array(self::BELONGS_TO, 'Propinsi', 'propinsi_id'),
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
			'no_kota' => 'No Kota',
			'propinsi_id' => 'Propinsi',
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
		$criteria->compare('no_kota',$this->no_kota);
		$criteria->compare('propinsi_id',$this->propinsi_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}