<?php


/**
 * This is the model class for table "korporasiPengirimSwIn".
 *
 * The followings are the available columns in table 'korporasiPengirimSwIn':
 * @property integer $id
 * @property string $noRekening
 * @property string $namaKorporasi
 * @property string $alamat
 * @property string $negaraBagianKota
 * @property integer $idNegaraBagianKota
 * @property string $negaraLainnyaBagianKota
 * @property string $noTelp
 * @property integer $nasabahPengirimSwIn_id
 *
 * The followings are the available model relations:
 * @property NasabahPengirimSwIn $nasabahPengirimSwIn
 */
class KorporasiPengirimSwIn extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return KorporasiPengirimSwIn the static model class
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
		return 'korporasiPengirimSwIn';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('noRekening, namaKorporasi,idNegaraBagianKota', 'required'),
			array('idNegaraBagianKota, nasabahPengirimSwIn_id', 'numerical', 'integerOnly'=>true),
			array('noRekening, negaraLainnyaBagianKota', 'length', 'max'=>50),
			array('namaKorporasi', 'length', 'max'=>255),
			array('alamat', 'length', 'max'=>100),
			array('negaraBagianKota, noTelp', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, noRekening, namaKorporasi, alamat, negaraBagianKota, idNegaraBagianKota, negaraLainnyaBagianKota, noTelp, nasabahPengirimSwIn_id', 'safe', 'on'=>'search'),
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
			'nasabahPengirimSwIn' => array(self::BELONGS_TO, 'NasabahPengirimSwIn', 'nasabahPengirimSwIn_id'),
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
			'alamat' => 'Alamat',
			'negaraBagianKota' => 'Negara Bagian Kota',
			'idNegaraBagianKota' => 'Negara',
			'negaraLainnyaBagianKota' => 'Negara Lainnya',
			'noTelp' => 'No Telp',
			'nasabahPengirimSwIn_id' => 'Nasabah Pengirim Sw In',
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
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('negaraBagianKota',$this->negaraBagianKota,true);
		$criteria->compare('idNegaraBagianKota',$this->idNegaraBagianKota);
		$criteria->compare('negaraLainnyaBagianKota',$this->negaraLainnyaBagianKota,true);
		$criteria->compare('noTelp',$this->noTelp,true);
		$criteria->compare('nasabahPengirimSwIn_id',$this->nasabahPengirimSwIn_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}