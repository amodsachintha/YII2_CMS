<?php

namespace app\controllers;

use app\models\Category;
use app\models\Document;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\db\Expression;
use yii\helpers\HtmlPurifier;

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

        if (Document::find()->count() >= 3) {
            $documents = Document::find()
                ->orderBy(new Expression('rand()'))
                ->limit(3)
                ->all();
            $exist = true;
        } else {
            $documents = null;
            $exist = false;
        }

        return $this->render('index', [
            'documents' => $documents,
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

    public function actionDocs()
    {
        $search = YII::$app->request->get('search');
        $category = Yii::$app->request->get('cat');

        $categoryFromButton = Yii::$app->request->get('category');
        if ($categoryFromButton !== '' && isset($categoryFromButton)) {
            $documents = Document::find()
                ->where(['category.title' => $categoryFromButton])
                ->joinWith(['category'])->all();
            $count = Document::find()
                ->where(['category.title' => $categoryFromButton])
                ->joinWith(['category'])->count();

            if ($count > 0) {
                $message = "<div class='alert alert-success alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                            <strong>" . $count . "</strong> Documents(s) in " . $categoryFromButton . "</div>";
            } else {
                $message = "<div class='alert alert-danger alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                            No posts  posts in <strong>" . HTMLPurifier::process($categoryFromButton) . "</strong>
                            </div>";
            }

            return $this->render('docs', [
                'posts' => $documents,
                'count' => $count,
                'message' => $message,
            ]);
        }

        if ($search !== '' && isset($search)) {
            if (is_null($category)) {
                $cats_from_get = 0;
                $category = ArrayHelper::getColumn(Category::find()->asArray()->all(), 'title');
            } else {
                $cats_from_get = 1;
            }

            $documents = Document::find()
                ->where(['category.title' => $category])
                ->andWhere(['OR', ['LIKE', 'document.title', $search], ['LIKE', 'document.content', $search]])
                ->joinWith(['category'])->all();

            $count = Document::find()
                ->where(['category.title' => $category])
                ->andWhere(['OR', ['LIKE', 'document.title', $search], ['LIKE', 'document.content', $search]])
                ->joinWith(['category'])->count();

            if ($count > 0) {
                $message = "<div class='alert alert-success alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                            <strong>" . $count . "</strong> result(s) found!</div>";
            } else {
                $message = "<div class='alert alert-danger alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                            No posts matching posts for <strong>" . $search . "</strong> found!
                            </div>";
            }
            return $this->render('docs', [
                'posts' => $documents,
                'search' => $search,
                'count' => $count,
                'message' => $message,
                'cats_from_get' => $cats_from_get == 0 ? null : $category,

            ]);
        }

        return $this->render('docs', [
            'posts' => Document::find()->all()
        ]);

    }

    public function actionHelp()
    {
        return $this->render('help');
    }
}
