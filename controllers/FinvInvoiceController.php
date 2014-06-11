<?php


class FinvInvoiceController extends Controller
{
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";
    public $scope = "crud";
    public $menu_route = "d2finv/FinvInvoice";    


public function filters()
{
    return array(
        'accessControl',
    );
}

public function accessRules()
{
     return array(
        array(
            'allow',
            'actions' => array('create', 'admin', 'view', 'update', 'editableSaver', 'delete', 'ajaxCreate', 'copy'),
            'roles' => array('D2finv.FinvInvoice.*'),
        ),
        array(
            'allow',
            'actions' => array('create','ajaxCreate'),
            'roles' => array('D2finv.FinvInvoice.Create'),
        ),
        array(
            'allow',
            'actions' => array('view', 'admin', 'demo'), // let the user view the grid
            'roles' => array('D2finv.FinvInvoice.View'),
        ),
        array(
            'allow',
            'actions' => array('update', 'editableSaver'),
            'roles' => array('D2finv.FinvInvoice.Update'),
        ),
        array(
            'allow',
            'actions' => array('delete'),
            'roles' => array('D2finv.FinvInvoice.Delete'),
        ),
        array(
            'deny',
            'users' => array('*'),
        ),
    );
}

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        if ($this->module !== null) {
            $this->breadcrumbs[$this->module->Id] = array('/' . $this->module->Id);
        }
        return true;
    }

    public function actionView($finv_id, $ajax = false)
    {
        $model = $this->loadModel($finv_id);
        if($ajax){
            $this->renderPartial('_view-relations_grids', 
                    array(
                        'modelMain' => $model,
                        'ajax' => $ajax,
                        )
                    );
        }else{
            $this->render('view', array('model' => $model,));
        }
    }
    
    public function actionDemo($finv_id, $ajax = false)
    {
        $model = $this->loadModel($finv_id);
        if($ajax){
            $this->renderPartial('_view-relations_grids', 
                    array(
                        'modelMain' => $model,
                        'ajax' => $ajax,
                        )
                    );
        }else{
            $this->render('demo', array('model' => $model,));
        }
    }

    public function actionCreate()
    {
        $model = new FinvInvoice;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'finv-invoice-form');

        if (isset($_POST['FinvInvoice'])) {
            $model->attributes = $_POST['FinvInvoice'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'finv_id' => $model->finv_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('finv_id', $e->getMessage());
            }
        } elseif (isset($_GET['FinvInvoice'])) {
            $model->attributes = $_GET['FinvInvoice'];
        }

        $this->render('create', array('model' => $model));
    }
    
    public function actionCopy()
    {
        $model = new FinvInvoice;
        $model->scenario = $this->scenario;

        if (isset($_GET['finv_id'])) {
            
            try {
                if ($model->duplicate($_GET['finv_id'])) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'finv_id' => $model->finv_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('finv_id', $e->getMessage());
            }
            
        }

        $this->render('copy', array('model' => $model));
    }

    public function actionUpdate($finv_id)
    {
        $model = $this->loadModel($finv_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'finv-invoice-form');

        if (isset($_POST['FinvInvoice'])) {
            $model->attributes = $_POST['FinvInvoice'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'finv_id' => $model->finv_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('finv_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionEditableSaver()
    {
        Yii::import('TbEditableSaver');
        $es = new TbEditableSaver('FinvInvoice'); // classname of model to be updated
        $es->update();
    }

    public function actionAjaxCreate($field, $value) 
    {
        $model = new FinvInvoice;
        $model->$field = $value;
        try {
            if ($model->save()) {
                return TRUE;
            }else{
                return var_export($model->getErrors());
            }            
        } catch (Exception $e) {
            throw new CHttpException(500, $e->getMessage());
        }
    }
    
    public function actionDelete($finv_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($finv_id)->delete();
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!isset($_GET['ajax'])) {
                if (isset($_GET['returnUrl'])) {
                    $this->redirect($_GET['returnUrl']);
                } else {
                    $this->redirect(array('admin'));
                }
            }
        } else {
            throw new CHttpException(400, Yii::t('D2finvModule.crud_static', 'Invalid request. Please do not repeat this request again.'));
        }
    }

    public function actionAdmin()
    {
        $model = new FinvInvoice('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['FinvInvoice'])) {
            $model->attributes = $_GET['FinvInvoice'];
        }

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $m = FinvInvoice::model();
        // apply scope, if available
        $scopes = $m->scopes();
        if (isset($scopes[$this->scope])) {
            $m->{$this->scope}();
        }
        $model = $m->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('D2finvModule.crud_static', 'The requested page does not exist.'));
        }
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'finv-invoice-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
