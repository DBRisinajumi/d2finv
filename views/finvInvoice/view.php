<?php
    $this->setPageTitle(
        Yii::t('D2finvModule.model', 'Finv Invoice')
        . ' - '
        . Yii::t('D2finvModule.crud_static', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
//$this->breadcrumbs[Yii::t('D2finvModule.model','Finv Invoices')] = array('admin');
//$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
//$this->breadcrumbs[] = Yii::t('D2finvModule.crud_static', 'View');
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    #"label"=>Yii::t("D2finvModule.crud_static","Cancel"),
    "icon"=>"chevron-left",
    "size"=>"large",
    "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
    "visible"=>(Yii::app()->user->checkAccess("D2finv.FinvInvoice.*") || Yii::app()->user->checkAccess("D2finv.FinvInvoice.View")),
    "htmlOptions"=>array(
                    "class"=>"search-button",
                    "data-toggle"=>"tooltip",
                    "title"=>Yii::t("D2finvModule.crud_static","Back"),
                )
 ),true);
    
?>
<?php //$this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group"><?php echo $cancel_buton;?></div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2finvModule.model','Finv Invoice');?>                <small><?php echo$model->itemLabel?></small>
            </h1>
        </div>
        <div class="btn-group">
            <?php
                    
            $this->widget("bootstrap.widgets.TbButton", array(
                "label"=>Yii::t("D2finvModule.crud_static","Copy"),
                "type"=>"success",
                "icon"=>"icon-copy",
                "size"=>"large",
                'url'=> Yii::app()->controller->createUrl("copy", array("finv_id" => $model->finv_id)),
                "visible"=> $model->finv_id && Yii::app()->user->checkAccess("InvoiceEdit")
            ));
            
            $this->widget("bootstrap.widgets.TbButton", array(
                "label"=>Yii::t("D2finvModule.crud_static","Delete"),
                "type"=>"danger",
                "icon"=>"icon-trash icon-white",
                "size"=>"large",
                "htmlOptions"=> array(
                    "submit"=>array("delete","finv_id"=>$model->finv_id, "returnUrl"=>(Yii::app()->request->getParam("returnUrl"))?Yii::app()->request->getParam("returnUrl"):$this->createUrl("admin")),
                    "confirm"=>Yii::t("D2finvModule.crud_static","Do you want to delete this item?")
                ),
                "visible"=> $model->finv_id && Yii::app()->user->checkAccess("InvoiceEdit")
            ));
            
            ?>
        </div>
    </div>
</div>



<div class="row">
    <div class="span5">
        <!--<h2>
            <?php //echo Yii::t('D2finvModule.crud_static','Data')?>            <small>
                #<?php //echo $model->finv_id ?>            </small>
        </h2>-->

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                
                /*array(
                    'name' => 'finv_id',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'finv_id',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        ),
                        true
                    )
                ),*/

                array(
                    'name' => 'finv_series_number',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'finv_series_number',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'finv_number',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'finv_number',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        ),
                        true
                    )
                ),

                /*array(
                    'name' => 'finv_sys_ccmp_id',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                            'source' => CHtml::listData(CcmpCompany::model()->findAll(array('limit' => 1000)), 'ccmp_id', 'itemLabel'),                        
                            'attribute' => 'finv_sys_ccmp_id',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),*/

                array(
                    'name' => 'finv_ccmp_id',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                            'source' => CHtml::listData(CcmpCompany::model()->findAll(array('limit' => 1000)), 'ccmp_id', 'itemLabel'),                        
                            'attribute' => 'finv_ccmp_id',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),

                /*array(
                    'name' => 'finv_reg_date',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'date',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                            'attribute' => 'finv_reg_date',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),*/
                
                array(
                    'name' => 'finv_date',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'date',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                            'attribute' => 'finv_date',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),

                array(
                    'name' => 'finv_budget_date',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'date',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                            'attribute' => 'finv_budget_date',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),

                array(
                    'name' => 'finv_due_date',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'date',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                            'attribute' => 'finv_due_date',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),

                array(
                    'name' => 'finv_notes',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'finv_notes',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'finv_fcrn_id',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                            'source' => CHtml::listData(FcrnCurrency::model()->findAll(array('limit' => 1000)), 'fcrn_id', 'itemLabel'),                        
                            'attribute' => 'finv_fcrn_id',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),

                /*array(
                    'name' => 'finv_amt',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'finv_amt',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'finv_vat',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'finv_vat',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'finv_total',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'finv_total',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        ),
                        true
                    )
                ),
                
                array(
                    'name' => 'finv_basic_fcrn_id',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                            'source' => CHtml::listData(FcrnCurrency::model()->findAll(array('limit' => 1000)), 'fcrn_id', 'itemLabel'),                        
                            'attribute' => 'finv_basic_fcrn_id',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),

                array(
                    'name' => 'finv_basic_amt',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'finv_basic_amt',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'finv_basic_vat',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'finv_basic_vat',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'finv_basic_total',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'finv_basic_total',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'finv_basic_payment_before',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'finv_basic_payment_before',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        ),
                        true
                    )
                ),*/

                array(
                    'name' => 'finv_stst_id',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                            'source' => CHtml::listData(StstState::model()->findAll(array('limit' => 1000)), 'stst_id', 'itemLabel'),                        
                            'attribute' => 'finv_stst_id',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),

                array(
                    'name' => 'finv_paid',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                            'source' => $model->getEnumFieldLabels('finv_paid'),
                            'attribute' => 'finv_paid',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),

                array(
                    'name' => 'finv_ref',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                            'source' => $model->getEnumFieldLabels('finv_ref'),
                            'attribute' => 'finv_ref',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),

                array(
                    'name' => 'finv_ref_id',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'finv_ref_id',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'finv_type',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2finv/finvInvoice/editableSaver'),
                            'source' => $model->getEnumFieldLabels('finv_type'),
                            'attribute' => 'finv_type',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),
           ),
        )); ?>
    </div>


    <div class="span7">
        <?php $this->renderPartial('_view-relations_grids',array('modelMain' => $model, 'ajax' => false,)); ?>
    </div>
    <div class="span7">
        <?php $this->widget('d2FilesWidget',array('model'=>$model)); ?>
    </div>
</div>

<?php echo $cancel_buton; ?>