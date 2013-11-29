<?php


/**
 * This is the model class for table "nasabah_korporasi_ln".
 *
 * The followings are the available columns in table 'nasabah_korporasi_ln':
 * @property integer $id
 * @property string $noRekening
 * @property string $namaKorporasi
 * @property integer $bentukBadan
 * @property string $bentukBadanLain
 * @property integer $bidangUsaha
 * @property string $bidangUsahaLain
 * @property string $alamat
 * @property string $negaraBagianKota
 * @property integer $idNegara
 * @property string $negaraLain
 * @property string $noTelp
 * @property integer $swift_id
 *
 * The followings are the available model relations:
 * @property Negara $idNegara0
 * @property Swift $swift
 */
class NasabahKorporasiLn extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NasabahKorporasiLn the static model class
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
		return 'nasabah_korporasi_ln';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('namaKorporasi, idNegara, swift_id', 'required'),
			array('bentukBadan, bidangUsaha, idNegara, swift_id', 'numerical', 'integerOnly'=>true),
			array('noRekening, bidangUsahaLain, negaraBagianKota, negaraLain', 'length', 'max'=>50),
			array('namaKorporasi, bentukBadanLain', 'length', 'max'=>255),
			array('alamat', 'length', 'max'=>100),
			array('noTelp', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, noRekening, namaKorporasi, bentukBadan, bentukBadanLain, bidangUsaha, bidangUsahaLain, alamat, negaraBagianKota, idNegara, negaraLain, noTelp, swift_id', 'safe', 'on'=>'search'),
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
			'idNegara0' => array(self::BELONGS_TO, 'Negara', 'idNegara'),
			'swift' => array(self::BELONGS_TO, 'Swift', 'swift_id'),
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
			'noRekening' => 'No Rekening',
			'namaKorporasi' => 'Nama Korporasi',
			'bentukBadan' => 'Bentuk Badan',
			'bentukBadanLain' => 'Bentuk Badan Lain',
			'bidangUsaha' => 'Bidang Usaha',
			'bidangUsahaLain' => 'Bidang Usaha Lain',
			'alamat' => 'Alamat',
			'negaraBagianKota' => 'Negara Bagian Kota',
			'idNegara' => 'Id Negara',
			'negaraLain' => 'Negara Lain',
			'noTelp' => 'No Telp',
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
		$criteria->compare('noRekening',$this->noRekening,true);
		$criteria->compare('namaKorporasi',$this->namaKorporasi,true);
		$criteria->compare('bentukBadan',$this->bentukBadan);
		$criteria->compare('bentukBadanLain',$this->bentukBadanLain,true);
		$criteria->compare('bidangUsaha',$this->bidangUsaha);
		$criteria->compare('bidangUsahaLain',$this->bidangUsahaLain,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('negaraBagianKota',$this->negaraBagianKota,true);
		$criteria->compare('idNegara',$this->idNegara);
		$criteria->compare('negaraLain',$this->negaraLain,true);
		$criteria->compare('noTelp',$this->noTelp,true);
		$criteria->compare('swift_id',$this->swift_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}