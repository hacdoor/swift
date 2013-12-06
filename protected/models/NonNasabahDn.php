<?php

/**
 * This is the model class for table "non_nasabah_dn".
 *
 * The followings are the available columns in table 'non_nasabah_dn':
 * @property integer $id
 * @property string $kodeRahasia
 * @property string $noRekening
 * @property string $namaLengkap
 * @property string $tglLahir
 * @property string $alamat
 * @property string $noTelp
 * @property integer $idPropinsi
 * @property string $propinsiLain
 * @property integer $idKabKota
 * @property string $kabKotaLain
 * @property string $ktp
 * @property string $sim
 * @property string $passport
 * @property string $kimsKitasKitap
 * @property string $npwp
 * @property string $jenisBuktiLain
 * @property string $noBuktiLain
 * @property integer $keterlibatanBeneficialOwner
 * @property string $hubDgnPemilikDana
 * @property double $nilaiTransaksiDalamRupiah
 * @property double $isBesarDariSeratusJuta
 * @property double $beneficialOwnerType
 * @property integer $swift_id
 *
 * The followings are the available model relations:
 * @property Propinsi $idPropinsi0
 * @property Kabupaten $idKabKota0
 * @property Swift $swift
 */
class NonNasabahDn extends CActiveRecord {

    const KETERLIBATAN_BENEFICIAL_OWNER_YA = 1;
    const KETERLIBATAN_BENEFICIAL_OWNER_TIDAK = 0;
    const BENEFICIAL_OWNER_TYPE_NASABAH = 1;
    const BENEFICIAL_OWNER_TYPE_NON_NASABAH = 0;
    const IS_BESAR_DARI_SERATUS_JUTA_YA = 1;
    const IS_BESAR_DARI_SERATUS_JUTA_TIDAK = 0;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NonNasabahDn the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'non_nasabah_dn';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('namaLengkap, idPropinsi, idKabKota, swift_id', 'required'),
            array('idPropinsi, idKabKota,isBesarDariSeratusJuta, beneficialOwnerType, keterlibatanBeneficialOwner, swift_id', 'numerical', 'integerOnly' => true),
            array('nilaiTransaksiDalamRupiah', 'numerical'),
            array('kodeRahasia, noRekening, propinsiLain, kabKotaLain, hubDgnPemilikDana', 'length', 'max' => 50),
            array('namaLengkap', 'length', 'max' => 255),
            array('alamat', 'length', 'max' => 100),
            array('noTelp, ktp, sim, passport, kimsKitasKitap, npwp, jenisBuktiLain, noBuktiLain', 'length', 'max' => 30),
            array('tglLahir', 'safe'),
            array('ktp, sim, passport, kimsKitasKitap, npwp', 'oneOfFive'),
            array('noRekening, alamat', 'oneOfTwo'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, kodeRahasia, noRekening, namaLengkap, tglLahir, alamat, noTelp, idPropinsi, propinsiLain, idKabKota, kabKotaLain, ktp, sim, passport, kimsKitasKitap, npwp, jenisBuktiLain, noBuktiLain, keterlibatanBeneficialOwner, hubDgnPemilikDana, swift_id', 'safe', 'on' => 'search'),
        );
    }

    public function oneOfFive($attribute, $params) {
        if (!$this->ktp && !$this->sim && !$this->passport && !$this->kimsKitasKitap && !$this->npwp)
            $this->addError($attribute, $attribute . ' is required.');
    }

    public function oneOfTwo($attribute, $params) {
        if (!$this->noRekening && !$this->alamat)
            $this->addError($attribute, $attribute . ' is required.');
    }
    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idPropinsi0' => array(self::BELONGS_TO, 'Propinsi', 'idPropinsi'),
            'idKabKota0' => array(self::BELONGS_TO, 'Kabupaten', 'idKabKota'),
            'swift' => array(self::BELONGS_TO, 'Swift', 'swift_id'),
        );
    }

    /**
     * @return array behaviors
     */
    public function behaviors() {
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'kodeRahasia' => 'Kode Rahasia',
            'noRekening' => 'No Rekening',
            'namaLengkap' => 'Nama Lengkap',
            'tglLahir' => 'Tgl Lahir',
            'alamat' => 'Alamat',
            'noTelp' => 'No Telp',
            'idPropinsi' => 'Propinsi',
            'propinsiLain' => 'Propinsi Lain',
            'idKabKota' => 'Kab Kota',
            'kabKotaLain' => 'Kab Kota Lain',
            'ktp' => 'KTP',
            'sim' => 'SIM',
            'passport' => 'Passport',
            'kimsKitasKitap' => 'Kims Kitas Kitap',
            'npwp' => 'NPWP',
            'jenisBuktiLain' => 'Jenis Bukti Lain',
            'noBuktiLain' => 'No Bukti Lain',
            'keterlibatanBeneficialOwner' => 'Keterlibatan Beneficial Owner',
            'hubDgnPemilikDana' => 'Hub Dgn Pemilik Dana',
            'nilaiTransaksiDalamRupiah' => 'Nilai Transaksi Dalam Rupiah',
            'isBesarDariSeratusJuta' => 'Besar Dari Seratus Juta',
            'beneficialOwnerType' => 'Beneficial Owner Type',
            'swift_id' => 'Swift',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('kodeRahasia', $this->kodeRahasia, true);
        $criteria->compare('noRekening', $this->noRekening, true);
        $criteria->compare('namaLengkap', $this->namaLengkap, true);
        $criteria->compare('tglLahir', $this->tglLahir, true);
        $criteria->compare('alamat', $this->alamat, true);
        $criteria->compare('noTelp', $this->noTelp, true);
        $criteria->compare('idPropinsi', $this->idPropinsi);
        $criteria->compare('propinsiLain', $this->propinsiLain, true);
        $criteria->compare('idKabKota', $this->idKabKota);
        $criteria->compare('kabKotaLain', $this->kabKotaLain, true);
        $criteria->compare('ktp', $this->ktp, true);
        $criteria->compare('sim', $this->sim, true);
        $criteria->compare('passport', $this->passport, true);
        $criteria->compare('kimsKitasKitap', $this->kimsKitasKitap, true);
        $criteria->compare('npwp', $this->npwp, true);
        $criteria->compare('jenisBuktiLain', $this->jenisBuktiLain, true);
        $criteria->compare('noBuktiLain', $this->noBuktiLain, true);
        $criteria->compare('keterlibatanBeneficialOwner', $this->keterlibatanBeneficialOwner);
        $criteria->compare('hubDgnPemilikDana', $this->hubDgnPemilikDana, true);
        $criteria->compare('isBesarDariSeratusJuta', $this->isBesarDariSeratusJuta, true);
        $criteria->compare('beneficialOwnerType', $this->beneficialOwnerType, true);
        $criteria->compare('swift_id', $this->swift_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}