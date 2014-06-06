<?php

/**
 * This is the model base class for the table "fixr_fiit_x_ref".
 *
 * Columns in table "fixr_fiit_x_ref" available as properties of the model:
 * @property string $fixr_id
 * @property string $fixr_fiit_id
 * @property integer $fixr_fret_id
 * @property string $fixr_ref_id
 * @property string $fuxr_fcrn_date
 * @property integer $fuxr_fcrn_id
 * @property string $fuxr_amt
 * @property integer $fuxr_base_fcrn_id
 * @property string $fixr_base_amt
 * @property string $fixr_start_date
 * @property integer $fixr_months
 * @property string $fixr_end_date
 * @property string $fixr_start_abs_odo
 * @property string $fixr_km
 * @property string $fixr_end_abs_odo
 *
 * Relations of table "fixr_fiit_x_ref" available as properties of the model:
 * @property FiitInvoiceItem $fixrFiit
 * @property FretRefType $fixrFret
 * @property FcrnCurrency $fuxrFcrn
 * @property FcrnCurrency $fuxrBaseFcrn
 */
abstract class BaseFixrFiitXRef extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'fixr_fiit_x_ref';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('fixr_fiit_id, fuxr_fcrn_date, fuxr_fcrn_id, fuxr_base_fcrn_id', 'required'),
                array('fixr_fret_id, fixr_ref_id, fuxr_amt, fixr_base_amt, fixr_start_date, fixr_months, fixr_end_date, fixr_start_abs_odo, fixr_km, fixr_end_abs_odo', 'default', 'setOnEmpty' => true, 'value' => null),
                array('fixr_fret_id, fuxr_fcrn_id, fuxr_base_fcrn_id, fixr_months', 'numerical', 'integerOnly' => true),
                array('fixr_fiit_id, fixr_ref_id, fuxr_amt, fixr_base_amt, fixr_start_abs_odo, fixr_km, fixr_end_abs_odo', 'length', 'max' => 10),
                array('fixr_start_date, fixr_end_date', 'safe'),
                array('fixr_id, fixr_fiit_id, fixr_fret_id, fixr_ref_id, fuxr_fcrn_date, fuxr_fcrn_id, fuxr_amt, fuxr_base_fcrn_id, fixr_base_amt, fixr_start_date, fixr_months, fixr_end_date, fixr_start_abs_odo, fixr_km, fixr_end_abs_odo', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->fixr_fiit_id;
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
                'fixrFiit' => array(self::BELONGS_TO, 'FiitInvoiceItem', 'fixr_fiit_id'),
                'fixrFret' => array(self::BELONGS_TO, 'FretRefType', 'fixr_fret_id'),
                'fuxrFcrn' => array(self::BELONGS_TO, 'FcrnCurrency', 'fuxr_fcrn_id'),
                'fuxrBaseFcrn' => array(self::BELONGS_TO, 'FcrnCurrency', 'fuxr_base_fcrn_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'fixr_id' => Yii::t('D2finvModule.model', 'Fixr'),
            'fixr_fiit_id' => Yii::t('D2finvModule.model', 'Fixr Fiit'),
            'fixr_fret_id' => Yii::t('D2finvModule.model', 'Fixr Fret'),
            'fixr_ref_id' => Yii::t('D2finvModule.model', 'Fixr Ref'),
            'fuxr_fcrn_date' => Yii::t('D2finvModule.model', 'Fuxr Fcrn Date'),
            'fuxr_fcrn_id' => Yii::t('D2finvModule.model', 'Fuxr Fcrn'),
            'fuxr_amt' => Yii::t('D2finvModule.model', 'Fuxr Amt'),
            'fuxr_base_fcrn_id' => Yii::t('D2finvModule.model', 'Fuxr Base Fcrn'),
            'fixr_base_amt' => Yii::t('D2finvModule.model', 'Fixr Base Amt'),
            'fixr_start_date' => Yii::t('D2finvModule.model', 'Fixr Start Date'),
            'fixr_months' => Yii::t('D2finvModule.model', 'Fixr Months'),
            'fixr_end_date' => Yii::t('D2finvModule.model', 'Fixr End Date'),
            'fixr_start_abs_odo' => Yii::t('D2finvModule.model', 'Fixr Start Abs Odo'),
            'fixr_km' => Yii::t('D2finvModule.model', 'Fixr Km'),
            'fixr_end_abs_odo' => Yii::t('D2finvModule.model', 'Fixr End Abs Odo'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.fixr_id', $this->fixr_id, true);
        $criteria->compare('t.fixr_fiit_id', $this->fixr_fiit_id);
        $criteria->compare('t.fixr_fret_id', $this->fixr_fret_id);
        $criteria->compare('t.fixr_ref_id', $this->fixr_ref_id, true);
        $criteria->compare('t.fuxr_fcrn_date', $this->fuxr_fcrn_date, true);
        $criteria->compare('t.fuxr_fcrn_id', $this->fuxr_fcrn_id);
        $criteria->compare('t.fuxr_amt', $this->fuxr_amt, true);
        $criteria->compare('t.fuxr_base_fcrn_id', $this->fuxr_base_fcrn_id);
        $criteria->compare('t.fixr_base_amt', $this->fixr_base_amt, true);
        $criteria->compare('t.fixr_start_date', $this->fixr_start_date, true);
        $criteria->compare('t.fixr_months', $this->fixr_months);
        $criteria->compare('t.fixr_end_date', $this->fixr_end_date, true);
        $criteria->compare('t.fixr_start_abs_odo', $this->fixr_start_abs_odo, true);
        $criteria->compare('t.fixr_km', $this->fixr_km, true);
        $criteria->compare('t.fixr_end_abs_odo', $this->fixr_end_abs_odo, true);


        return $criteria;

    }

}
