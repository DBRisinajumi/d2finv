<?php
$this->setPageTitle(
    Yii::t('D2finvModule.model', 'Fvat Vats')
    . ' - '
    . Yii::t('D2finvModule.crud_static', 'Manage')
);

$this->breadcrumbs[] = Yii::t('D2finvModule.model', 'Fvat Vats');

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
             'visible'=>(Yii::app()->user->checkAccess('D2finv.FvatVat.*') || Yii::app()->user->checkAccess('D2finv.FvatVat.Create'))
        ));  
        ?>
</div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2finvModule.model', 'Fvat Vats');?>            </h1>
        </div>
    </div>
</div>

<?php Yii::beginProfile('FvatVat.view.grid'); ?>


<?php
$this->widget('TbGridView',
    array(
        'id' => 'fvat-vat-grid',
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
                'urlExpression' => 'Yii::app()->controller->createUrl("view", array("fvat_id" => $data["fvat_id"]))'
            ),
            array(
                //tinyint(3) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'fvat_id',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fvatVat/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(4,2)
                'class' => 'editable.EditableColumn',
                'name' => 'fvat_rate',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fvatVat/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //char(10)
                'class' => 'editable.EditableColumn',
                'name' => 'fvat_label',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fvatVat/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //tinyint(3) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'fvat_order',
                'editable' => array(
                    'url' => $this->createUrl('/d2finv/fvatVat/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'fvat_hide',
                    'editable' => array(
                        'type' => 'select',
                        'url' => $this->createUrl('/d2finv/fvatVat/editableSaver'),
                        'source' => $model->getEnumFieldLabels('fvat_hide'),
                        //'placement' => 'right',
                    ),
                   'filter' => $model->getEnumFieldLabels('fvat_hide'),
                ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2finv.FvatVat.View")'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2finv.FvatVat.Delete")'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("fvat_id" => $data->fvat_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("fvat_id" => $data->fvat_id))',
                'viewButtonOptions'=>array('data-toggle'=>'tooltip'),   
                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),   
            ),
        )
    )
);
?>
<?php Yii::endProfile('FvatVat.view.grid'); ?>