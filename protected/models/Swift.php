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
 * @property integer $status
 * @property integer $keterlibatanBeneficialOwner
 *
 * The followings are the available model relations:
 * @property Infolain[] $infolains
 * @property NasabahKorporasiDn[] $nasabahKorporasiDns
 * @property NasabahKorporasiLn[] $nasabahKorporasiLns
 * @property NasabahPeroranganDn[] $nasabahPeroranganDns
 * @property NasabahPeroranganLn[] $nasabahPeroranganLns
 * @property NonNasabahDn[] $nonNasabahDns
 * @property NonNasabahLn[] $nonNasabahLns
 * @property Transaksi[] $transaksis
 */
class Swift extends CActiveRecord {

    const TYPE_SWIN = 1;
    const TYPE_SWOUT = 2;
    const TYPE_NONSWIN = 3;
    const TYPE_NONSWOUT = 4;
    const STATUS_DRAFT = 1;
    const STATUS_FINALIZE = 2;
    const JENIS_LAPORAN_BARU = 1;
    const JENIS_LAPORAN_KOREKSI = 2;
    const JENIS_LAPORAN_RECALL = 3;
    const JENIS_LAPORAN_REJECT = 4;
    
    const KETERLIBATAN_BENEFICIAL_OWNER_YA = 1;
    const KETERLIBATAN_BENEFICIAL_OWNER_TIDAK = 0;


    public static function getKeterlibatanBeneficialOwnerOptions() {
        return array(
            self::KETERLIBATAN_BENEFICIAL_OWNER_YA => 'Ya',
            self::KETERLIBATAN_BENEFICIAL_OWNER_TIDAK => 'Tidak',
        );
    }

    public function getKeterlibatanBeneficialOwnerText($keterlibatanBeneficialOwner = null) {
        $value = ($keterlibatanBeneficialOwner === null) ? $this->keterlibatanBeneficialOwner : $keterlibatanBeneficialOwner;
        $keterlibatanBeneficialOwnerOptions = $this->getKeterlibatanBeneficialOwnerOptions();
        return isset($keterlibatanBeneficialOwnerOptions[$value]) ?
                $keterlibatanBeneficialOwnerOptions[$value] : "unknown keterlibatanBeneficialOwner ({$value})";
    }
    
    public static function getJenisLaporanOptions() {
        return array(
            self::JENIS_LAPORAN_BARU => 'Baru',
            self::JENIS_LAPORAN_KOREKSI => 'Koreksi',
            self::JENIS_LAPORAN_RECALL => 'Recall',
            self::JENIS_LAPORAN_REJECT => 'Reject',
        );
    }

    public function getJenisLaporanText($jenisLaporan = null) {
        $value = ($jenisLaporan === null) ? $this->jenisLaporan : $jenisLaporan;
        $jenisLaporanOptions = $this->getJenisLaporanOptions();
        return isset($jenisLaporanOptions[$value]) ?
                $jenisLaporanOptions[$value] : "unknown jenisLaporan ({$value})";
    }

    public static function getStatusOptions() {
        return array(
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_FINALIZE => 'Finalize',
        );
    }

    public function getStatusText($status = null) {
        $value = ($status === null) ? $this->status : $status;
        $statusOptions = $this->getStatusOptions();
        return isset($statusOptions[$value]) ?
                $statusOptions[$value] : "unknown status ({$value})";
    }

    public static function getJenisSwiftOptions() {
        return array(
            self::TYPE_SWIN => 'Swift Incoming',
            self::TYPE_SWOUT => 'Swift Outgoing',
            self::TYPE_NONSWIN => 'Non Swift Incoming',
            self::TYPE_NONSWOUT => 'Non Swift Outgoing',
        );
    }

    public static function getIdByType($type) {
        $types = array(
            'SwIn' => self::TYPE_SWIN,
            'SwOut' => self::TYPE_SWOUT,
            'NonSwIn' => self::TYPE_NONSWIN,
            'NonSwOut' => self::TYPE_NONSWOUT,
        );

        return $types[$type];
    }

    public static function getTypeById($id) {
        $types = array(
            self::TYPE_SWIN => 'SwIn',
            self::TYPE_SWOUT => 'SwOut',
            self::TYPE_NONSWIN => 'NonSwIn',
            self::TYPE_NONSWOUT => 'NonSwOut',
        );

        return $types[$id];
    }

    public function getJenisSwiftText($jenisSwift = null) {
        $value = ($jenisSwift === null) ? $this->jenisSwift : $jenisSwift;
        $jenisSwiftOptions = $this->getStatusOptions();
        return isset($jenisSwiftOptions[$value]) ?
                $jenisSwiftOptions[$value] : "unknown jenis swift ({$value})";
    }

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
            array('localId, noLtdln, tglLaporan, namaPjk, namaPejabatPjk, jenisLaporan, pjkBankSebagai, jenisSwift, status', 'required'),
            array('jenisLaporan, pjkBankSebagai, jenisSwift, keterlibatanBeneficialOwner', 'numerical', 'integerOnly' => true),
            array('localId', 'length', 'max' => 50),
            array('localId', 'unique'),
            array('noLtdln, noLtdlnKoreksi', 'length', 'max' => 30),
            array('namaPjk, namaPejabatPjk', 'length', 'max' => 100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, localId, noLtdln, status, noLtdlnKoreksi, tglLaporan, namaPjk, namaPejabatPjk, jenisLaporan, pjkBankSebagai, jenisSwift', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'infolains' => array(self::HAS_MANY, 'InfoLain', 'swift_id'),
            'nasabahKorporasiDns' => array(self::HAS_MANY, 'NasabahKorporasiDn', 'swift_id'),
            'nasabahKorporasiLns' => array(self::HAS_MANY, 'NasabahKorporasiLn', 'swift_id'),
            'nasabahPeroranganDns' => array(self::HAS_MANY, 'NasabahPeroranganDn', 'swift_id'),
            'nasabahPeroranganLns' => array(self::HAS_MANY, 'NasabahPeroranganLn', 'swift_id'),
            'nonNasabahDns' => array(self::HAS_MANY, 'NonNasabahDn', 'swift_id'),
            'nonNasabahLns' => array(self::HAS_MANY, 'NonNasabahLn', 'swift_id'),
            'transaksis' => array(self::HAS_ONE, 'Transaksi', 'swift_id'),
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
            'localId' => 'Local Id',
            'noLtdln' => 'No Ltdln',
            'noLtdlnKoreksi' => 'No Ltdln Koreksi',
            'tglLaporan' => 'Tgl Laporan',
            'namaPjk' => 'Nama Pjk',
            'namaPejabatPjk' => 'Nama Pejabat Pjk',
            'jenisLaporan' => 'Jenis Laporan',
            'pjkBankSebagai' => 'Pjk Bank Sebagai',
            'jenisSwift' => 'Jenis Swift',
            'status' => 'Status',
            'keterlibatanBeneficialOwner' => 'Keterlibatan Beneficial Owner',
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
        $criteria->compare('status', $this->status);
        $criteria->compare('keterlibatanBeneficialOwner', $this->keterlibatanBeneficialOwner);        
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}