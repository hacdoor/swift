<?php


/**
 * This is the model class for table "nasabah_perorangan_ln".
 *
 * The followings are the available columns in table 'nasabah_perorangan_ln':
 * @property integer $id
 * @property string $noRekening
 * @property string $namaLengkap
 * @property string $tglLahir
 * @property integer $wargaNegara
 * @property integer $idNegaraKewarganegaraan
 * @property string $negaraLainKewarganegaraan
 * @property string $alamat
 * @property string $negaraBagianKota
 * @property integer $idNegaraVoucher
 * @property string $negaraLainVoucher
 * @property string $noTelp
 * @property string $ktp
 * @property string $sim
 * @property string $passport
 * @property string $kimsKitasKitap
 * @property string $npwp
 * @property string $jenisBuktiLain
 * @property string $noBuktiLain
 * @property double $nilaiTransaksiDalamRupiah
 * @property integer $swift_id
 *
 * The followings are the available model relations:
 * @property Negara $idNegaraKewarganegaraan0
 * @property Negara $idNegaraVoucher0
 * @property Swift $swift
 */
class NasabahPeroranganLn extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NasabahPeroranganLn the static model class
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
		return 'nasabah_perorangan_ln';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('noRekening, namaLengkap, idNegaraKewarganegaraan, idNegaraVoucher, swift_id', 'required'),
			array('wargaNegara, idNegaraKewarganegaraan, idNegaraVoucher, swift_id', 'numerical', 'integerOnly'=>true),
			array('nilaiTransaksiDalamRupiah', 'numerical'),
			array('noRekening, negaraLainKewarganegaraan, negaraBagianKota, negaraLainVoucher', 'length', 'max'=>50),
			array('namaLengkap', 'length', 'max'=>255),
			array('alamat', 'length', 'max'=>100),
			array('noTelp, ktp, sim, passport, kimsKitasKitap, npwp, jenisBuktiLain, noBuktiLain', 'length', 'max'=>30),
			array('tglLahir', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, noRekening, namaLengkap, tglLahir, wargaNegara, idNegaraKewarganegaraan, negaraLainKewarganegaraan, alamat, negaraBagianKota, idNegaraVoucher, negaraLainVoucher, noTelp, ktp, sim, passport, kimsKitasKitap, npwp, jenisBuktiLain, noBuktiLain, swift_id', 'safe', 'on'=>'search'),
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
			'idNegaraKewarganegaraan0' => array(self::BELONGS_TO, 'Negara', 'idNegaraKewarganegaraan'),
			'idNegaraVoucher0' => array(self::BELONGS_TO, 'Negara', 'idNegaraVoucher'),
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
			'namaLengkap' => 'Nama Lengkap',
			'tglLahir' => 'Tgl Lahir',
			'wargaNegara' => 'Warga Negara',
			'idNegaraKewarganegaraan' => 'Negara',
			'negaraLainKewarganegaraan' => 'Negara Lain',
			'alamat' => 'Alamat',
			'negaraBagianKota' => 'Negara Bagian Kota',
			'idNegaraVoucher' => 'Negara',
			'negaraLainVoucher' => 'Negara Lain',
			'noTelp' => 'No Telp',
			'ktp' => 'KTP',
			'sim' => 'SIM',
			'passport' => 'Passport',
			'kimsKitasKitap' => 'Kims Kitas Kitap',
			'npwp' => 'Npwp',
			'jenisBuktiLain' => 'Jenis Bukti Lain',
			'noBuktiLain' => 'No Bukti Lain',
			'nilaiTransaksiDalamRupiah' => 'Nilai Transaksi Dalam Rupiah',
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
		$criteria->compare('namaLengkap',$this->namaLengkap,true);
		$criteria->compare('tglLahir',$this->tglLahir,true);
		$criteria->compare('wargaNegara',$this->wargaNegara);
		$criteria->compare('idNegaraKewarganegaraan',$this->idNegaraKewarganegaraan);
		$criteria->compare('negaraLainKewarganegaraan',$this->negaraLainKewarganegaraan,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('negaraBagianKota',$this->negaraBagianKota,true);
		$criteria->compare('idNegaraVoucher',$this->idNegaraVoucher);
		$criteria->compare('negaraLainVoucher',$this->negaraLainVoucher,true);
		$criteria->compare('noTelp',$this->noTelp,true);
		$criteria->compare('ktp',$this->ktp,true);
		$criteria->compare('sim',$this->sim,true);
		$criteria->compare('passport',$this->passport,true);
		$criteria->compare('kimsKitasKitap',$this->kimsKitasKitap,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('jenisBuktiLain',$this->jenisBuktiLain,true);
		$criteria->compare('noBuktiLain',$this->noBuktiLain,true);
		$criteria->compare('swift_id',$this->swift_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}