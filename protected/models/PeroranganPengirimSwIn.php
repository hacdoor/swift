<?php


/**
 * This is the model class for table "peroranganPengirimSwIn".
 *
 * The followings are the available columns in table 'peroranganPengirimSwIn':
 * @property integer $id
 * @property string $noRekening
 * @property string $namaLengkap
 * @property string $tglLahir
 * @property integer $kewarganegaraan
 * @property integer $idNegaraKewarganegaraan
 * @property string $negaraLainnyaKewarganegaraan
 * @property string $alamat
 * @property string $negaraBagianKota
 * @property integer $idNegaraBagianKota
 * @property string $negaraLainnyaBagianKota
 * @property string $noTelp
 * @property string $ktp
 * @property string $sim
 * @property string $passport
 * @property string $kimsKitasKitab
 * @property string $npwp
 * @property string $jenisBuktiLain
 * @property string $noBuktiLain
 * @property integer $nasabahPengirimSwIn_id
 *
 * The followings are the available model relations:
 * @property NasabahPengirimSwIn $nasabahPengirimSwIn
 */
class PeroranganPengirimSwIn extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PeroranganPengirimSwIn the static model class
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
		return 'peroranganPengirimSwIn';
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
			array('kewarganegaraan, idNegaraKewarganegaraan, idNegaraBagianKota, nasabahPengirimSwIn_id', 'numerical', 'integerOnly'=>true),
			array('noRekening, negaraLainnyaKewarganegaraan, negaraLainnyaBagianKota', 'length', 'max'=>50),
			array('namaLengkap', 'length', 'max'=>255),
			array('alamat', 'length', 'max'=>100),
			array('negaraBagianKota, noTelp, ktp, sim, passport, kimsKitasKitab, npwp, jenisBuktiLain, noBuktiLain', 'length', 'max'=>30),
			array('tglLahir', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, noRekening, namaLengkap, tglLahir, kewarganegaraan, idNegaraKewarganegaraan, negaraLainnyaKewarganegaraan, alamat, negaraBagianKota, idNegaraBagianKota, negaraLainnyaBagianKota, noTelp, ktp, sim, passport, kimsKitasKitab, npwp, jenisBuktiLain, noBuktiLain, nasabahPengirimSwIn_id', 'safe', 'on'=>'search'),
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
			'namaLengkap' => 'Nama Lengkap',
			'tglLahir' => 'Tgl Lahir',
			'kewarganegaraan' => 'Kewarganegaraan',
			'idNegaraKewarganegaraan' => 'Negara Kewarganegaraan',
			'negaraLainnyaKewarganegaraan' => 'Negara Lainnya Kewarganegaraan',
			'alamat' => 'Alamat',
			'negaraBagianKota' => 'Negara Bagian Kota',
			'idNegaraBagianKota' => 'Negara',
			'negaraLainnyaBagianKota' => 'Negara Lainnya',
			'noTelp' => 'No Telp',
			'ktp' => 'Ktp',
			'sim' => 'Sim',
			'passport' => 'Passport',
			'kimsKitasKitab' => 'Kims Kitas Kitab',
			'npwp' => 'Npwp',
			'jenisBuktiLain' => 'Jenis Bukti Lain',
			'noBuktiLain' => 'No Bukti Lain',
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
		$criteria->compare('namaLengkap',$this->namaLengkap,true);
		$criteria->compare('tglLahir',$this->tglLahir,true);
		$criteria->compare('kewarganegaraan',$this->kewarganegaraan);
		$criteria->compare('idNegaraKewarganegaraan',$this->idNegaraKewarganegaraan);
		$criteria->compare('negaraLainnyaKewarganegaraan',$this->negaraLainnyaKewarganegaraan,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('negaraBagianKota',$this->negaraBagianKota,true);
		$criteria->compare('idNegaraBagianKota',$this->idNegaraBagianKota);
		$criteria->compare('negaraLainnyaBagianKota',$this->negaraLainnyaBagianKota,true);
		$criteria->compare('noTelp',$this->noTelp,true);
		$criteria->compare('ktp',$this->ktp,true);
		$criteria->compare('sim',$this->sim,true);
		$criteria->compare('passport',$this->passport,true);
		$criteria->compare('kimsKitasKitab',$this->kimsKitasKitab,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('jenisBuktiLain',$this->jenisBuktiLain,true);
		$criteria->compare('noBuktiLain',$this->noBuktiLain,true);
		$criteria->compare('nasabahPengirimSwIn_id',$this->nasabahPengirimSwIn_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}