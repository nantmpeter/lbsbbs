<?php

namespace app\controllers;

use Yii;
use app\models\Point;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\SqlDataProvider;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * PointController implements the CRUD actions for Point model.
 */
class PointController extends Controller
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
     * Lists all Point models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Point::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Point model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $page_size = 10;
        $point = $this->findModel($id);
        $lat = $point->lat;
        $lon = $point->lon;

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM post where point_id = :id',[':id'=>$id])->queryScalar();
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $page_size]);
        $dataProvider = new SqlDataProvider([
                'sql'=>'SELECT * FROM post where point_id = :id',
                'params'=>[':id'=>$id],
                'totalCount' => $count,
                'pagination' => [
                    'pageSize' => $page_size,
                ],
            ]);

        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'pages' => $pages
        ]);
        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
    }

    /**
     * Creates a new Point model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Point();
        $model->create_at = time();
        $model->user_id = User::getCurrentId();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Point model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Point model.
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
     * Finds the Point model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Point the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Point::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
