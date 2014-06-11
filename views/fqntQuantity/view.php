<?php
    $this->setPageTitle(
        Yii::t('D2finvModule.model', 'Fqnt Quantity')
        . ' - '
        . Yii::t('D2finvModule.crud_static', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
//$this->breadcrumbs[Yii::t('D2finvModule.model','Fqnt Quantities')] = array('admin');
//$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
//$this->breadcrumbs[] = Yii::t('D2finvModule.crud_static', 'View');
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    #"label"=>Yii::t("D2finvModule.crud_static","Cancel"),
    "icon"=>"chevron-left",
    "size"=>"large",
    "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
    "visible"=>(Yii::app()->user->checkAccess("D2finv.FqntQuantity.*") || Yii::app()->user->checkAccess("D2finv.FqntQuantity.View")),
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
                <?php echo Yii::t('D2finvModule.model','Fqnt Quantity');?>                <small><?php echo$model->itemLabel?></small>
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
                    "submit"=>array("delete","fqnt_id"=>$model->{$model->tableSchema->primaryKey}, "returnUrl"=>(Yii::app()->request->getParam("returnUrl"))?Yii::app()->request->getParam("returnUrl"):$this->createUrl("admin")),
                    "confirm"=>Yii::t("D2finvModule.crud_static","Do you want to delete this item?")
                ),
                "visible"=> (Yii::app()->request->getParam("fqnt_id")) && (Yii::app()->user->checkAccess("D2finv.FqntQuantity.*") || Yii::app()->user->checkAccess("D2finv.FqntQuantity.Delete"))
            ));
            ?>
        </div>
    </div>
</div>



<div class="row">
    <div class="span5">
        <h2>
            <?php echo Yii::t('D2finvModule.crud_static','Data')?>            <small>
                #<?php echo $model->fqnt_id ?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                
                array(
                    'name' => 'fqnt_id',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fqnt_id',
                            'url' => $this->createUrl('/d2finv/fqntQuantity/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fqnt_code',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fqnt_code',
                            'url' => $this->createUrl('/d2finv/fqntQuantity/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fqnt_name',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fqnt_name',
                            'url' => $this->createUrl('/d2finv/fqntQuantity/editableSaver'),
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