<?php

namespace app\controllers;

use app\models\Document;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\db\Expression;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        if(Document::find()->count() >= 3){
            $documents = Document::find()
                ->orderBy(new Expression('rand()'))
                ->limit(3)
                ->all();
            $exist = true;
        }else{
            $documents = null;
            $exist = false;
        }

        return $this->render('index',[
            'documents'=> $documents,
            'exist' => $exist,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = false;
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionDocs(){
        $search = YII::$app->request->get('search');
        if($search !== '' && isset($search)){
            $posts = Document::find()
                ->where(['LIKE', 'title', $search])
                ->orWhere(['LIKE', 'content', $search])
                ->all();
            $count = Document::find()
                ->where(['LIKE', 'title', $search])
                ->orWhere(['LIKE', 'content', $search])->count();

            if($count > 0){
                $message = "<div class='alert alert-success alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                            <strong>".$count."</strong> result(s) found!</div>";
            }
            else{
                $message = "<div class='alert alert-danger alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                            No posts matching posts for <strong>".$search."</strong> found!
                            </div>";
            }
            return $this->render('docs',[
                'posts' =>  $posts,
                'search' => $search,
                'count' => $count,
                'message' => $message
            ]);
        }

        return $this->render('docs',[
            'posts' =>  Document::find()->all()
        ]);

    }

    public function actionHelp(){
        return $this->render('help');
    }
}
