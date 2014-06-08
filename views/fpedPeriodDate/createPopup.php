<?php 
//$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
//                'id'=>'periodDialog',
//                'options'=>array(
//                    'title'=>Yii::t('D2finvModule.model','Create Fped Period Date'),
//                    'autoOpen'=>true,
//                    'modal'=>'true',
//                    'width'=>'auto',
//                    'height'=>'auto',
//                ),
//                ));

$this->renderPartial('_formPopup', array('model' => $model, 'buttons' => 'create'));

//$this->endWidget('zii.widgets.jui.CJuiDialog');