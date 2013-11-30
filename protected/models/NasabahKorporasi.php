<?php

/**
 * This is the model class for table "nasabahKorporasi".
 *
 * The followings are the available columns in table 'nasabahKorporasi':
 * @property integer $id
 * @property string $noRekening
 * @property string $namaKorporasi
 * @property integer $idBentukBadan
 * @property string $bentukBadanLainnya
 * @property integer $idBidangUsaha
 * @property string $bidangUsahaLainnya
 * @property string $alamat
 * @property integer $idPropinsi
 * @property string $propinsiLainnya
 * @property integer $idKabKota
 * @property string $kabKotaLainnya
 * @property string $noTelp
 */
class NasabahKorporasi extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NasabahKorporasi the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'nasabah_korporasi';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('noRekening, namaKorporasi,idBentukBadan, idBidangUsaha, alamat, idPropinsi, idKabKota', 'required'),
            array('idBentukBadan, idBidangUsaha, idPropinsi, idKabKota', 'numerical', 'integerOnly' => true),
            array('noRekening, bentukBadanLainnya, bidangUsahaLainnya, propinsiLainnya, kabKotaLainnya', 'length', 'max' => 50),
            array('noRekening, bentukBadanLainnya, bidangUsahaLainnya, propinsiLainnya, kabKotaLainnya,namaKorporasi,alamat,noTelp', 'length', 'min' => 2),
            array('namaKorporasi', 'length', 'max' => 255),
            array('alamat', 'length', 'max' => 100),
            array('noTelp', 'length', 'max' => 30),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, noRekening, namaKorporasi, idBentukBadan, bentukBadanLainnya, idBidangUsaha, bidangUsahaLainnya, alamat, idPropinsi, propinsiLainnya, idKabKota, kabKotaLainnya, noTelp', 'safe', 'on' => 'search'),
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
            'namaKorporasi' => 'Nama Korporasi',
            'idBentukBadan' => 'Bentuk Badan Usaha',
            'bentukBadanLainnya' => 'Bentuk Badan Usaha Lainnya',
            'idBidangUsaha' => 'Bidang Usaha',
            'bidangUsahaLainnya' => 'Bidang Usaha Lainnya',
            'alamat' => 'Alamat',
            'idPropinsi' => 'Propinsi',
            'propinsiLainnya' => 'Propinsi Lainnya',
            'idKabKota' => 'Kab Kota',
            'kabKotaLainnya' => 'Kab Kota Lainnya',
            'noTelp' => 'No Telp',
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
        $criteria->compare('namaKorporasi', $this->namaKorporasi, true);
        $criteria->compare('idBentukBadan', $this->idBentukBadan);
        $criteria->compare('bentukBadanLainnya', $this->bentukBadanLainnya, true);
        $criteria->compare('idBidangUsaha', $this->idBidangUsaha);
        $criteria->compare('bidangUsahaLainnya', $this->bidangUsahaLainnya, true);
        $criteria->compare('alamat', $this->alamat, true);
        $criteria->compare('idPropinsi', $this->idPropinsi);
        $criteria->compare('propinsiLainnya', $this->propinsiLainnya, true);
        $criteria->compare('idKabKota', $this->idKabKota);
        $criteria->compare('kabKotaLainnya', $this->kabKotaLainnya, true);
        $criteria->compare('noTelp', $this->noTelp, true);

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
                $t = $key->attributes;

                $label = $key->noRekening . ' (' . $key->namaKorporasi . ')';
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