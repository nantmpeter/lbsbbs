<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use app\models\Comment;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','update'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $page_size = 10;
        $lat = (float)(isset($_GET['lat'])?$_GET['lat']:0);
        $lon = (float)(isset($_GET['lon'])?$_GET['lon']:0);
        $sql = 'SELECT * from (SELECT id,title,lon,lat,reply_at,create_at, ROUND(6378.138*2*ASIN(SQRT(POW(SIN((:lat*PI()/180-lat*PI()/180)/2),2)+COS(:lat*PI()/180)*COS(lat*PI()/180)*POW(SIN((:lon*PI()/180-lon*PI()/180)/2),2)))*1000) AS d FROM post ORDER BY d) a where d<300 order by reply_at desc,create_at desc';
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM ('.$sql.') a',[':lat'=>$lat,':lon'=>$lon])->queryScalar();
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $page_size]);
        $dataProvider = new SqlDataProvider([
                'sql'=>$sql,
                'params'=>[':lat'=>$lat,':lon'=>$lon],
                'totalCount' => $count,
                'pagination' => [
                    'pageSize' => $page_size,
                ],
            ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'pages' => $pages
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $page_size = 10;
        $model = new Comment();
        $pages = new Pagination(['totalCount' =>$model->find()->where(['post_id'=>$id])->count(), 'pageSize' => $page_size]);
        $dataProvider = new ActiveDataProvider([
        'query' => $model->find()->where(['post_id'=>$id]),
        'pagination' => [
                'pagesize' => $page_size,
         ]
       ]);
        return $this->render('view', [
            'data' => $dataProvider,
            'model' => $this->findModel($id),
            'left_btn' => 'home',
            'pages' => $pages
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $model->create_at = $model->update_at = $model->reply_at = time();
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
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->update_at = time();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
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
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
