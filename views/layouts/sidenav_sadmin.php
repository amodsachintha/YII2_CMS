<div class="list-group" style="box-shadow: 2px 12px 30px -15px rgba(133,133,133,1);">
    <a href="/document/index" class="list-group-item <?= strpos(Yii::$app->request->url, 'document') ? 'active': '' ?>">Documents<span class="badge"><?= \app\models\Document::find()->count()?></span></a>
    <a href="/media/index" class="list-group-item <?= strpos(Yii::$app->request->url, 'media') ? 'active': '' ?>">Media<span class="badge"><?= \app\models\Media::find()->count()?></span></a>
    <a href="/category/index" class="list-group-item <?= strpos(Yii::$app->request->url, 'category') ? 'active': '' ?>">Categories<span class="badge"><?= \app\models\Category::find()->count()?></span></a>
    <a href="/user/index" class="list-group-item <?= strpos(Yii::$app->request->url, 'user') ? 'active': '' ?>">Users<span class="badge"><?= \app\models\User::find()->count()?></span></a>
    <a href="/api/index" class="list-group-item <?= strpos(Yii::$app->request->url, 'api') ? 'active': '' ?>">API<span class="badge"><?= \app\models\Api::find()->count()?></span></a>
</div>