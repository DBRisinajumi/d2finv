<?php
$this->setPageTitle(
    Yii::t('D2finvModule.model', 'Fprc Product Categories')
    . ' - '
    . Yii::t('D2finvModule.crud_static', 'Manage')
);

//$this->breadcrumbs[] = Yii::t('D2finvModule.model', 'Fprc Product Categories');

?>

<?php //$this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
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
             'visible'=>(Yii::app()->user->checkAccess('D2finv.FprcProductCategory.*') || Yii::app()->user->checkAccess('D2finv.FprcProductCategory.Create'))
        ));  
        ?>
</div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2finvModule.model', 'Fprc Product Categories');?>            </h1>
        </div>
    </div>
</div>

<?php Yii::beginProfile('FprcProductCategory.view.grid'); ?>


<?php
$this->widget('TbGridView',
    array(
        'id' => 'fprc-product-category-grid',
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
                'urlExpression' => 'Yii::app()->controller->createUrl("view", array("fprc_id" => $data["fprc_id"]))'
            ),
            array(
                //smallint(5) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'fprc_id',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fprcProductCategory/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //char(10)
                'class' => 'editable.EditableColumn',
                'name' => 'fprc_code',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fprcProductCategory/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(100)
                'class' => 'editable.EditableColumn',
                'name' => 'fprc_name',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fprcProductCategory/editableSaver'),
                    //'placement' => 'right',
                )
            ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2finv.FprcProductCategory.View")'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2finv.FprcProductCategory.Delete")'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("fprc_id" => $data->fprc_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("fprc_id" => $data->fprc_id))',
                'viewButtonOptions'=>array('data-toggle'=>'tooltip'),   
                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),   
            ),
        )
    )
);
?>
<?php Yii::endProfile('FprcProductCategory.view.grid'); ?>