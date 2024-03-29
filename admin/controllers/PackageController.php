<?php

namespace admin\controllers;

use Yii;
use admin\models\Authitem;
use admin\models\Package;
use admin\models\PackageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PackageController implements the CRUD actions for Package model.
 */
class PackageController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['post'],
                ],
            ],
           'access' => [
               'class' => AccessControl::className(),
                'rules' => [
                   [
                       'actions' => [],
                       'allow' => true,
                       'roles' => ['?'],
                   ],
                   [
                       'actions' => ['create', 'update', 'index', 'view', 'delete', 'block', 'packagedelete', 'packageupdate'],
                       'allow' => true,
                       'roles' => ['@'],
                   ],
               ],
           ],
        ];
    }

    /**
     * Lists all Package models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $access = Authitem::AuthitemCheck('4', '16');
        if (yii::$app->user->can($access)) {
            $searchModel = new PackageSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        } else {
            echo Yii::$app->session->setFlash('danger', 'Your are not allowed to access the page!');

            return $this->redirect(['site/index']);
        }
    }

    /**
     * Displays a single Package model.
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
     * Creates a new Package model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $access = Authitem::AuthitemCheck('1', '16');
        if (yii::$app->user->can($access)) {
            $model = new Package();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->save();
                $pack = Yii::$app->request->post();
                echo Yii::$app->session->setFlash('success', 'Package created successfully!');
                Yii::info('[Package Created] Admin created new '.$model->package_name.' package', __METHOD__);

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
     * Updates an existing Package model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $access = Authitem::AuthitemCheck('2', '16');
        if (yii::$app->user->can($access)) {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                echo Yii::$app->session->setFlash('success', 'Package Updated successfully!');
                Yii::info('[Package Updated] Admin updated '.$model->package_name.' package information', __METHOD__);
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
     * Deletes an existing Package model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $access = Authitem::AuthitemCheck('3', '16');
        if (yii::$app->user->can($access)) {
            $model = $this->findModel($id);
            $model->trash = 'Deleted';
            $model->load(Yii::$app->request->post());
            $model->save();
            echo Yii::$app->session->setFlash('success', 'Package deleted successfully!');

            return $this->redirect(['index']);
        } else {
            echo Yii::$app->session->setFlash('danger', 'Your are not allowed to access the page!');
            return $this->redirect(['site/index']);
        }
    }

    public function actionPackagedelete()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            return $command =Vendorpackages::deleteAll(['id' => $data['packid']]);
	        }
    }

    public function actionPackageupdate()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $pack_id=$data['packid'];
            $output= Package::find()->where(['id'=>$pack_id])->asArray()->all();
            foreach ($output as $o) {
                $id = $o['package_id'];
                $start = $o['package_start_date'];
                $start = date('Y-m-d', strtotime($start));
                $end = $o['package_end_date'];
                $end = date('Y-m-d', strtotime($end));
            }
            echo json_encode(array('id' => $id, 'start' => $start, 'end' => $end));
            exit;
        }
    }

    /**
     * Finds the Package model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     *
     * @return Package the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Package::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionBlock()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $status = ($data['status'] == 'Active' ? 'Deactive' : 'Active');
            Package::updateAll(['package_status' => $status],'package_id= '.$data['id']);

            if ($status == 'Active') {
                return \yii\helpers\Url::to('@web/uploads/app_img/active.png');
            } else {
                return \yii\helpers\Url::to('@web/uploads/app_img/inactive.png');
            }
        }
    }
}
?>
