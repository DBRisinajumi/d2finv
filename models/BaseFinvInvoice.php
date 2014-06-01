<?php

/**
 * This is the model base class for the table "finv_invoice".
 *
 * Columns in table "finv_invoice" available as properties of the model:
 * @property integer $finv_id
 * @property string $finv_series_number
 * @property string $finv_number
 * @property string $finv_sys_ccmp_id
 * @property string $finv_ccmp_id
 * @property string $finv_reg_date
 * @property string $finv_date
 * @property string $finv_budget_date
 * @property string $finv_due_date
 * @property string $finv_notes
 * @property integer $finv_fcrn_id
 * @property string $finv_amt
 * @property string $finv_vat
 * @property string $finv_total
 * @property integer $finv_basic_fcrn_id
 * @property string $finv_basic_amt
 * @property string $finv_basic_vat
 * @property string $finv_basic_total
 * @property string $finv_basic_payment_before
 * @property integer $finv_stst_id
 * @property string $finv_paid
 * @property string $finv_ref
 * @property string $finv_ref_id
 * @property string $finv_type
 *
 * Relations of table "finv_invoice" available as properties of the model:
 * @property FiitInvoiceItem[] $fiitInvoiceItems
 * @property CcmpCompany $finvSysCcmp
 * @property CcmpCompany $finvCcmp
 * @property FcrnCurrency $finvFcrn
 * @property FcrnCurrency $finvBasicFcrn
 * @property StstState $finvStst
 */
