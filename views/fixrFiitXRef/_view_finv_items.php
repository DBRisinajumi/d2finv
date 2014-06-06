<h2><?= Yii::t('D2finvModule.model', 'Invoce item dimensions') ?></h2>
<table id="sample-table-1" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>

            <th><?= Yii::t('D2finvModule.model', 'Fiit Desc') ?></th>
            <th><?= Yii::t('D2finvModule.model', 'Fiit Quantity') ?></th>
            <th><?= Yii::t('D2finvModule.model', 'Fiit Fqnt') ?></th>
            <th><?= Yii::t('D2finvModule.model', 'Fiit Price') ?></th>
            <th><?= Yii::t('D2finvModule.model', 'Fiit Amt') ?></th>
            <th><?= Yii::t('D2finvModule.model', 'Fiit Vat') ?></th>
            <th><?= Yii::t('D2finvModule.model', 'Fiit Total') ?></th>

        </tr>
    </thead>
    <tbody>
        <?php
        if (!$ajax) {
            Yii::app()->clientScript->registerCss('rel_grid', ' 
            .rel-grid-view-sub {padding-top:0px;margin-top: -30px;}
            h3.rel_grid-sub{padding-left: 40px;margin-top: 0px;}
            td.rel_grid-sub{padding-top: 0px; border-top-width: 0px;}
            ');
        }

        foreach ($modelMain->fiitInvoiceItems as $fiit) {
            ?>
            <tr>
                <td><?= $fiit->fiit_desc ?></td>
                <td class="numeric-column"><?= $fiit->fiit_quantity ?></td>
                <td><?= $fiit->fiit_fqnt_id ?></td>
                <td class="numeric-column"><?= $fiit->fiit_price ?></td>
                <td class="numeric-column"><?= $fiit->fiit_amt ?></td>
                <td class="numeric-column"><?= $fiit->fiit_vat ?></td>
                <td class="numeric-column"><?= $fiit->fiit_total ?></td>
            </tr>
            <tr>
                <td colspan="7" class="rel_grid-sub">
                    <h3 class="rel_grid-sub">
                        <?php
                        $sub_grid_id = 'fixr-grid-' . $fiit->primaryKey;
                        $this->widget(
                                'bootstrap.widgets.TbButton', array(
                            'buttonType' => 'ajaxButton',
                            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                            'size' => 'mini',
                            'icon' => 'icon-plus',
                            'url' => array(
                                '//d2finv/fixrFiitXRef/ajaxCreate',
                                'field' => 'fixr_fiit_id',
                                'value' => $fiit->primaryKey,
                                'ajax' => $sub_grid_id,
                            ),
                            'ajaxOptions' => array(
                                'success' => 'function(html) {$.fn.yiiGridView.update(\'' . $sub_grid_id . '\');}'
                            ),
                            'htmlOptions' => array(
                                'title' => Yii::t('D2finvModule.crud_static', 'Add new record'),
                                'data-toggle' => 'tooltip',
                            ),
                                )
                        );
                        ?>
                    </h3>                        
                    <?php
                    if (empty($fiit->fixrFiitXRefs)) {
                        $model = new FixrFiitXRef();
                        $model->fixr_fiit_id = $fiit->primaryKey;
                        $model->fuxr_fcrn_date = $modelMain->finv_budget_date;
                        $model->fuxr_fcrn_id = $modelMain->finv_fcrn_id;
                        $model->fuxr_base_fcrn_id = $modelMain->finv_basic_fcrn_id;
                        $model->save();
                        unset($model);
                    }

                    $model = new FixrFiitXRef();
                    $model->fixr_fiit_id = $fiit->primaryKey;

                    $this->widget('TbGridView', array(
                        'id' => $sub_grid_id,
                        'dataProvider' => $model->search(),
                        'template' => '{summary}{items}',
                        'summaryText' => '&nbsp;',
                        'htmlOptions' => array(
                            'class' => 'rel-grid-view-sub'
                        ),
                        'columns' => array(
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
                                'name' => 'fixr_start_date',
                                'editable' => array(
                                    'type' => 'date',
                                    'url' => $this->createUrl('//d2finv/fixrFiitXRef/editableSaver'),
                                //'placement' => 'right',
                                )
                            ),
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
                            array(
                                'class' => 'TbButtonColumn',
                                'buttons' => array(
                                    'view' => array('visible' => 'FALSE'),
                                    'update' => array('visible' => 'FALSE'),
                                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2finv.FretRefType.DeletefixrFiitXRefs")'),
                                ),
                                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2finv/fixrFiitXRef/delete", array("fixr_id" => $data->fixr_id))',
                                'deleteButtonOptions' => array('data-toggle' => 'tooltip'),
                            ),
                        ),))
                    ?>


                </td>
            </tr>
    <?
}
?>
    </tbody>
</table>