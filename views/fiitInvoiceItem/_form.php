<div class="crud-form">
    <?php  ?>    
    <?php
        Yii::app()->bootstrap->registerPackage('select2');
        Yii::app()->clientScript->registerScript('crud/variant/update','$("#fiit-invoice-item-form select").select2();');


        $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'fiit-invoice-item-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'htmlOptions' => array(
                'enctype' => ''
            )
        ));

        echo $form->errorSummary($model);
    ?>
    
    <div class="row">
        <div class="span5">
            <div class="form-horizontal">

                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2finvModule.model', 'tooltip.fiit_id')) != 'tooltip.fiit_id')?$t:'' ?>'>
                                <?php
                            ;
                            echo $form->error($model,'fiit_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'fiit_finv_id') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2finvModule.model', 'tooltip.fiit_finv_id')) != 'tooltip.fiit_finv_id')?$t:'' ?>'>
                                <?php
                            $this->widget(
                '\GtcRelation',
                array(
                    'model' => $model,
                    'relation' => 'fiitFinv',
                    'fields' => 'itemLabel',
                    'allowEmpty' => true,
                    'style' => 'dropdownlist',
                    'htmlOptions' => array(
                        'checkAll' => 'all'
                    ),
                )
                );
                            echo $form->error($model,'fiit_finv_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'fiit_desc') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2finvModule.model', 'tooltip.fiit_desc')) != 'tooltip.fiit_desc')?$t:'' ?>'>
                                <?php
                            echo $form->textArea($model, 'fiit_desc', array('rows' => 6, 'cols' => 50));
                            echo $form->error($model,'fiit_desc')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'fiit_debet_facn_code') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2finvModule.model', 'tooltip.fiit_debet_facn_code')) != 'tooltip.fiit_debet_facn_code')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'fiit_debet_facn_code', array('size' => 20, 'maxlength' => 20));
                            echo $form->error($model,'fiit_debet_facn_code')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'fiit_credit_facn_code') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2finvModule.model', 'tooltip.fiit_credit_facn_code')) != 'tooltip.fiit_credit_facn_code')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'fiit_credit_facn_code', array('size' => 20, 'maxlength' => 20));
                            echo $form->error($model,'fiit_credit_facn_code')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'fiit_fprc_id') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2finvModule.model', 'tooltip.fiit_fprc_id')) != 'tooltip.fiit_fprc_id')?$t:'' ?>'>
                                <?php
                            $this->widget(
                '\GtcRelation',
                array(
                    'model' => $model,
                    'relation' => 'fiitFprc',
                    'fields' => 'itemLabel',
                    'allowEmpty' => true,
                    'style' => 'dropdownlist',
                    'htmlOptions' => array(
                        'checkAll' => 'all'
                    ),
                )
                );
                            echo $form->error($model,'fiit_fprc_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'fiit_quantity') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2finvModule.model', 'tooltip.fiit_quantity')) != 'tooltip.fiit_quantity')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'fiit_quantity', array('size' => 10, 'maxlength' => 10));
                            echo $form->error($model,'fiit_quantity')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'fiit_fqnt_id') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2finvModule.model', 'tooltip.fiit_fqnt_id')) != 'tooltip.fiit_fqnt_id')?$t:'' ?>'>
                                <?php
                            $this->widget(
                '\GtcRelation',
                array(
                    'model' => $model,
                    'relation' => 'fiitFqnt',
                    'fields' => 'itemLabel',
                    'allowEmpty' => true,
                    'style' => 'dropdownlist',
                    'htmlOptions' => array(
                        'checkAll' => 'all'
                    ),
                )
                );
                            echo $form->error($model,'fiit_fqnt_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'fiit_price') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2finvModule.model', 'tooltip.fiit_price')) != 'tooltip.fiit_price')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'fiit_price', array('size' => 10, 'maxlength' => 10));
                            echo $form->error($model,'fiit_price')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'fiit_amt') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2finvModule.model', 'tooltip.fiit_amt')) != 'tooltip.fiit_amt')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'fiit_amt', array('size' => 10, 'maxlength' => 10));
                            echo $form->error($model,'fiit_amt')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'fiit_vat') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2finvModule.model', 'tooltip.fiit_vat')) != 'tooltip.fiit_vat')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'fiit_vat', array('size' => 10, 'maxlength' => 10));
                            echo $form->error($model,'fiit_vat')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'fiit_total') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2finvModule.model', 'tooltip.fiit_total')) != 'tooltip.fiit_total')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'fiit_total', array('size' => 10, 'maxlength' => 10));
                            echo $form->error($model,'fiit_total')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'fiit_fvat_id') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2finvModule.model', 'tooltip.fiit_fvat_id')) != 'tooltip.fiit_fvat_id')?$t:'' ?>'>
                                <?php
                            $this->widget(
                '\GtcRelation',
                array(
                    'model' => $model,
                    'relation' => 'fiitFvat',
                    'fields' => 'itemLabel',
                    'allowEmpty' => true,
                    'style' => 'dropdownlist',
                    'htmlOptions' => array(
                        'checkAll' => 'all'
                    ),
                )
                );
                            echo $form->error($model,'fiit_fvat_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                
            </div>
        </div>
        <!-- main inputs -->

        
    </div>

    <p class="alert">
        
        <?php 
            echo Yii::t('D2finvModule.crud_static','Fields with <span class="required">*</span> are required.');
                
            /**
             * @todo: We need the buttons inside the form, when a user hits <enter>
             */                
            echo ' '.CHtml::submitButton(Yii::t('D2finvModule.crud_static', 'Save'), array(
                'class' => 'btn btn-primary',
                'style'=>'visibility: hidden;'                
            ));
                
        ?>
    </p>


    <?php $this->endWidget() ?>    <?php  ?></div> <!-- form -->
