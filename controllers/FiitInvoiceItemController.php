<?php


class FiitInvoiceItemController extends Controller
{
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";
    public $scope = "crud";


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
            'actions' => array('create', 'admin', 'view', 'update', 'editableSaver', 'delete','ajaxCreate'),
            'roles' => array('D2finv.FiitInvoiceItem.*'),
        ),
        array(
            'allow',
            'actions' => array('create','ajaxCreate'),
            'roles' => array('D2finv.FiitInvoiceItem.Create'),
        ),
        array(
            'allow',
            'actions' => array('view', 'admin'), // let the user view the grid
            'roles' => array('D2finv.FiitInvoiceItem.View'),
        ),
        array(
            'allow',
            'actions' => array('update', 'editableSaver'),
            'roles' => array('D2finv.FiitInvoiceItem.Update'),
        ),
        array(
            'allow',
            'actions' => array('delete'),
            'roles' => array('D2finv.FiitInvoiceItem.Delete'),
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

    public function actionView($fiit_id, $ajax = false)
    {
        $model = $this->loadModel($fiit_id);
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

    public function actionCreate()
    {
        $model = new FiitInvoiceItem;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'fiit-invoice-item-form');

        if (isset($_POST['FiitInvoiceItem'])) {
            $model->attributes = $_POST['FiitInvoiceItem'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'fiit_id' => $model->fiit_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('fiit_id', $e->getMessage());
            }
        } elseif (isset($_GET['FiitInvoiceItem'])) {
            $model->attributes = $_GET['FiitInvoiceItem'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($fiit_id)
    {
        $model = $this->loadModel($fiit_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'fiit-invoice-item-form');

        if (isset($_POST['FiitInvoiceItem'])) {
            $model->attributes = $_POST['FiitInvoiceItem'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'fiit_id' => $model->fiit_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('fiit_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionEditableSaver()
    {
        $es = new EditableSaver('FiitInvoiceItem'); // classname of model to be updated
        $es->update();
    }

    public function actionAjaxCreate($field, $value) 
    {
        $model = new FiitInvoiceItem;
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
    
    public function actionDelete($fiit_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($fiit_id)->delete();
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
        $model = new FiitInvoiceItem('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['FiitInvoiceItem'])) {
            $model->attributes = $_GET['FiitInvoiceItem'];
        }

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $m = FiitInvoiceItem::model();
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'fiit-invoice-item-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
