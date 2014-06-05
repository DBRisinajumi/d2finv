<?php
    $this->setPageTitle(
        Yii::t('D2finvModule.model', 'Fvat Vat')
        . ' - '
        . Yii::t('D2finvModule.crud_static', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
$this->breadcrumbs[Yii::t('D2finvModule.model','Fvat Vats')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('D2finvModule.crud_static', 'View');
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    #"label"=>Yii::t("D2finvModule.crud_static","Cancel"),
    "icon"=>"chevron-left",
    "size"=>"large",
    "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
    "visible"=>(Yii::app()->user->checkAccess("D2finv.FvatVat.*") || Yii::app()->user->checkAccess("D2finv.FvatVat.View")),
    "htmlOptions"=>array(
                    "class"=>"search-button",
                    "data-toggle"=>"tooltip",
                    "title"=>Yii::t("D2finvModule.crud_static","Back"),
                )
 ),true);
    
?>
<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group"><?php echo $cancel_buton;?></div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2finvModule.model','Fvat Vat');?>                <small><?php echo$model->itemLabel?></small>
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
                    "submit"=>array("delete","fvat_id"=>$model->{$model->tableSchema->primaryKey}, "returnUrl"=>(Yii::app()->request->getParam("returnUrl"))?Yii::app()->request->getParam("returnUrl"):$this->createUrl("admin")),
                    "confirm"=>Yii::t("D2finvModule.crud_static","Do you want to delete this item?")
                ),
                "visible"=> (Yii::app()->request->getParam("fvat_id")) && (Yii::app()->user->checkAccess("D2finv.FvatVat.*") || Yii::app()->user->checkAccess("D2finv.FvatVat.Delete"))
            ));
            ?>
        </div>
    </div>
</div>



<div class="row">
    <div class="span5">
        <h2>
            <?php echo Yii::t('D2finvModule.crud_static','Data')?>            <small>
                #<?php echo $model->fvat_id ?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                
                array(
                    'name' => 'fvat_id',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fvat_id',
                            'url' => $this->createUrl('/d2finv/fvatVat/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fvat_rate',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fvat_rate',
                            'url' => $this->createUrl('/d2finv/fvatVat/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fvat_label',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fvat_label',
                            'url' => $this->createUrl('/d2finv/fvatVat/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fvat_order',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fvat_order',
                            'url' => $this->createUrl('/d2finv/fvatVat/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fvat_hide',
                    'type' => 'raw',    
                    'value' => $this->widget(
                        'EditableField', 
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2finv/fvatVat/editableSaver'),
                            'source' => $model->getEnumFieldLabels('fvat_hide'),
                            'attribute' => 'fvat_hide',
                            //'placement' => 'right',                                
                        ), 
                        true
                    )                   
                ),
           ),
        )); ?>
    </div>


    <!--<div class="span7">
        <div class="well">
            <?php //$this->renderPartial('_view-relations_grids',array('modelMain' => $model, 'ajax' => false,)); ?>        </div>
    </div>-->
</div>

<?php echo $cancel_buton; ?>