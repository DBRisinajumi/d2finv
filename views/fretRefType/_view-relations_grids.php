<?php
if(!$ajax){
    Yii::app()->clientScript->registerCss('rel_grid',' 
            .rel-grid-view {padding-top:0px;margin-top: -35px;}
            h3.rel_grid{padding-left: 40px;}
            ');     
}
?>
<?php
if(!$ajax || $ajax == 'fixr-fiit-xref-grid'){
    Yii::beginProfile('fixr_fret_id.view.grid');
?>

<h3 class="rel_grid">    
    <?=Yii::t('D2finvModule.model', 'Fixr Fiit Xref')?>
    <?php    
        
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'ajaxButton', 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2finv/fixrFiitXRef/ajaxCreate',
                'field' => 'fixr_fret_id',
                'value' => $modelMain->primaryKey,
                'ajax' => 'fixr-fiit-xref-grid',
            ),
            'ajaxOptions' => array(
                    'success' => 'function(html) {$.fn.yiiGridView.update(\'fixr-fiit-xref-grid\');}'
                    ),
            'htmlOptions' => array(
                'title' => Yii::t('D2finvModule.crud', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</h3> 
 
<?php 

    if (empty($modelMain->fixrFiitXRefs)) {
        $model = new FixrFiitXRef;
        $model->fixr_fret_id = $modelMain->primaryKey;
        $model->save();
        unset($model);
    } 
    
    $model = new FixrFiitXRef();
    $model->fixr_fret_id = $modelMain->primaryKey;

    // render grid view

    $this->widget('TbGridView',
        array(
            'id' => 'fixr-fiit-xref-grid',
            'dataProvider' => $model->search(),
            'template' => '{summary}{items}',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
            ),            
            'columns' => array(
                array(
                'class' => 'editable.EditableColumn',
                'name' => 'fixr_fiit_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                    'source' => CHtml::listData(FiitInvoiceItem::model()->findAll(array('limit' => 1000)), 'fiit_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                //int(10) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'fixr_ref_id',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'fuxr_fcrn_date',
                'editable' => array(
                    'type' => 'date',
                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'fuxr_fcrn_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                    'source' => CHtml::listData(FcrnCurrency::model()->findAll(array('limit' => 1000)), 'fcrn_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2)
                'class' => 'editable.EditableColumn',
                'name' => 'fuxr_amt',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'fuxr_base_fcrn_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                    'source' => CHtml::listData(FcrnCurrency::model()->findAll(array('limit' => 1000)), 'fcrn_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                //decimal(10,2) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'fixr_base_amt',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'fixr_start_date',
                'editable' => array(
                    'type' => 'date',
                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            /*
            array(
                //smallint(10) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'fixr_months',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'fixr_end_date',
                'editable' => array(
                    'type' => 'date',
                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //int(10) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'fixr_start_abs_odo',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //int(10) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'fixr_km',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //int(10) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'fixr_end_abs_odo',
                'editable' => array(
                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            */

                array(
                    'class' => 'TbButtonColumn',
                    'buttons' => array(
                        'view' => array('visible' => 'FALSE'),
                        'update' => array('visible' => 'FALSE'),
                        'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2finv.FretRefType.DeletefixrFiitXRefs")'),
                    ),
                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2finv/fixrFiitXRef/delete", array("fixr_id" => $data->fixr_id))',
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
                ),
            )
        )
    );
    ?>

<?php
    Yii::endProfile('FixrFiitXRef.view.grid');
}    
?>
