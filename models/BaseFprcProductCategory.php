<?php

/**
 * This is the model base class for the table "fprc_product_category".
 *
 * Columns in table "fprc_product_category" available as properties of the model:
 * @property integer $fprc_id
 * @property string $fprc_code
 * @property string $fprc_name
 *
 * Relations of table "fprc_product_category" available as properties of the model:
 * @property FiitInvoiceItem[] $fiitInvoiceItems
 */
abstract class BaseFprcProductCategory extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'fprc_product_category';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('fprc_code, fprc_name', 'required'),
                array('fprc_code', 'length', 'max' => 10),
                array('fprc_name', 'length', 'max' => 100),
                array('fprc_id, fprc_code, fprc_name', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->fprc_code;
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
                'fiitInvoiceItems' => array(self::HAS_MANY, 'FiitInvoiceItem', 'fiit_fprc_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'fprc_id' => Yii::t('D2finvModule.model', 'Fprc'),
            'fprc_code' => Yii::t('D2finvModule.model', 'Fprc Code'),
            'fprc_name' => Yii::t('D2finvModule.model', 'Fprc Name'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.fprc_id', $this->fprc_id);
        $criteria->compare('t.fprc_code', $this->fprc_code, true);
        $criteria->compare('t.fprc_name', $this->fprc_name, true);


        return $criteria;

    }

}
