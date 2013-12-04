<?php

class NonSwiftForm extends Swift {


    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('localId, noLtdln, tglLaporan, namaPjk, namaPejabatPjk, jenisLaporan, jenisSwift, status', 'required'),
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


}