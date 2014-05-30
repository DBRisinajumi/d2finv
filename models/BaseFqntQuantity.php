<?php

/**
 * This is the model base class for the table "fqnt_quantity".
 *
 * Columns in table "fqnt_quantity" available as properties of the model:
 * @property integer $fqnt_id
 * @property string $fqnt_code
 * @property string $fqnt_name
 *
 * Relations of table "fqnt_quantity" available as properties of the model:
 * @property FiitInvoiceItem[] $fiitInvoiceItems
 */
abstract class BaseFqntQuantity extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'fqnt_quantity';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('fqnt_name', 'required'),
                array('fqnt_code', 'default', 'setOnEmpty' => true, 'value' => null),
                array('fqnt_code', 'length', 'max' => 10),
                array('fqnt_name', 'length', 'max' => 50),
                array('fqnt_id, fqnt_code, fqnt_name', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->fqnt_code;
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
                'fiitInvoiceItems' => array(self::HAS_MANY, 'FiitInvoiceItem', 'fiit_fqnt_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'fqnt_id' => Yii::t('FqntQuantity.model', 'Fqnt'),
            'fqnt_code' => Yii::t('FqntQuantity.model', 'Fqnt Code'),
            'fqnt_name' => Yii::t('FqntQuantity.model', 'Fqnt Name'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.fqnt_id', $this->fqnt_id);
        $criteria->compare('t.fqnt_code', $this->fqnt_code, true);
        $criteria->compare('t.fqnt_name', $this->fqnt_name, true);


        return $criteria;

    }

}
