<?php
$this->setPageTitle(
    Yii::t('D2finvModule.model', 'Fiit Invoice Item')
    . ' - '
    . Yii::t('D2finvModule.crud_static', 'Create')
);

//$this->breadcrumbs[Yii::t('D2finvModule.model', 'Fiit Invoice Items')] = array('admin');
//$this->breadcrumbs[] = Yii::t('D2finvModule.crud_static', 'Create');
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    #"label"=>Yii::t("D2finvModule.crud_static","Cancel"),
    "icon"=>"chevron-left",
    "size"=>"large",
    "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
    "visible"=>(Yii::app()->user->checkAccess("D2finv.FiitInvoiceItem.*") || Yii::app()->user->checkAccess("D2finv.FiitInvoiceItem.View")),
    "htmlOptions"=>array(
                    "class"=>"search-button",
                    "data-toggle"=>"tooltip",
                    "title"=>Yii::t("D2finvModule.crud_static","Cancel"),
                )
 ),true);
    
?>
<?php //$this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group"><?php echo $cancel_buton;?></div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2finvModule.model','Create Fiit Invoice Item');?>            </h1>
        </div>
    </div>
</div>

<?php $this->renderPartial('_form', array('model' => $model, 'buttons' => 'create')); ?>
<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group"><?php echo $cancel_buton;?></div>
        <div class="btn-group">
            
                <?php  
                    $this->widget("bootstrap.widgets.TbButton", array(
                       "label"=>Yii::t("D2finvModule.crud_static","Save"),
                       "icon"=>"icon-thumbs-up icon-white",
                       "size"=>"large",
                       "type"=>"primary",
                       "htmlOptions"=> array(
                            "onclick"=>"$('.crud-form form').submit();",
                       ),
                       "visible"=> (Yii::app()->user->checkAccess("D2finv.FiitInvoiceItem.*") || Yii::app()->user->checkAccess("D2finv.FiitInvoiceItem.View"))
                    )); 
                    ?>
                  
        </div>
    </div>
</div>