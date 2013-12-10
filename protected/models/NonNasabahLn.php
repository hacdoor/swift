<?php

/**
 * This is the model class for table "non_nasabah_ln".
 *
 * The followings are the available columns in table 'non_nasabah_ln':
 * @property integer $id
 * @property string $kodeRahasia
 * @property string $noRekening
 * @property string $namaLengkap
 * @property string $tglLahir
 * @property string $alamat
 * @property string $noTelp
 * @property string $negaraBagianKota
 * @property integer $idNegara
 * @property string $negaraLain
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
 * @property Negara $idNegara0
 * @property Swift $swift
 */
class NonNasabahLn extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NonNasabahLn the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'non_nasabah_ln';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('namaLengkap, negaraBagianKota, idNegara, swift_id', 'required'),
            array('idNegara, swift_id', 'numerical', 'integerOnly' => true),
            array('nilaiTransaksiDalamRupiah', 'numerical'),
            array('kodeRahasia, noRekening, negaraLain', 'length', 'max' => 50),
            array('namaLengkap', 'length', 'max' => 255),
            array('alamat', 'length', 'max' => 100),
            array('noTelp, negaraBagianKota, ktp, sim, passport, kimsKitasKitap, npwp, jenisBuktiLain, noBuktiLain', 'length', 'max' => 30),
            array('tglLahir', 'safe'),
            array('ktp, sim, passport, kimsKitasKitap, npwp', 'oneOfFive', 'on' => 'other'),
            array('noRekening, alamat', 'oneOfTwo'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, kodeRahasia, noRekening, namaLengkap, tglLahir, alamat, noTelp, negaraBagianKota, idNegara, negaraLain, ktp, sim, passport, kimsKitasKitap, npwp, jenisBuktiLain, noBuktiLain, swift_id', 'safe', 'on' => 'search'),
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
            'idNegara0' => array(self::BELONGS_TO, 'Negara', 'idNegara'),
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
            'negaraBagianKota' => 'Negara Bagian Kota',
            'idNegara' => 'Negara',
            'negaraLain' => 'Negara Lain',
            'ktp' => 'KTP',
            'sim' => 'SIM',
            'passport' => 'Passport',
            'kimsKitasKitap' => 'Kims Kitas Kitap',
            'npwp' => 'NPWP',
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
        $criteria->compare('negaraBagianKota', $this->negaraBagianKota, true);
        $criteria->compare('idNegara', $this->idNegara);
        $criteria->compare('negaraLain', $this->negaraLain, true);
        $criteria->compare('ktp', $this->ktp, true);
        $criteria->compare('sim', $this->sim, true);
        $criteria->compare('passport', $this->passport, true);
        $criteria->compare('kimsKitasKitap', $this->kimsKitasKitap, true);
        $criteria->compare('npwp', $this->npwp, true);
        $criteria->compare('jenisBuktiLain', $this->jenisBuktiLain, true);
        $criteria->compare('noBuktiLain', $this->noBuktiLain, true);
        $criteria->compare('swift_id', $this->swift_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}