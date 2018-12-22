<?php

namespace app\controllers;

use Yii;
use app\models\Media;
use app\models\searches\MediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * MediaController implements the CRUD actions for Media model.
 */
class MediaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','view','create','update','delete'],
                        'roles' => ['editor','sadmin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','view','create','update'],
                        'roles' => ['media_editor'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Media models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Media model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Media model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Media();

        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post('Media');
            $file = UploadedFile::getInstance($model,'url');
            $fileName = 'uploads/' . md5(time()) .'-'.$file->baseName.'.' . $file->extension;
            $file->saveAs($fileName);
            $model->url = '/'.$fileName;
            $model->document_id = $data['document_id'];
            $model->description = $data['description'];

            $date = new \DateTime();
            $model->created_at = $date->format('Y-m-d H:i:s');
            $model->updated_at = $date->format('Y-m-d H:i:s');

            if ($model->save()) {
                Yii::$app->session->setFlash('success',   'Media created!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Media model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post('Media');
            $file = UploadedFile::getInstance($model,'url');
            $fileName = 'uploads/' . md5(time()) .'-'.$file->baseName.'.' . $file->extension;
            $file->saveAs($fileName);
            $model->url = '/'.$fileName;
            $model->document_id = $data['document_id'];
            $model->description = $data['description'];

            $date = new \DateTime();
            $model->updated_at = $date->format('Y-m-d H:i:s');

            if ($model->save()) {
                Yii::$app->session->setFlash('success',   'Media updated!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Media model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        unlink(Yii::$app->basePath . '/web/' .$model->url);
        Yii::$app->session->setFlash('success',   'Media deleted from disk!');
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Media model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Media the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Media::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
