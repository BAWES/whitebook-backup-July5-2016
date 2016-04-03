<?php

namespace backend\modules\vendor\controllers;

use Yii;
use backend\models\vendorlocation;
use backend\models\vendorlocationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Country;
use backend\models\Location;
use backend\models\City;
use yii\helpers\ArrayHelper;

/**
 * VendorlocationController implements the CRUD actions for vendorlocation model.
 */
class VendorlocationController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all vendorlocation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new vendorlocationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single vendorlocation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new vendorlocation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new vendorlocation();

        if ($model->load(Yii::$app->request->post())) {
            
            $selected_areas = implode(',',$_POST['location']);
            foreach ($_POST['location'] as $key => $value) {
                 $get_city_id = Location::find()->select('city_id')->where(['id'=>$value])->one();
                 
                 $vendor_location = Yii::$app->db->createCommand()
                        ->insert('whitebook_vendor_location', [
                                'vendor_id' => Yii::$app->user->getId(),
                                'city_id' =>$get_city_id['city_id'],
                                'area_id'=>$value])
                        ->execute(); 
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else 
        {
            $countries=Country::find()->where(['country_id'=>136])->all();
            $city_tbl = City::find()->where(['country_id' => 136])->all();
            $city=ArrayHelper::map($city_tbl,'city_id','city_name');    

            $cities = Yii::$app->db->createCommand('SELECT * FROM whitebook_city as wc JOIN whitebook_location as wl ON wc.city_id = wl.city_id 
                    where wc.status = "Active" and wl.trash = "Default" and wl.status = "Active" group by wl.city_id')->queryAll();           
            
            $country=ArrayHelper::map($countries,'country_id','country_name');
            return $this->render('create', [
                'model' => $model,'country' => $country, 'cities'=>$cities,'city'=>$city,      
            ]);
        }
    }

    /**
     * Updates an existing vendorlocation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $cities = Yii::$app->db->createCommand('SELECT * FROM whitebook_city as wc JOIN whitebook_vendor_location as wvl ON wc.city_id = wvl.city_id 
        where wc.status = "Active"  group by wvl.city_id')->queryAll(); 
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $countries=Country::find()->all();          
            $country=ArrayHelper::map($countries,'country_id','country_name');
            $city_all=City::find()->all();          
            $city=ArrayHelper::map($city_all,'city_id','city_name');            
            return $this->render('update', [
                'model' => $model,'city' => $city, 'country' => $country, 'cities' => $cities, 
            ]);
        }
    }

    public function actionEdit()
    {
        $model= new Vendorlocation;

         if ($model->load(Yii::$app->request->post())) {            

            if(empty($_POST['location']))
            {
                Vendorlocation::deleteAll('vendor_id = :vendor_id', [':vendor_id' => 0]); // this is dummy record 
                Vendorlocation::deleteAll('vendor_id = :vendor_id', [':vendor_id' => Yii::$app->user->getId()]);
            }
            else 
            {

            $selected_areas = implode(',',$_POST['location']);
            Vendorlocation::deleteAll('vendor_id = :vendor_id', [':vendor_id' => Yii::$app->user->getId()]);
            
            foreach ($_POST['location'] as $key => $value) {
                 $get_city_id = Location::find()->select('city_id')->where(['id'=>$value])->one();
      
                $vendor_location = Yii::$app->db->createCommand()
                    ->insert('whitebook_vendor_location', [
                            'vendor_id' => Yii::$app->user->getId(),
                            'city_id' =>$get_city_id['city_id'],
                            'area_id'=>$value])
                    ->execute(); 

                }

            $model->save();
            }
            Vendorlocation::deleteAll('vendor_id = :vendor_id', [':vendor_id' => 0]); // this is dummy record 
            echo Yii::$app->session->setFlash('success', "Area info updated successfully!");
            return $this->redirect(['edit']);
            
        }

        $cities = Yii::$app->db->createCommand('SELECT * FROM whitebook_city as wc JOIN whitebook_location as wl ON wc.city_id = wl.city_id 
                    where wc.status = "Active" and wl.trash = "Default" and wl.status = "Active" group by wl.city_id')->queryAll();           
       
        
            return $this->render('edit', [
                'model' => $model, 'cities' => $cities, 
            ]);
    }

    /**
     * Deletes an existing vendorlocation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the vendorlocation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return vendorlocation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = vendorlocation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}