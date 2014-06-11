<?php
$this->setPageTitle(
    Yii::t('D2finvModule.model', 'Fqnt Quantities')
    . ' - '
    . Yii::t('D2finvModule.crud_static', 'Manage')
);

//$this->breadcrumbs[] = Yii::t('D2finvModule.model', 'Fqnt Quantities');

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
             'visible'=>(Yii::app()->user->checkAccess('D2finv.FqntQuantity.*') || Yii::app()->user->checkAccess('D2finv.FqntQuantity.Create'))
        ));  
        ?>
</div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2finvModule.model', 'Fqnt Quantities');?>            </h1>
        </div>
    </div>
</div>

<?php Yii::beginProfile('FqntQuantity.view.grid'); ?>


<?php
$this->widget('TbGridView',
    array(
        'id' => 'fqnt-quantity-grid',
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
                'urlExpression' => 'Yii::app()->controller->createUrl("view", array("fqnt_id" => $data["fqnt_id"]))'
            ),
            array(
                //tinyint(3) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'fqnt_id',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fqntQuantity/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(10)
                'class' => 'editable.EditableColumn',
                'name' => 'fqnt_code',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fqntQuantity/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(50)
                'class' => 'editable.EditableColumn',
                'name' => 'fqnt_name',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fqntQuantity/editableSaver'),
                    //'placement' => 'right',
                )
            ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2finv.FqntQuantity.View")'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2finv.FqntQuantity.Delete")'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("fqnt_id" => $data->fqnt_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("fqnt_id" => $data->fqnt_id))',
                'viewButtonOptions'=>array('data-toggle'=>'tooltip'),   
                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),   
            ),
        )
    )
);
?>
<?php Yii::endProfile('FqntQuantity.view.grid'); ?>