abstract class BaseFinvInvoice extends CActiveRecord
{
    /**
    * ENUM field values
    */
    const FINV_PAID_IS_PAID = 'is paid';
    const FINV_PAID_NOT_PAID = 'not paid';
    const FINV_PAID_PARTLY_PAID = 'partly paid';
    const FINV_REF_BPRD = 'BPRD';
    const FINV_TYPE_IN = 'in';
    const FINV_TYPE_OUT = 'out';

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'finv_invoice';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('finv_number, finv_sys_ccmp_id, finv_ccmp_id, finv_reg_date, finv_fcrn_id, finv_basic_fcrn_id', 'required'),
                array('finv_series_number, finv_date, finv_budget_date, finv_due_date, finv_notes, finv_amt, finv_vat, finv_total, finv_basic_amt, finv_basic_vat, finv_basic_total, finv_basic_payment_before, finv_stst_id, finv_paid, finv_ref, finv_ref_id, finv_type', 'default', 'setOnEmpty' => true, 'value' => null),
                array('finv_fcrn_id, finv_basic_fcrn_id, finv_stst_id', 'numerical', 'integerOnly' => true),
                array('finv_series_number, finv_sys_ccmp_id, finv_ccmp_id, finv_amt, finv_vat, finv_total, finv_basic_amt, finv_basic_vat, finv_basic_total, finv_basic_payment_before, finv_ref_id', 'length', 'max' => 10),
                array('finv_number', 'length', 'max' => 20),
                array('finv_paid', 'length', 'max' => 11),
                array('finv_ref', 'length', 'max' => 4),
                array('finv_type', 'length', 'max' => 3),
                array('finv_date, finv_budget_date, finv_due_date, finv_notes', 'safe'),
                array('finv_id, finv_series_number, finv_number, finv_sys_ccmp_id, finv_ccmp_id, finv_reg_date, finv_date, finv_budget_date, finv_due_date, finv_notes, finv_fcrn_id, finv_amt, finv_vat, finv_total, finv_basic_fcrn_id, finv_basic_amt, finv_basic_vat, finv_basic_total, finv_basic_payment_before, finv_stst_id, finv_paid, finv_ref, finv_ref_id, finv_type', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->finv_series_number;
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(), array(
                'savedRelated' => array(
                    'class' => '\GtcSaveRelationsBehavior'
                )
            )
        );
    }

    public function relations()
    {
        return array_merge(
            parent::relations(), array(
                'fiitInvoiceItems' => array(self::HAS_MANY, 'FiitInvoiceItem', 'fiit_finv_id'),
                'finvSysCcmp' => array(self::BELONGS_TO, 'CcmpCompany', 'finv_sys_ccmp_id'),
                'finvCcmp' => array(self::BELONGS_TO, 'CcmpCompany', 'finv_ccmp_id'),
                'finvFcrn' => array(self::BELONGS_TO, 'FcrnCurrency', 'finv_fcrn_id'),
                'finvBasicFcrn' => array(self::BELONGS_TO, 'FcrnCurrency', 'finv_basic_fcrn_id'),
                'finvStst' => array(self::BELONGS_TO, 'StstState', 'finv_stst_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'finv_id' => Yii::t('D2finvModule.model', 'Finv'),
            'finv_series_number' => Yii::t('D2finvModule.model', 'Finv Series Number'),
            'finv_number' => Yii::t('D2finvModule.model', 'Finv Number'),
            'finv_sys_ccmp_id' => Yii::t('D2finvModule.model', 'Finv Sys Ccmp'),
            'finv_ccmp_id' => Yii::t('D2finvModule.model', 'Finv Ccmp'),
            'finv_reg_date' => Yii::t('D2finvModule.model', 'Finv Reg Date'),
            'finv_date' => Yii::t('D2finvModule.model', 'Finv Date'),
            'finv_budget_date' => Yii::t('D2finvModule.model', 'Finv Budget Date'),
            'finv_due_date' => Yii::t('D2finvModule.model', 'Finv Due Date'),
            'finv_notes' => Yii::t('D2finvModule.model', 'Finv Notes'),
            'finv_fcrn_id' => Yii::t('D2finvModule.model', 'Finv Fcrn'),
            'finv_amt' => Yii::t('D2finvModule.model', 'Finv Amt'),
            'finv_vat' => Yii::t('D2finvModule.model', 'Finv Vat'),
            'finv_total' => Yii::t('D2finvModule.model', 'Finv Total'),
            'finv_basic_fcrn_id' => Yii::t('D2finvModule.model', 'Finv Basic Fcrn'),
            'finv_basic_amt' => Yii::t('D2finvModule.model', 'Finv Basic Amt'),
            'finv_basic_vat' => Yii::t('D2finvModule.model', 'Finv Basic Vat'),
            'finv_basic_total' => Yii::t('D2finvModule.model', 'Finv Basic Total'),
            'finv_basic_payment_before' => Yii::t('D2finvModule.model', 'Finv Basic Payment Before'),
            'finv_stst_id' => Yii::t('D2finvModule.model', 'Finv Stst'),
            'finv_paid' => Yii::t('D2finvModule.model', 'Finv Paid'),
            'finv_ref' => Yii::t('D2finvModule.model', 'Finv Ref'),
            'finv_ref_id' => Yii::t('D2finvModule.model', 'Finv Ref'),
            'finv_type' => Yii::t('D2finvModule.model', 'Finv Type'),
        );
    }

    public function enumLabels()
    {
        return array(
           'finv_paid' => array(
               self::FINV_PAID_IS_PAID => Yii::t('D2finvModule.model', 'FINV_PAID_IS_PAID'),
               self::FINV_PAID_NOT_PAID => Yii::t('D2finvModule.model', 'FINV_PAID_NOT_PAID'),
               self::FINV_PAID_PARTLY_PAID => Yii::t('D2finvModule.model', 'FINV_PAID_PARTLY_PAID'),
           ),
           'finv_ref' => array(
               self::FINV_REF_BPRD => Yii::t('D2finvModule.model', 'FINV_REF_BPRD'),
           ),
           'finv_type' => array(
               self::FINV_TYPE_IN => Yii::t('D2finvModule.model', 'FINV_TYPE_IN'),
               self::FINV_TYPE_OUT => Yii::t('D2finvModule.model', 'FINV_TYPE_OUT'),
           ),
            );
    }

    public function getEnumFieldLabels($column){

        $aLabels = $this->enumLabels();
        return $aLabels[$column];
    }

    public function getEnumLabel($column,$value){

        $aLabels = $this->enumLabels();

        if(!isset($aLabels[$column])){
            return $value;
        }

        if(!isset($aLabels[$column][$value])){
            return $value;
        }

        return $aLabels[$column][$value];
    }


    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.finv_id', $this->finv_id);
        $criteria->compare('t.finv_series_number', $this->finv_series_number, true);
        $criteria->compare('t.finv_number', $this->finv_number, true);
        $criteria->compare('t.finv_sys_ccmp_id', $this->finv_sys_ccmp_id);
        $criteria->compare('t.finv_ccmp_id', $this->finv_ccmp_id);
        $criteria->compare('t.finv_reg_date', $this->finv_reg_date, true);
        $criteria->compare('t.finv_date', $this->finv_date, true);
        $criteria->compare('t.finv_budget_date', $this->finv_budget_date, true);
        $criteria->compare('t.finv_due_date', $this->finv_due_date, true);
        $criteria->compare('t.finv_notes', $this->finv_notes, true);
        $criteria->compare('t.finv_fcrn_id', $this->finv_fcrn_id);
        $criteria->compare('t.finv_amt', $this->finv_amt, true);
        $criteria->compare('t.finv_vat', $this->finv_vat, true);
        $criteria->compare('t.finv_total', $this->finv_total, true);
        $criteria->compare('t.finv_basic_fcrn_id', $this->finv_basic_fcrn_id);
        $criteria->compare('t.finv_basic_amt', $this->finv_basic_amt, true);
        $criteria->compare('t.finv_basic_vat', $this->finv_basic_vat, true);
        $criteria->compare('t.finv_basic_total', $this->finv_basic_total, true);
        $criteria->compare('t.finv_basic_payment_before', $this->finv_basic_payment_before, true);
        $criteria->compare('t.finv_stst_id', $this->finv_stst_id);
        $criteria->compare('t.finv_paid', $this->finv_paid, true);
        $criteria->compare('t.finv_ref', $this->finv_ref, true);
        $criteria->compare('t.finv_ref_id', $this->finv_ref_id, true);
        $criteria->compare('t.finv_type', $this->finv_type, true);


        return $criteria;

    }

}
