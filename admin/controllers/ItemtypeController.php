<?php

namespace admin\controllers;

use Yii;
use common\models\Itemtype;
use admin\models\Authitem;
use admin\models\ItemtypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ItemtypeController implements the CRUD actions for Itemtype model.
 */
class ItemtypeController extends Controller
{
    public function init()
    {
        parent::init();
        if (Yii::$app->user->isGuest) { // chekck the admin logged in
            //$this->redirect('login');
            $url = Yii::$app->urlManager->createUrl(['admin/site/login']);
            Yii::$app->getResponse()->redirect($url);
        }
    }

    public function behaviors()
    {
        return [
                    'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                   [
                       'actions' => [],
                       'allow' => true,
                       'roles' => ['?'],
                   ],
                   [
                       'actions' => ['create', 'update', 'index', 'view', 'delete'],
                       'allow' => true,
                       'roles' => ['@'],
                   ],
               ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                 //   'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Itemtype models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $access = Authitem::AuthitemCheck('4', '21');
        if (yii::$app->user->can($access)) {
            $searchModel = new ItemtypeSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        } else {
            echo Yii::$app->session->setFlash('danger', 'Your are not allowed to access the page!');
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Displays a single Itemtype model.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Itemtype model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $access = Authitem::AuthitemCheck('1', '21');
        if (yii::$app->user->can($access)) {
            $model = new Itemtype();
            $model->scenario = 'insert';
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                'model' => $model,
            ]);
            }
        } else {
            echo Yii::$app->session->setFlash('danger', 'Your are not allowed to access the page!');

            return $this->redirect(['site/index']);
        }
    }

    /**
     * Updates an existing Itemtype model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $access = Authitem::AuthitemCheck('2', '21');
        if (yii::$app->user->can($access)) {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                'model' => $model,
            ]);
            }
        } else {
            echo Yii::$app->session->setFlash('danger', 'Your are not allowed to access the page!');

            return $this->redirect(['site/index']);
        }
    }

    /**
     * Deletes an existing Itemtype model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $access = Authitem::AuthitemCheck('3', '21');
        if (yii::$app->user->can($access)) {
            $this->findModel($id)->delete();
            echo Yii::$app->session->setFlash('success', 'Item type deleted successfully!');

            return $this->redirect(['index']);
        } else {
            echo Yii::$app->session->setFlash('danger', 'Your are not allowed to access the page!');

            return $this->redirect(['site/index']);
        }
    }

    /**
     * Finds the Itemtype model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     *
     * @return Itemtype the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Itemtype::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
