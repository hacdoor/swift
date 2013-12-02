<?php


/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property integer $id
 * @property string $bankId
 * @property string $namaPjk
 * @property string $namaPejabatPjk
 * @property string $trxSource
 * @property string $kycSource
 * @property string $personSource
 */
class Company extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
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
		return 'company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bankId, namaPjk, namaPejabatPjk, trxSource, kycSource, personSource', 'required'),
			array('bankId', 'length', 'max'=>32),
			array('namaPjk, namaPejabatPjk', 'length', 'max'=>100),
			array('trxSource, kycSource, personSource', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, bankId, namaPjk, namaPejabatPjk, trxSource, kycSource, personSource', 'safe', 'on'=>'search'),
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
			'bankId' => 'Bank',
			'namaPjk' => 'Nama Pjk',
			'namaPejabatPjk' => 'Nama Pejabat Pjk',
			'trxSource' => 'Trx Source',
			'kycSource' => 'Kyc Source',
			'personSource' => 'Person Source',
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
		$criteria->compare('bankId',$this->bankId,true);
		$criteria->compare('namaPjk',$this->namaPjk,true);
		$criteria->compare('namaPejabatPjk',$this->namaPejabatPjk,true);
		$criteria->compare('trxSource',$this->trxSource,true);
		$criteria->compare('kycSource',$this->kycSource,true);
		$criteria->compare('personSource',$this->personSource,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}