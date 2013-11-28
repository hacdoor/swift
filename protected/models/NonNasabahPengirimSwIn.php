<?php


/**
 * This is the model class for table "nonNasabahPengirimSwIn".
 *
 * The followings are the available columns in table 'nonNasabahPengirimSwIn':
 * @property integer $id
 * @property integer $identitasPengirimSwIn_id
 * @property string $noRekening
 * @property string $namaLengkap
 * @property string $tglLahir
 * @property string $alamat
 * @property string $negaraBagianKota
 * @property integer $idNegaraBagianKota
 * @property string $negaraLainnyaBagianKota
 * @property string $noTelp
 *
 * The followings are the available model relations:
 * @property IdentitasPengirimSwIn $identitasPengirimSwIn
 */
class NonNasabahPengirimSwIn extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NonNasabahPengirimSwIn the static model class
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
		return 'nonNasabahPengirimSwIn';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('noRekening, namaLengkap', 'required'),
			array('identitasPengirimSwIn_id, idNegaraBagianKota', 'numerical', 'integerOnly'=>true),
			array('noRekening, negaraLainnyaBagianKota', 'length', 'max'=>50),
			array('namaLengkap', 'length', 'max'=>255),
			array('alamat', 'length', 'max'=>100),
			array('negaraBagianKota, noTelp', 'length', 'max'=>30),
			array('tglLahir', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, identitasPengirimSwIn_id, noRekening, namaLengkap, tglLahir, alamat, negaraBagianKota, idNegaraBagianKota, negaraLainnyaBagianKota, noTelp', 'safe', 'on'=>'search'),
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
			'identitasPengirimSwIn' => array(self::BELONGS_TO, 'IdentitasPengirimSwIn', 'identitasPengirimSwIn_id'),
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
			'noRekening' => 'No Rekening',
			'namaLengkap' => 'Nama Lengkap',
			'tglLahir' => 'Tgl Lahir',
			'alamat' => 'Alamat',
			'negaraBagianKota' => 'Negara Bagian Kota',
			'idNegaraBagianKota' => 'Negara',
			'negaraLainnyaBagianKota' => 'Negara Lainnya',
			'noTelp' => 'No Telp',
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
		$criteria->compare('noRekening',$this->noRekening,true);
		$criteria->compare('namaLengkap',$this->namaLengkap,true);
		$criteria->compare('tglLahir',$this->tglLahir,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('negaraBagianKota',$this->negaraBagianKota,true);
		$criteria->compare('idNegaraBagianKota',$this->idNegaraBagianKota);
		$criteria->compare('negaraLainnyaBagianKota',$this->negaraLainnyaBagianKota,true);
		$criteria->compare('noTelp',$this->noTelp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}