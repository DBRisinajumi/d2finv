<?php

// auto-loading
Yii::setPathOfAlias('FiitInvoiceItem', dirname(__FILE__));
Yii::import('FiitInvoiceItem.*');

class FiitInvoiceItem extends BaseFiitInvoiceItem
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
        return (string) $this->fiit_desc;
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
        
        parent::save($runValidation = true, $attributes = NULL);
        
        // Recalc invoice
        $finv = FinvInvoice::model()->findByPk($this->fiit_finv_id);
        $finv->save();
        
        return true;
        
    }
    
    public function saveWithoutRecalc()
    {
        return parent::save();
    }

    public function afterSave() {
        
        
        
        parent::afterSave();
    }
    
}
