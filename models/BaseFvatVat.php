<?php

/**
 * This is the model base class for the table "fvat_vat".
 *
 * Columns in table "fvat_vat" available as properties of the model:
 * @property integer $fvat_id
 * @property double $fvat_rate
 * @property string $fvat_label
 * @property integer $fvat_order
 * @property integer $fvat_hide
 *
 * Relations of table "fvat_vat" available as properties of the model:
 * @property FiitInvoiceItem[] $fiitInvoiceItems
 */
abstract class BaseFvatVat extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'fvat_vat';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('fvat_rate, fvat_label, fvat_order, fvat_hide', 'default', 'setOnEmpty' => true, 'value' => null),
                array('fvat_order, fvat_hide', 'numerical', 'integerOnly' => true),
                array('fvat_rate', 'numerical'),
                array('fvat_label', 'length', 'max' => 10),
                array('fvat_id, fvat_rate, fvat_label, fvat_order, fvat_hide', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->fvat_label;
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
                'fiitInvoiceItems' => array(self::HAS_MANY, 'FiitInvoiceItem', 'fiit_fvat_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'fvat_id' => Yii::t('D2finvModule.model', 'Fvat'),
            'fvat_rate' => Yii::t('D2finvModule.model', 'Fvat Rate'),
            'fvat_label' => Yii::t('D2finvModule.model', 'Fvat Label'),
            'fvat_order' => Yii::t('D2finvModule.model', 'Fvat Order'),
            'fvat_hide' => Yii::t('D2finvModule.model', 'Fvat Hide'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.fvat_id', $this->fvat_id);
        $criteria->compare('t.fvat_rate', $this->fvat_rate);
        $criteria->compare('t.fvat_label', $this->fvat_label, true);
        $criteria->compare('t.fvat_order', $this->fvat_order);
        $criteria->compare('t.fvat_hide', $this->fvat_hide);


        return $criteria;

    }

}
