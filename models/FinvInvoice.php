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

}
