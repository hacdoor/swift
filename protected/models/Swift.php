<?php

/**
 * This is the model class for table "swift".
 *
 * The followings are the available columns in table 'swift':
 * @property integer $id
 * @property string $localId
 * @property string $noLtdln
 * @property string $noLtdlnKoreksi
 * @property string $tglLaporan
 * @property string $namaPjk
 * @property string $namaPejabatPjk
 * @property integer $jenisLaporan
 * @property integer $pjkBankSebagai
 * @property integer $jenisSwift
 *
 * The followings are the available model relations:
 * @property BeneficialOwner[] $beneficialOwners
 * @property IdentitasPenerimaNonSwIn[] $identitasPenerimaNonSwIns
 * @property IdentitasPenerimaNonSwOut[] $identitasPenerimaNonSwOuts
 * @property IdentitasPenerimaSwIn[] $identitasPenerimaSwIns
 * @property IdentitasPenerimaSwOut[] $identitasPenerimaSwOuts
 * @property IdentitasPengirimNonSwIn[] $identitasPengirimNonSwIns
 * @property IdentitasPengirimNonSwOut[] $identitasPengirimNonSwOuts
 * @property IdentitasPengirimSwIn[] $identitasPengirimSwIns
 * @property IdentitasPengirimSwOut[] $identitasPengirimSwOuts
 * @property InfoLain[] $infoLains
 * @property TransaksiNonSwift[] $transaksiNonSwifts
 * @property TransaksiSwift[] $transaksiSwifts
 */
class Swift extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Swift the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'swift';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('localId, noLtdln, tglLaporan, namaPjk, namaPejabatPjk, jenisLaporan, pjkBankSebagai, jenisSwift', 'required'),
            array('noLtdln', 'unique'),
            array('jenisLaporan, pjkBankSebagai, jenisSwift', 'numerical', 'integerOnly' => true),
            array('localId', 'length', 'max' => 50),
            array('noLtdln, noLtdlnKoreksi', 'length', 'max' => 30),
            array('namaPjk, namaPejabatPjk', 'length', 'max' => 100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, localId, noLtdln, noLtdlnKoreksi, tglLaporan, namaPjk, namaPejabatPjk, jenisLaporan, pjkBankSebagai, jenisSwift', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'beneficialOwners' => array(self::HAS_MANY, 'BeneficialOwner', 'swift_id'),
            'identitasPenerimaNonSwIns' => array(self::HAS_MANY, 'IdentitasPenerimaNonSwIn', 'swift_id'),
            'identitasPenerimaNonSwOuts' => array(self::HAS_MANY, 'IdentitasPenerimaNonSwOut', 'swift_id'),
            'identitasPenerimaSwIns' => array(self::HAS_MANY, 'IdentitasPenerimaSwIn', 'swift_id'),
            'identitasPenerimaSwOuts' => array(self::HAS_MANY, 'IdentitasPenerimaSwOut', 'swift_id'),
            'identitasPengirimNonSwIns' => array(self::HAS_MANY, 'IdentitasPengirimNonSwIn', 'swift_id'),
            'identitasPengirimNonSwOuts' => array(self::HAS_MANY, 'IdentitasPengirimNonSwOut', 'swift_id'),
            'identitasPengirimSwIns' => array(self::HAS_MANY, 'IdentitasPengirimSwIn', 'swift_id'),
            'identitasPengirimSwOuts' => array(self::HAS_MANY, 'IdentitasPengirimSwOut', 'swift_id'),
            'infoLains' => array(self::HAS_MANY, 'InfoLain', 'swift_id'),
            'transaksiNonSwifts' => array(self::HAS_MANY, 'TransaksiNonSwift', 'swift_id'),
            'transaksiSwifts' => array(self::HAS_MANY, 'TransaksiSwift', 'swift_id'),
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
            'localId' => 'Local',
            'noLtdln' => 'No Ltdln',
            'noLtdlnKoreksi' => 'No Ltdln Koreksi',
            'tglLaporan' => 'Tgl Laporan',
            'namaPjk' => 'Nama Pjk',
            'namaPejabatPjk' => 'Nama Pejabat Pjk',
            'jenisLaporan' => 'Jenis Laporan',
            'pjkBankSebagai' => 'Pjk Bank Sebagai',
            'jenisSwift' => 'Jenis Swift',
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
        $criteria->compare('localId', $this->localId, true);
        $criteria->compare('noLtdln', $this->noLtdln, true);
        $criteria->compare('noLtdlnKoreksi', $this->noLtdlnKoreksi, true);
        $criteria->compare('tglLaporan', $this->tglLaporan, true);
        $criteria->compare('namaPjk', $this->namaPjk, true);
        $criteria->compare('namaPejabatPjk', $this->namaPejabatPjk, true);
        $criteria->compare('jenisLaporan', $this->jenisLaporan);
        $criteria->compare('pjkBankSebagai', $this->pjkBankSebagai);
        $criteria->compare('jenisSwift', $this->jenisSwift);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
                ));
    }

}