<?php

// auto-loading
Yii::setPathOfAlias('FinvInvoice', dirname(__FILE__));
Yii::import('FinvInvoice.*');

class FinvInvoice extends BaseFinvInvoice
{
    
    public $finv_date_range;

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
        // Default values
        $this->finv_fcrn_id     = Yii::app()->sysCompany->getAttribute('base_fcrn_id');
        $this->finv_date        = date('Y-m-d');
        $this->finv_budget_date = date('Y-m-d');
        
        return parent::init();
    }

    public function getItemLabel()
    {
        return parent::getItemLabel();
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array()
        );
    }

    public function rules()
    {
        return array_merge(
            parent::rules(),
            array(
                array('finv_sys_ccmp_id, finv_basic_fcrn_id', 'required', 'message'=>Yii::t('D2finvModule.model', 'System configuration error \'{attribute}\' is not set.')),
                array('finv_sys_ccmp_id', 'default', 'value'=>Yii::app()->sysCompany->getActiveCompany()),
                array('finv_basic_fcrn_id', 'default', 'value'=>Yii::app()->sysCompany->getAttribute('base_fcrn_id')),
                array('finv_reg_date', 'default', 'value'=>date('Y-m-d')),
            )
        );
    }

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $this->searchCriteria($criteria),
        ));
    }
    
    public function save($runValidation = true, $attributes = NULL) 
    {
        
        if ($this->isNewRecord) {
            parent::save($runValidation, $attributes);
        }
        
        $finv_id = $this->finv_id;
        
        //$this->unsetAttributes();
        //$this->refresh();
        $this->finv_amt   = 0;
        $this->finv_total = 0;
        $this->finv_vat   = 0;

        $criteria = new CDbCriteria;
        $criteria->compare('t.fiit_finv_id', $finv_id);
        $fiits = FiitInvoiceItem::model()->findAll($criteria);
        
        foreach ($fiits as $fiit) {
            
            $fvat = FvatVat::model()->findByPk($fiit->fiit_fvat_id);
            
            $fiit->fiit_amt = round($fiit->fiit_price * $fiit->fiit_quantity, 2);
            $fiit->fiit_vat = round($fiit->fiit_amt * $fvat->fvat_rate / 100, 2);
            // varbūt šādi? atšķiras apaļošana
            //$fiit->fiit_total = round($fiit->fiit_amt * (1 + $fvat->fvat_rate), 2);
            $fiit->fiit_total = $fiit->fiit_amt + $fiit->fiit_vat;
            
            try {
                // don't use $fiit->save() there it will run infinite loop
                if (!$fiit->saveWithoutRecalc()) {
                    $this->addError('fiit_id', Yii::t('D2finvModule.model', 'Can not update invoice item!'));
                    return FALSE;
                }
            } catch (Exception $e) {
                $this->addError('', $e->getMessage());
                return FALSE;
            }

            $this->finv_amt   += $fiit->fiit_amt;
            $this->finv_total += $fiit->fiit_total;
            $this->finv_vat   += $fiit->fiit_vat;
        }

        $this->finv_basic_amt   = Yii::app()->currency->convertToBase($this->finv_amt,   $this->finv_fcrn_id, $this->finv_date);
        $this->finv_basic_total = Yii::app()->currency->convertToBase($this->finv_total, $this->finv_fcrn_id, $this->finv_date);
        $this->finv_basic_vat   = Yii::app()->currency->convertToBase($this->finv_vat,   $this->finv_fcrn_id, $this->finv_date);
        
        try {
            if (!parent::save()) {
                $this->addError('finv_id', Yii::t('D2finvModule.model', 'Can not update invoice!'));
                return FALSE;
            }
        } catch (Exception $e) {
            $this->addError('finv_id', $e->getMessage());
            return FALSE;
        }
        
        return TRUE;

    }
    
    public function duplicate($finv_id)
    {
        $sourceFinv = self::model()->findByPk($finv_id);
        
        if ($sourceFinv === null) {
            return false;
        }
        
        $this->attributes    = $sourceFinv->attributes;
        $this->finv_reg_date = date('Y-m-d');
        
        $this->save();
        
        $criteria = new CDbCriteria;
        $criteria->compare('t.fiit_finv_id', $finv_id);
        $sourceFiits = FiitInvoiceItem::model()->findAll($criteria);
        
        foreach ($sourceFiits as $sourceFiit) {
            $fiit = new FiitInvoiceItem;
            $fiit->attributes   = $sourceFiit->attributes;
            $fiit->fiit_finv_id = $this->finv_id;
            
            try {
                if (!$fiit->saveWithoutRecalc()) {
                    $this->addError('fiit_id', Yii::t('D2finvModule.model', 'Can not copy invoice item!'));
                    return FALSE;
                }
            } catch (Exception $e) {
                $this->addError('', $e->getMessage());
                return FALSE;
            }
        }
        
        // save and recalc
        return $this->save();
        
    }
    
    public function getTotals($column)
    {
        
        $records = $this->search()->getData();
        $total   = 0;
        
        foreach ($records as $record) {
            $total += $record->$column;
        }
        
        return number_format($total, 2, '.', '');
        
    }
    
    protected function beforeFind()
    {
        parent::beforeFind();
        $criteria = new CDbCriteria;
        $criteria->compare('t.finv_sys_ccmp_id', Yii::app()->sysCompany->getActiveCompany());
        
        /**
         * filter date to from
         */
        if (!empty($this->finv_date_range)) {
            $criteria->AddCondition("t.finv_date >= '".substr($this->finv_date_range,0,10)."'");
            $criteria->AddCondition("t.finv_date <= '".substr($this->finv_date_range,-10)."'");
        }
        
        $this->dbCriteria->mergeWith($criteria);   
    }
    
    protected function beforeDelete()
    {
        
        $criteria = new CDbCriteria;
        $criteria->compare('t.fiit_finv_id', $this->finv_id);
        $fiits = FiitInvoiceItem::model()->findAll($criteria);
        
        foreach ($fiits as $fiit) {
            $fiit->delete();
        }
        
        return parent::beforeDelete();
        
    }

}
