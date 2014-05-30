<?php
$this->setPageTitle(
    Yii::t('D2finvModule.model', 'Fiit Invoice Items')
    . ' - '
    . Yii::t('D2finvModule.crud_static', 'Manage')
);

$this->breadcrumbs[] = Yii::t('D2finvModule.model', 'Fiit Invoice Items');

?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
        <?php 
        $this->widget('bootstrap.widgets.TbButton', array(
             'label'=>Yii::t('D2finvModule.crud_static','Create'),
             'icon'=>'icon-plus',
             'size'=>'large',
             'type'=>'success',
             'url'=>array('create'),
             'visible'=>(Yii::app()->user->checkAccess('D2finv.FiitInvoiceItem.*') || Yii::app()->user->checkAccess('D2finv.FiitInvoiceItem.Create'))
        ));  
        ?>
</div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2finvModule.model', 'Fiit Invoice Items');?>            </h1>
        </div>
    </div>
</div>

<?php Yii::beginProfile('FiitInvoiceItem.view.grid'); ?>


<?php
$this->widget('TbGridView',
    array(
        'id' => 'fiit-invoice-item-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        #'responsiveTable' => true,
        'template' => '{summary}{pager}{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                'class' => 'CLinkColumn',
                'header' => '',
                'labelExpression' => '$data->itemLabel',
                'urlExpression' => 'Yii::app()->controller->createUrl("view", array("fiit_id" => $data["fiit_id"]))'
            ),
            array(
                //int(10) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_id',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_finv_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                    'source' => CHtml::listData(FinvInvoice::model()->findAll(array('limit' => 1000)), 'finv_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_desc',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //char(20)
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_debet_facn_code',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //char(20)
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_credit_facn_code',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_fprc_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                    'source' => CHtml::listData(FprcProductCategory::model()->findAll(array('limit' => 1000)), 'fprc_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                //double
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_quantity',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_fqnt_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                    'source' => CHtml::listData(FqntQuantity::model()->findAll(array('limit' => 1000)), 'fqnt_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            /*
            array(
                //decimal(10,4)
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_price',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_amt',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_vat',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_total',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'fiit_fvat_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                    'source' => CHtml::listData(FvatVat::model()->findAll(array('limit' => 1000)), 'fvat_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            */

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2finv.FiitInvoiceItem.View")'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2finv.FiitInvoiceItem.Delete")'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("fiit_id" => $data->fiit_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("fiit_id" => $data->fiit_id))',
                'viewButtonOptions'=>array('data-toggle'=>'tooltip'),   
                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),   
            ),
        )
    )
);
?>
<?php Yii::endProfile('FiitInvoiceItem.view.grid'); ?>