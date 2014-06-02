<?php

// auto-loading
Yii::setPathOfAlias('FinvInvoice', dirname(__FILE__));
Yii::import('FinvInvoice.*');

class FinvInvoice extends BaseFinvInvoice
{

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
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
            parent::rules()
        /* , array(
          array('column1, column2', 'rule1'),
          array('column3', 'rule2'),
          ) */
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
        
        // set system company id
        if ($this->isNewRecord && Yii::app()->sysCompany->getActiveCompany()) {
            $this->finv_sys_ccmp_id   = Yii::app()->sysCompany->getActiveCompany();
            $this->finv_fcrn_id       = Yii::app()->sysCompany->getAttribute('base_fcrn_id');
            $this->finv_basic_fcrn_id = Yii::app()->sysCompany->getAttribute('base_fcrn_id');
            $this->finv_reg_date      = date('Y-m-d H:i:s');
        }
        
        return parent::save($runValidation, $attributes);

    }
    
    /**
     * recalc totals
     */
    public function recalcInvoice($finv_id) {
        $this->unsetAttributes();
        $this->finv_id = $finv_id;
        $this->refresh();
        $this->finv_amt = 0;
        $this->finv_total = 0;
        $this->finv_vat = 0;

        $criteria = new CDbCriteria;
        $criteria->compare('t.fiit_finv_id', $finv_id);
        //$fiit_model = new FiitInvoiceItem();
        //$fiit_model->setAttribute('fiit_finv_id', $finv_id);
        $fiits = FiitInvoiceItem::model()->findAll($criteria);
        foreach ($fiits as $fiit) {
            $fiit->fiit_amt = round($fiit->fiit_price * $fiit->fiit_quantity, 2);
            $fiit->fiit_total = $fiit->fiit_amt;
            $fiit->fiit_vat = 0;
            try {
                if (!$fiit->save()) {
                    $this->addError('fiit_id', 'Can not update fiit item');
                    return FALSE;
                }
            } catch (Exception $e) {
                $this->addError('', $e->getMessage());
                return FALSE;
            }

            $this->finv_amt += $fiit->fiit_amt;
            $this->finv_total += $fiit->fiit_total;
            $this->finv_vat += $fiit->fiit_vat;
        }

        $this->finv_basic_amt = Yii::app()->currency->convertToBase($this->finv_amt, $this->finv_fcrn_id, $this->finv_date);
        $this->finv_basic_total = Yii::app()->currency->convertToBase($this->finv_total, $this->finv_fcrn_id, $this->finv_date);
        $this->finv_basic_vat = Yii::app()->currency->convertToBase($this->finv_vat, $this->finv_fcrn_id, $this->finv_date);
        try {
            if (!$this->save()) {
                $this->addError('finv_id', 'Can not update finv record');
                return FALSE;
            }
        } catch (Exception $e) {
            $this->addError('finv_id', $e->getMessage());
            return FALSE;
        }

        return TRUE;
    }

}
