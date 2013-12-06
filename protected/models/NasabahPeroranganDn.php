<?php

/**
 * This is the model class for table "nasabah_perorangan_dn".
 *
 * The followings are the available columns in table 'nasabah_perorangan_dn':
 * @property integer $id
 * @property string $noRekening
 * @property string $namaLengkap
 * @property string $tglLahir
 * @property integer $wargaNegara
 * @property integer $idNegaraKewarganegaraan
 * @property string $negaraLainKewarganegaraan
 * @property integer $pekerjaan
 * @property string $pekerjaanLain
 * @property string $alamatDomisili
 * @property integer $idPropinsiDomisili
 * @property string $propinsiLainDomisili
 * @property integer $idKabKotaDomisili
 * @property string $kabKotaLain
 * @property string $alamatIdentitas
 * @property integer $idPropinsiIdentitas
 * @property string $propinsiLainIdentitas
 * @property integer $idKabKotaIdentitas
 * @property string $kabKotaLainIdentitas
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
 * @property Propinsi $idPropinsiDomisili0
 * @property Kabupaten $idKabKotaDomisili0
 * @property Propinsi $idPropinsiIdentitas0
 * @property Kabupaten $idKabKotaIdentitas0
 * @property Swift $swift
 */
class NasabahPeroranganDn extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NasabahPeroranganDn the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'nasabah_perorangan_dn';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('noRekening, tglLahir, namaLengkap, idNegaraKewarganegaraan, idPropinsiDomisili, idKabKotaDomisili, idPropinsiIdentitas, idKabKotaIdentitas, swift_id', 'required'),
            array('wargaNegara, idNegaraKewarganegaraan, pekerjaan, idPropinsiDomisili, idKabKotaDomisili, idPropinsiIdentitas, idKabKotaIdentitas, swift_id', 'numerical', 'integerOnly' => true),
            array('nilaiTransaksiDalamRupiah', 'numerical'),
            array('noRekening, negaraLainKewarganegaraan, pekerjaanLain, propinsiLainDomisili, kabKotaLain, propinsiLainIdentitas, kabKotaLainIdentitas', 'length', 'max' => 50),
            array('namaLengkap', 'length', 'max' => 255),
            array('alamatDomisili, alamatIdentitas', 'length', 'max' => 100),
            array('noTelp, ktp, sim, passport, kimsKitasKitap, npwp, jenisBuktiLain, noBuktiLain', 'length', 'max' => 30),
            array('tglLahir', 'safe'),
            array('ktp, sim, passport, kimsKitasKitap, npwp', 'oneOfFive'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, noRekening, namaLengkap, tglLahir, wargaNegara, idNegaraKewarganegaraan, negaraLainKewarganegaraan, pekerjaan, pekerjaanLain, alamatDomisili, idPropinsiDomisili, propinsiLainDomisili, idKabKotaDomisili, kabKotaLain, alamatIdentitas, idPropinsiIdentitas, propinsiLainIdentitas, idKabKotaIdentitas, kabKotaLainIdentitas, noTelp, ktp, sim, passport, kimsKitasKitap, npwp, jenisBuktiLain, noBuktiLain, swift_id', 'safe', 'on' => 'search'),
        );
    }

    public function oneOfFive($attribute, $params) {
        if (!$this->ktp && !$this->sim && !$this->passport && !$this->kimsKitasKitap && !$this->npwp)
            $this->addError($attribute, $attribute . ' is required.');
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idNegaraKewarganegaraan0' => array(self::BELONGS_TO, 'Negara', 'idNegaraKewarganegaraan'),
            'idPropinsiDomisili0' => array(self::BELONGS_TO, 'Propinsi', 'idPropinsiDomisili'),
            'idKabKotaDomisili0' => array(self::BELONGS_TO, 'Kabupaten', 'idKabKotaDomisili'),
            'idPropinsiIdentitas0' => array(self::BELONGS_TO, 'Propinsi', 'idPropinsiIdentitas'),
            'idKabKotaIdentitas0' => array(self::BELONGS_TO, 'Kabupaten', 'idKabKotaIdentitas'),
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
            'noRekening' => 'No Rekening',
            'namaLengkap' => 'Nama Lengkap',
            'tglLahir' => 'Tgl Lahir',
            'wargaNegara' => 'Warga Negara',
            'idNegaraKewarganegaraan' => 'Kewarganegaraan',
            'negaraLainKewarganegaraan' => 'Kewarganegaraan Lain',
            'pekerjaan' => 'Pekerjaan',
            'pekerjaanLain' => 'Pekerjaan Lain',
            'alamatDomisili' => 'Alamat Domisili',
            'idPropinsiDomisili' => 'Propinsi',
            'propinsiLainDomisili' => 'Propinsi Lain',
            'idKabKotaDomisili' => 'Kab Kota',
            'kabKotaLain' => 'Kab Kota Lain',
            'alamatIdentitas' => 'Alamat Identitas',
            'idPropinsiIdentitas' => 'Propinsi',
            'propinsiLainIdentitas' => 'Propinsi Lain',
            'idKabKotaIdentitas' => 'Kab Kota',
            'kabKotaLainIdentitas' => 'Kab Kota Lain',
            'noTelp' => 'No Telp',
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
        $criteria->compare('noRekening', $this->noRekening, true);
        $criteria->compare('namaLengkap', $this->namaLengkap, true);
        $criteria->compare('tglLahir', $this->tglLahir, true);
        $criteria->compare('wargaNegara', $this->wargaNegara);
        $criteria->compare('idNegaraKewarganegaraan', $this->idNegaraKewarganegaraan);
        $criteria->compare('negaraLainKewarganegaraan', $this->negaraLainKewarganegaraan, true);
        $criteria->compare('pekerjaan', $this->pekerjaan);
        $criteria->compare('pekerjaanLain', $this->pekerjaanLain, true);
        $criteria->compare('alamatDomisili', $this->alamatDomisili, true);
        $criteria->compare('idPropinsiDomisili', $this->idPropinsiDomisili);
        $criteria->compare('propinsiLainDomisili', $this->propinsiLainDomisili, true);
        $criteria->compare('idKabKotaDomisili', $this->idKabKotaDomisili);
        $criteria->compare('kabKotaLain', $this->kabKotaLain, true);
        $criteria->compare('alamatIdentitas', $this->alamatIdentitas, true);
        $criteria->compare('idPropinsiIdentitas', $this->idPropinsiIdentitas);
        $criteria->compare('propinsiLainIdentitas', $this->propinsiLainIdentitas, true);
        $criteria->compare('idKabKotaIdentitas', $this->idKabKotaIdentitas);
        $criteria->compare('kabKotaLainIdentitas', $this->kabKotaLainIdentitas, true);
        $criteria->compare('noTelp', $this->noTelp, true);
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