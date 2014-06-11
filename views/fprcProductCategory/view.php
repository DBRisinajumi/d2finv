<?php
    $this->setPageTitle(
        Yii::t('D2finvModule.model', 'Fprc Product Category')
        . ' - '
        . Yii::t('D2finvModule.crud_static', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
//$this->breadcrumbs[Yii::t('D2finvModule.model','Fprc Product Categories')] = array('admin');
//$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
//$this->breadcrumbs[] = Yii::t('D2finvModule.crud_static', 'View');
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    #"label"=>Yii::t("D2finvModule.crud_static","Cancel"),
    "icon"=>"chevron-left",
    "size"=>"large",
    "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
    "visible"=>(Yii::app()->user->checkAccess("D2finv.FprcProductCategory.*") || Yii::app()->user->checkAccess("D2finv.FprcProductCategory.View")),
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
                <?php echo Yii::t('D2finvModule.model','Fprc Product Category');?>                <small><?php echo$model->itemLabel?></small>
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
                    "submit"=>array("delete","fprc_id"=>$model->{$model->tableSchema->primaryKey}, "returnUrl"=>(Yii::app()->request->getParam("returnUrl"))?Yii::app()->request->getParam("returnUrl"):$this->createUrl("admin")),
                    "confirm"=>Yii::t("D2finvModule.crud_static","Do you want to delete this item?")
                ),
                "visible"=> (Yii::app()->request->getParam("fprc_id")) && (Yii::app()->user->checkAccess("D2finv.FprcProductCategory.*") || Yii::app()->user->checkAccess("D2finv.FprcProductCategory.Delete"))
            ));
            ?>
        </div>
    </div>
</div>



<div class="row">
    <div class="span5">
        <h2>
            <?php echo Yii::t('D2finvModule.crud_static','Data')?>            <small>
                #<?php echo $model->fprc_id ?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                
                array(
                    'name' => 'fprc_id',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fprc_id',
                            'url' => $this->createUrl('/d2finv/fprcProductCategory/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fprc_code',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fprc_code',
                            'url' => $this->createUrl('/d2finv/fprcProductCategory/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'fprc_name',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'fprc_name',
                            'url' => $this->createUrl('/d2finv/fprcProductCategory/editableSaver'),
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