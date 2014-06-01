<?php
if(!$ajax){
    Yii::app()->clientScript->registerCss('rel_grid',' 
            .rel-grid-view {padding-top:0px;margin-top: -35px;}
            h3.rel_grid{padding-left: 40px;}
            ');     
}
?>
<?php
if(!$ajax || $ajax == 'fiit-invoice-item-grid'){
    Yii::beginProfile('fiit_finv_id.view.grid');
?>

<h3 class="rel_grid">    
    <?=Yii::t('D2finvModule.model', 'Fiit Invoice Item')?>
    <?php    
        
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'ajaxButton', 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2finv/fiitInvoiceItem/ajaxCreate',
                'field' => 'fiit_finv_id',
                'value' => $modelMain->primaryKey,
                'ajax' => 'fiit-invoice-item-grid',
            ),
            'ajaxOptions' => array(
                    'success' => 'function(html) {$.fn.yiiGridView.update(\'fiit-invoice-item-grid\');}'
                    ),
            'htmlOptions' => array(
                'title' => Yii::t('D2finvModule.crud_static', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</h3> 
 
<?php 

    if (empty($modelMain->fiitInvoiceItems)) {
        $model = new FiitInvoiceItem;
        $model->fiit_finv_id = $modelMain->primaryKey;
        $model->save();
        unset($model);
    } 
    
    $model = new FiitInvoiceItem();
    $model->fiit_finv_id = $modelMain->primaryKey;

    // render grid view

    $this->widget('TbGridView',
        array(
            'id' => 'fiit-invoice-item-grid',
            'dataProvider' => $model->search(),
            'template' => '{summary}{items}',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
            ),            
            'columns' => array(
                array(
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_desc',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('//d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //char(20)
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_debet_facn_code',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //char(20)
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_credit_facn_code',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_fprc_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2finv/fiitInvoiceItem/editableSaver'),
                    'source' => CHtml::listData(FprcProductCategory::model()->findAll(array('limit' => 1000)), 'fprc_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                //double
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_quantity',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_fqnt_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2finv/fiitInvoiceItem/editableSaver'),
                    'source' => CHtml::listData(FqntQuantity::model()->findAll(array('limit' => 1000)), 'fqnt_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,4)
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_price',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_amt',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            /*
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_vat',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_total',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_fvat_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2finv/fiitInvoiceItem/editableSaver'),
                    'source' => CHtml::listData(FvatVat::model()->findAll(array('limit' => 1000)), 'fvat_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            */

                array(
                    'class' => 'TbButtonColumn',
                    'buttons' => array(
                        'view' => array('visible' => 'FALSE'),
                        'update' => array('visible' => 'FALSE'),
                        'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2finv.FinvInvoice.DeletefiitInvoiceItems")'),
                    ),
                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2finv/fiitInvoiceItem/delete", array("fiit_id" => $data->fiit_id))',
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
                ),
            )
        )
    );
    ?>

<?php
    Yii::endProfile('FiitInvoiceItem.view.grid');
}    
?>
