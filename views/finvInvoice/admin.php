<?php
$this->setPageTitle(
    Yii::t('D2finvModule.model', 'Finv Invoices')
    . ' - '
    . Yii::t('D2finvModule.crud_static', 'Manage')
);

$this->breadcrumbs[] = Yii::t('D2finvModule.model', 'Finv Invoices');

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
             'visible'=>(Yii::app()->user->checkAccess('D2finv.FinvInvoice.*') || Yii::app()->user->checkAccess('D2finv.FinvInvoice.Create'))
        ));  
        ?>
</div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2finvModule.model', 'Finv Invoices');?>            </h1>
        </div>
    </div>
</div>

<?php Yii::beginProfile('FinvInvoice.view.grid'); ?>


<?php
$this->widget('TbGridView',
    array(
        'id' => 'finv-invoice-grid',
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
                'urlExpression' => 'Yii::app()->controller->createUrl("view", array("finv_id" => $data["finv_id"]))'
            ),
            array(
                //smallint(10) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'finv_id',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(10)
                'class' => 'editable.EditableColumn',
                'name' => 'finv_series_number',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(20)
                'class' => 'editable.EditableColumn',
                'name' => 'finv_number',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'finv_sys_ccmp_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    'source' => CHtml::listData(CcmpCompany::model()->findAll(array('limit' => 1000)), 'ccmp_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'finv_ccmp_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    'source' => CHtml::listData(CcmpCompany::model()->findAll(array('limit' => 1000)), 'ccmp_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'finv_reg_date',
                'editable' => array(
                    'type' => 'date',
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'finv_date',
                'editable' => array(
                    'type' => 'date',
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'finv_budget_date',
                'editable' => array(
                    'type' => 'date',
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            /*
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'finv_due_date',
                'editable' => array(
                    'type' => 'date',
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'finv_notes',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'finv_fcrn_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    'source' => CHtml::listData(FcrnCurrency::model()->findAll(array('limit' => 1000)), 'fcrn_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'finv_amt',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'finv_vat',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'finv_total',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'finv_basic_fcrn_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    'source' => CHtml::listData(FcrnCurrency::model()->findAll(array('limit' => 1000)), 'fcrn_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'finv_basic_amt',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'finv_basic_vat',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'finv_basic_total',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'finv_basic_payment_before',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'finv_stst_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    'source' => CHtml::listData(StstState::model()->findAll(array('limit' => 1000)), 'stst_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'finv_paid',
                    'editable' => array(
                        'type' => 'select',
                        'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        'source' => $model->getEnumFieldLabels('finv_paid'),
                        //'placement' => 'right',
                    ),
                   'filter' => $model->getEnumFieldLabels('finv_paid'),
                ),
            array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'finv_ref',
                    'editable' => array(
                        'type' => 'select',
                        'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        'source' => $model->getEnumFieldLabels('finv_ref'),
                        //'placement' => 'right',
                    ),
                   'filter' => $model->getEnumFieldLabels('finv_ref'),
                ),
            array(
                //int(10) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'finv_ref_id',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'finv_type',
                    'editable' => array(
                        'type' => 'select',
                        'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        'source' => $model->getEnumFieldLabels('finv_type'),
                        //'placement' => 'right',
                    ),
                   'filter' => $model->getEnumFieldLabels('finv_type'),
                ),
            */

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2finv.FinvInvoice.View")'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2finv.FinvInvoice.Delete")'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("finv_id" => $data->finv_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("finv_id" => $data->finv_id))',
                'viewButtonOptions'=>array('data-toggle'=>'tooltip'),   
                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),   
            ),
        )
    )
);
?>
<?php Yii::endProfile('FinvInvoice.view.grid'); ?>