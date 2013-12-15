<?php


/**
 * This is the model class for table "transaksi".
 *
 * The followings are the available columns in table 'transaksi':
 * @property integer $id
 * @property string $tglTransaksi
 * @property string $timeIndication
 * @property string $sendersReference
 * @property string $relatedReference
 * @property string $bankOperationCode
 * @property string $instructionCode
 * @property string $kanCabPenyelenggaraPengirimAsal
 * @property string $typeTransactionCode
 * @property string $valueDate
 * @property double $amount
 * @property integer $idCurrency
 * @property double $amountDalamRupiah
 * @property integer $idCurrencyInstructedAmount
 * @property double $instructedAmount
 * @property double $exchangeRate
 * @property string $sendingInstitution
 * @property string $beneficiaryInstitution
 * @property string $tujuanTransaksi
 * @property string $sumberDana
 * @property integer $swift_id
 *
 * The followings are the available model relations:
 * @property Swift $swift
 */
class Transaksi extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Transaksi the static model class
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
		return 'transaksi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tglTransaksi, sendersReference, bankOperationCode, valueDate, amount, idCurrency, amountDalamRupiah, swift_id', 'required'),
			array('idCurrency, idCurrencyInstructedAmount, swift_id', 'numerical', 'integerOnly'=>true),
			array('amount, amountDalamRupiah, instructedAmount, exchangeRate', 'numerical'),
			array('sendersReference', 'length', 'max'=>10),
			array('sendersReference', 'length', 'min'=>2),
			array('relatedReference', 'length', 'max'=>20),
			array('bankOperationCode', 'length', 'max'=>30),
			array('instructionCode, kanCabPenyelenggaraPengirimAsal, typeTransactionCode, sendingInstitution', 'length', 'max'=>50),
			array('beneficiaryInstitution', 'length', 'max'=>140),
			array('tujuanTransaksi, sumberDana', 'length', 'max'=>100),
			array('timeIndication', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tglTransaksi, timeIndication, sendersReference, relatedReference, bankOperationCode, instructionCode, kanCabPenyelenggaraPengirimAsal, typeTransactionCode, valueDate, amount, idCurrency, amountDalamRupiah, idCurrencyInstructedAmount, instructedAmount, exchangeRate, sendingInstitution, beneficiaryInstitution, tujuanTransaksi, sumberDana, swift_id', 'safe', 'on'=>'search'),
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
			'swift' => array(self::BELONGS_TO, 'Swift', 'swift_id'),
			'currency' => array(self::BELONGS_TO, 'MataUang', 'idCurrency'),
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
			'tglTransaksi' => 'Tgl Transaksi',
			'timeIndication' => 'Time Indication',
			'sendersReference' => 'Senders Reference',
			'relatedReference' => 'Related Reference',
			'bankOperationCode' => 'Bank Operation Code',
			'instructionCode' => 'Instruction Code',
			'kanCabPenyelenggaraPengirimAsal' => 'Kan Cab Penyelenggara Pengirim Asal',
			'typeTransactionCode' => 'Type Transaction Code',
			'valueDate' => 'Value Date',
			'amount' => 'Amount',
			'idCurrency' => 'Id Currency',
			'amountDalamRupiah' => 'Amount Dalam Rupiah',
			'idCurrencyInstructedAmount' => 'Id Currency Instructed Amount',
			'instructedAmount' => 'Instructed Amount',
			'exchangeRate' => 'Exchange Rate',
			'sendingInstitution' => 'Sending Institution',
			'beneficiaryInstitution' => 'Beneficiary Institution',
			'tujuanTransaksi' => 'Tujuan Transaksi',
			'sumberDana' => 'Sumber Dana',
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
		$criteria->compare('tglTransaksi',$this->tglTransaksi,true);
		$criteria->compare('timeIndication',$this->timeIndication,true);
		$criteria->compare('sendersReference',$this->sendersReference,true);
		$criteria->compare('relatedReference',$this->relatedReference,true);
		$criteria->compare('bankOperationCode',$this->bankOperationCode,true);
		$criteria->compare('instructionCode',$this->instructionCode,true);
		$criteria->compare('kanCabPenyelenggaraPengirimAsal',$this->kanCabPenyelenggaraPengirimAsal,true);
		$criteria->compare('typeTransactionCode',$this->typeTransactionCode,true);
		$criteria->compare('valueDate',$this->valueDate,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('idCurrency',$this->idCurrency);
		$criteria->compare('amountDalamRupiah',$this->amountDalamRupiah);
		$criteria->compare('idCurrencyInstructedAmount',$this->idCurrencyInstructedAmount);
		$criteria->compare('instructedAmount',$this->instructedAmount);
		$criteria->compare('exchangeRate',$this->exchangeRate);
		$criteria->compare('sendingInstitution',$this->sendingInstitution,true);
		$criteria->compare('beneficiaryInstitution',$this->beneficiaryInstitution,true);
		$criteria->compare('tujuanTransaksi',$this->tujuanTransaksi,true);
		$criteria->compare('sumberDana',$this->sumberDana,true);
		$criteria->compare('swift_id',$this->swift_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}