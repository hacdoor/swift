<?php


/**
 * This is the model class for table "infolain".
 *
 * The followings are the available columns in table 'infolain':
 * @property integer $id
 * @property string $infSendersCorrespondent
 * @property string $infReceiverCorrespondent
 * @property string $infThirdReimbursementInstitution
 * @property string $infIntermediaryInstitution
 * @property string $infBeneficiaryCustomerAccountInstitution
 * @property string $remittanceInformation
 * @property string $senderToReceiverInformation
 * @property string $regulatoryReporting
 * @property string $envelopeContents
 * @property integer $swift_id
 *
 * The followings are the available model relations:
 * @property Swift $swift
 */
class Infolain extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Infolain the static model class
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
		return 'info_lain';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('swift_id', 'required'),
			array('swift_id', 'numerical', 'integerOnly'=>true),
			array('infSendersCorrespondent, infReceiverCorrespondent, infThirdReimbursementInstitution, infIntermediaryInstitution, infBeneficiaryCustomerAccountInstitution, remittanceInformation', 'length', 'max'=>140),
			array('senderToReceiverInformation', 'length', 'max'=>210),
			array('regulatoryReporting', 'length', 'max'=>105),
			array('envelopeContents', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, infSendersCorrespondent, infReceiverCorrespondent, infThirdReimbursementInstitution, infIntermediaryInstitution, infBeneficiaryCustomerAccountInstitution, remittanceInformation, senderToReceiverInformation, regulatoryReporting, envelopeContents, swift_id', 'safe', 'on'=>'search'),
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
			'infSendersCorrespondent' => 'Inf Senders Correspondent',
			'infReceiverCorrespondent' => 'Inf Receiver Correspondent',
			'infThirdReimbursementInstitution' => 'Inf Third Reimbursement Institution',
			'infIntermediaryInstitution' => 'Inf Intermediary Institution',
			'infBeneficiaryCustomerAccountInstitution' => 'Inf Beneficiary Customer Account Institution',
			'remittanceInformation' => 'Remittance Information',
			'senderToReceiverInformation' => 'Sender To Receiver Information',
			'regulatoryReporting' => 'Regulatory Reporting',
			'envelopeContents' => 'Envelope Contents',
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
		$criteria->compare('infSendersCorrespondent',$this->infSendersCorrespondent,true);
		$criteria->compare('infReceiverCorrespondent',$this->infReceiverCorrespondent,true);
		$criteria->compare('infThirdReimbursementInstitution',$this->infThirdReimbursementInstitution,true);
		$criteria->compare('infIntermediaryInstitution',$this->infIntermediaryInstitution,true);
		$criteria->compare('infBeneficiaryCustomerAccountInstitution',$this->infBeneficiaryCustomerAccountInstitution,true);
		$criteria->compare('remittanceInformation',$this->remittanceInformation,true);
		$criteria->compare('senderToReceiverInformation',$this->senderToReceiverInformation,true);
		$criteria->compare('regulatoryReporting',$this->regulatoryReporting,true);
		$criteria->compare('envelopeContents',$this->envelopeContents,true);
		$criteria->compare('swift_id',$this->swift_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}