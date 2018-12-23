<?php

namespace app\controllers\api_scma;

use app\models\Api;
use app\models\Document;
use Yii;
use yii\web\Response;
use yii\web\Controller;

class DocumentController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $key = Yii::$app->request->get()['key'];
        } catch (\Exception $exception) {
            return ['msg' => ['401: Unauthorized', 'API Key not provided with request']];
        }

        $c = Api::find()->where(['key' => $key])->count();
        if (intval($c) === 0) {
            return ['msg' => '401: Unauthorized'];
        } else {
            $apiKey = Api::find()->where(['key' => $key])->one();
            $apiKey->hits = intval($apiKey->hits)+1;
            $apiKey->save();
            return Document::find()->with('category')->with('media')->asArray()->all();
        }
    }

    public function actionView($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $key = Yii::$app->request->get()['key'];
        } catch (\Exception $exception) {
            return ['msg' => ['401: Unauthorized', 'API Key not provided with request']];
        }

        $c = Api::find()->where(['key' => $key])->count();

        if (intval($c) === 0) {
            return ['msg' => '401: Unauthorized'];
        } else {
            $apiKey = Api::find()->where(['key' => $key])->one();
            $apiKey->hits = intval($apiKey->hits)+1;
            $apiKey->save();
            $document = Document::findOne($id);
            if (!$document) {
                return ['msg' => '404: Not Found'];
            }
            return [
                'document' => $document,
                'category' => $document->category,
                'media' => $document->media
            ];
        }
    }

}
