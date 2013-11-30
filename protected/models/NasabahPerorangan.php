<?php

/**
 * This is the model class for table "nasabahPerorangan".
 *
 * The followings are the available columns in table 'nasabahPerorangan':
 * @property integer $id
 * @property string $noRekening
 * @property string $namaLengkap
 * @property string $tglLahir
 * @property integer $kewarganegaraan
 * @property integer $idNegaraKewarganegaraan
 * @property string $negaraLainnyaKewarganegaraan
 * @property integer $idPekerjaan
 * @property string $pekerjaanLainnya
 * @property string $alamat
 * @property integer $idPropinsi
 * @property string $propinsiLainnya
 * @property string $idKabKota
 * @property string $kabKotaLainnya
 * @property string $alamatBuktiIdentitas
 * @property integer $idPropinsiBuktiIdentitas
 * @property string $propinsiLainnyaBuktiIdentitas
 * @property integer $idKabKotaBuktiIdentitas
 * @property string $kabKotaLainnyaBuktiIdentitas
 * @property string $noTelp
 * @property string $ktp
 * @property string $sim
 * @property string $passport
 * @property string $kimsKitasKitab
 * @property string $npwp
 * @property string $jenisBuktiLain
 * @property string $noBuktiLain
 */
class NasabahPerorangan extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NasabahPerorangan the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'nasabah_perorangan';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('noRekening, namaLengkap, tglLahir, idPekerjaan, alamatBuktiIdentitas, idPropinsiBuktiIdentitas, kewarganegaraan', 'required'),
            array('kewarganegaraan, idNegaraKewarganegaraan, idPekerjaan, idPropinsi, idPropinsiBuktiIdentitas, idKabKotaBuktiIdentitas', 'numerical', 'integerOnly' => true),
            array('noRekening, negaraLainnyaKewarganegaraan, pekerjaanLainnya, propinsiLainnya, kabKotaLainnya, propinsiLainnyaBuktiIdentitas, kabKotaLainnyaBuktiIdentitas', 'length', 'max' => 50),
            array('namaLengkap', 'length', 'max' => 255),
            array('alamat, alamatBuktiIdentitas', 'length', 'max' => 100),
            array('idKabKota', 'length', 'max' => 45),
            array('noTelp, ktp, sim, passport, kimsKitasKitab, npwp, jenisBuktiLain, noBuktiLain', 'length', 'max' => 30),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, noRekening, namaLengkap, tglLahir, kewarganegaraan, idNegaraKewarganegaraan, negaraLainnyaKewarganegaraan, idPekerjaan, pekerjaanLainnya, alamat, idPropinsi, propinsiLainnya, idKabKota, kabKotaLainnya, alamatBuktiIdentitas, idPropinsiBuktiIdentitas, propinsiLainnyaBuktiIdentitas, idKabKotaBuktiIdentitas, kabKotaLainnyaBuktiIdentitas, noTelp, ktp, sim, passport, kimsKitasKitab, npwp, jenisBuktiLain, noBuktiLain', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'propinsi' => array(self::BELONGS_TO, 'Propinsi', 'idPropinsi'),
            'kabupaten' => array(self::BELONGS_TO, 'Kabupaten', 'idKabKota'),
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
            'kewarganegaraan' => 'Kewarganegaraan',
            'idNegaraKewarganegaraan' => 'Negara Kewarganegaraan',
            'negaraLainnyaKewarganegaraan' => 'Negara Lainnya Kewarganegaraan',
            'idPekerjaan' => 'Pekerjaan',
            'pekerjaanLainnya' => 'Pekerjaan Lainnya',
            'alamat' => 'Alamat',
            'idPropinsi' => 'Propinsi',
            'propinsiLainnya' => 'Propinsi Lainnya',
            'idKabKota' => 'Kab Kota',
            'kabKotaLainnya' => 'Kab Kota Lainnya',
            'alamatBuktiIdentitas' => 'Alamat Bukti Identitas',
            'idPropinsiBuktiIdentitas' => 'Propinsi Bukti Identitas',
            'propinsiLainnyaBuktiIdentitas' => 'Propinsi Lainnya Bukti Identitas',
            'idKabKotaBuktiIdentitas' => 'Kab Kota Bukti Identitas',
            'kabKotaLainnyaBuktiIdentitas' => 'Kab Kota Lainnya Bukti Identitas',
            'noTelp' => 'No Telp',
            'ktp' => 'Ktp',
            'sim' => 'Sim',
            'passport' => 'Passport',
            'kimsKitasKitab' => 'Kims Kitas Kitab',
            'npwp' => 'Npwp',
            'jenisBuktiLain' => 'Jenis Bukti Lain',
            'noBuktiLain' => 'No Bukti Lain',
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
        $criteria->compare('kewarganegaraan', $this->kewarganegaraan);
        $criteria->compare('idNegaraKewarganegaraan', $this->idNegaraKewarganegaraan);
        $criteria->compare('negaraLainnyaKewarganegaraan', $this->negaraLainnyaKewarganegaraan, true);
        $criteria->compare('idPekerjaan', $this->idPekerjaan);
        $criteria->compare('pekerjaanLainnya', $this->pekerjaanLainnya, true);
        $criteria->compare('alamat', $this->alamat, true);
        $criteria->compare('idPropinsi', $this->idPropinsi);
        $criteria->compare('propinsiLainnya', $this->propinsiLainnya, true);
        $criteria->compare('idKabKota', $this->idKabKota, true);
        $criteria->compare('kabKotaLainnya', $this->kabKotaLainnya, true);
        $criteria->compare('alamatBuktiIdentitas', $this->alamatBuktiIdentitas, true);
        $criteria->compare('idPropinsiBuktiIdentitas', $this->idPropinsiBuktiIdentitas);
        $criteria->compare('propinsiLainnyaBuktiIdentitas', $this->propinsiLainnyaBuktiIdentitas, true);
        $criteria->compare('idKabKotaBuktiIdentitas', $this->idKabKotaBuktiIdentitas);
        $criteria->compare('kabKotaLainnyaBuktiIdentitas', $this->kabKotaLainnyaBuktiIdentitas, true);
        $criteria->compare('noTelp', $this->noTelp, true);
        $criteria->compare('ktp', $this->ktp, true);
        $criteria->compare('sim', $this->sim, true);
        $criteria->compare('passport', $this->passport, true);
        $criteria->compare('kimsKitasKitab', $this->kimsKitasKitab, true);
        $criteria->compare('npwp', $this->npwp, true);
        $criteria->compare('jenisBuktiLain', $this->jenisBuktiLain, true);
        $criteria->compare('noBuktiLain', $this->noBuktiLain, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
                ));
    }

    public function getNoRekening($keyword, $limit = 20) {
        $noRek = $this->findAll(array(
            'condition' => 'noRekening LIKE :keyword',
            'order' => 'noRekening ASC',
            'limit' => $limit,
            'params' => array(
                ':keyword' => '%' . strtr($keyword, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%',
            ),
                ));
        $response = array();
        if ($noRek) {
            foreach ($noRek as $key) {
                $key->tglLahir = date('d-m-Y', strtotime($key->tglLahir));
                $t = $key->attributes;

                $label = $key->noRekening . ' (' . $key->namaLengkap . ')';
                $t1 = array(
                    'label' => $label,
                    'value' => $key->noRekening
                );
                $response[] = array_merge($t1, $t);
            }
        }
        return $response;
    }

}