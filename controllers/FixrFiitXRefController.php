<?php


class FixrFiitXRefController extends Controller
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
            'actions' => array('create', 'admin', 'view', 'update', 'editableSaver', 'delete','ajaxCreate','viewFinv'),
            'roles' => array('D2finv.FixrFiitXRef.*'),
        ),
        array(
            'allow',
            'actions' => array('create','ajaxCreate'),
            'roles' => array('D2finv.FixrFiitXRef.Create'),
        ),
        array(
            'allow',
            'actions' => array('view', 'admin','FixrFiitXRef'), // let the user view the grid
            'roles' => array('D2finv.FixrFiitXRef.View'),
        ),
        array(
            'allow',
            'actions' => array('update', 'editableSaver','viewFinv'),
            'roles' => array('D2finv.FixrFiitXRef.Update'),
        ),
        array(
            'allow',
            'actions' => array('delete'),
            'roles' => array('D2finv.FixrFiitXRef.Delete'),
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

    public function actionView($fixr_id, $ajax = false)
    {
        $model = $this->loadModel($fixr_id);
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

    public function actionViewFinv($finv_id, $ajax = false)
    {
        
        $model = FinvInvoice::model()->findByPk($finv_id);
        $this->render('viewFinv', array('model' => $model,));

    }

    public function actionCreate()
    {
        $model = new FixrFiitXRef;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'fixr-fiit-xref-form');

        if (isset($_POST['FixrFiitXRef'])) {
            $model->attributes = $_POST['FixrFiitXRef'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'fixr_id' => $model->fixr_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('fixr_id', $e->getMessage());
            }
        } elseif (isset($_GET['FixrFiitXRef'])) {
            $model->attributes = $_GET['FixrFiitXRef'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($fixr_id)
    {
        $model = $this->loadModel($fixr_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'fixr-fiit-xref-form');

        if (isset($_POST['FixrFiitXRef'])) {
            $model->attributes = $_POST['FixrFiitXRef'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'fixr_id' => $model->fixr_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('fixr_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionEditableSaver()
    {
        Yii::import('TbEditableSaver');
        $es = new TbEditableSaver('FixrFiitXRef'); // classname of model to be updated
        $es->update();
    }

    public function actionAjaxCreate($field, $value) 
    {
        $model = new FixrFiitXRef;
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
    
    public function actionDelete($fixr_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($fixr_id)->delete();
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
            throw new CHttpException(400, Yii::t('D2finvModule.crud', 'Invalid request. Please do not repeat this request again.'));
        }
    }

    public function actionAdmin()
    {
        $model = new FixrFiitXRef('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['FixrFiitXRef'])) {
            $model->attributes = $_GET['FixrFiitXRef'];
        }

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $m = FixrFiitXRef::model();
        // apply scope, if available
        $scopes = $m->scopes();
        if (isset($scopes[$this->scope])) {
            $m->{$this->scope}();
        }
        $model = $m->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('D2finvModule.crud', 'The requested page does not exist.'));
        }
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'fixr-fiit-xref-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
