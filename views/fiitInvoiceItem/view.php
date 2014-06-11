<?php
    $this->setPageTitle(
        Yii::t('D2finvModule.model', 'Fiit Invoice Item')
        . ' - '
        . Yii::t('D2finvModule.crud_static', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
//$this->breadcrumbs[Yii::t('D2finvModule.model','Fiit Invoice Items')] = array('admin');
//$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
//$this->breadcrumbs[] = Yii::t('D2finvModule.crud_static', 'View');
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    #"label"=>Yii::t("D2finvModule.crud_static","Cancel"),
    "icon"=>"chevron-left",
    "size"=>"large",
    "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
    "visible"=>(Yii::app()->user->checkAccess("D2finv.FiitInvoiceItem.*") || Yii::app()->user->checkAccess("D2finv.FiitInvoiceItem.View")),
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
                <?php echo Yii::t('D2finvModule.model','Fiit Invoice Item');?>                <small><?php echo$model->itemLabel?></small>
            </h1>
        </div>
        <div class="btn-group">
            <?php
            
            $this->widget("bootstrap.widgets.TbButton", array(
                "label"=>Yii::t("D2finvModule.crud_static","Delete"),
                "type"=>"danger",
                "icon"=>"icon-trash icon-white",
                "size"=>"large",
                "htmlOptions"=> array(
                    "submit"=>array("delete","fiit_id"=>$model->{$model->tableSchema->primaryKey}, "returnUrl"=>(Yii::app()->request->getParam("returnUrl"))?Yii::app()->request->getParam("returnUrl"):$this->createUrl("admin")),
                    "confirm"=>Yii::t("D2finvModule.crud_static","Do you want to delete this item?")
                ),
                "visible"=> (Yii::app()->request->getParam("fiit_id")) && (Yii::app()->user->checkAccess("D2finv.FiitInvoiceItem.*") || Yii::app()->user->checkAccess("D2finv.FiitInvoiceItem.Delete"))
            ));
            ?>
        </div>
    </div>
</div>



<div class="row">
    <div class="span5">
        <h2>
            <?php echo Yii::t('D2finvModule.crud_static','Data')?>            <small>
                #<?php echo $model->fiit_id ?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                
                array(
                    'name' => 'fiit_id',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fiit_id',
                            'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fiit_finv_id',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                            'source' => CHtml::listData(FinvInvoice::model()->findAll(array('limit' => 1000)), 'finv_id', 'itemLabel'),                        
                            'attribute' => 'fiit_finv_id',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),

                array(
                    'name' => 'fiit_desc',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fiit_desc',
                            'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fiit_debet_facn_code',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fiit_debet_facn_code',
                            'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fiit_credit_facn_code',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fiit_credit_facn_code',
                            'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fiit_fprc_id',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                            'source' => CHtml::listData(FprcProductCategory::model()->findAll(array('limit' => 1000)), 'fprc_id', 'itemLabel'),                        
                            'attribute' => 'fiit_fprc_id',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),

                array(
                    'name' => 'fiit_quantity',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fiit_quantity',
                            'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fiit_fqnt_id',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                            'source' => CHtml::listData(FqntQuantity::model()->findAll(array('limit' => 1000)), 'fqnt_id', 'itemLabel'),                        
                            'attribute' => 'fiit_fqnt_id',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),

                array(
                    'name' => 'fiit_price',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fiit_price',
                            'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fiit_amt',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fiit_amt',
                            'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fiit_vat',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fiit_vat',
                            'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fiit_total',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fiit_total',
                            'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fiit_fvat_id',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2finv/fiitInvoiceItem/editableSaver'),
                            'source' => CHtml::listData(FvatVat::model()->findAll(array('limit' => 1000)), 'fvat_id', 'itemLabel'),                        
                            'attribute' => 'fiit_fvat_id',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),
           ),
        )); ?>
    </div>


    <div class="span7">
        <div class="well">
            <?php $this->renderPartial('_view-relations_grids',array('modelMain' => $model, 'ajax' => false,)); ?>        </div>
    </div>
</div>

<?php echo $cancel_buton; ?>