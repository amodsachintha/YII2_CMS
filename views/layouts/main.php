<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
            selector:'textarea',
            plugins : 'advlist autolink link lists print preview',
        });</script>
</head>
<body>
<?php $this->beginBody() ?>

<?php
    if(!Yii::$app->user->isGuest){
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        $r_str = "";
        foreach ($roles as $role){
            $r_str .= "[".$role->name."]";
        }
    }

?>

    <div class="container">
        <?php
        NavBar::begin([
            'brandLabel' => '<span><img src="/img/logo2.png" width="35">'.'<strong> CMS</strong></span>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-default',
                'style'=> 'background-color: white; border:none; padding-bottom:7px;'
            ],
            'innerContainerOptions' => ['class' => 'container-fluid',]
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'encodeLabels' => false,
            'items' => [
                Yii::$app->user->isGuest ? '<li style="margin-top: 15px"<span class="badge">guest</span></li>' :
                    '<li style="margin-top: 15px">@'.Yii::$app->user->identity->username.' <span class="label label-success">'.$r_str.'</span></li>'
            ],
        ]);
        NavBar::end();
        ?>

        <?= Breadcrumbs::widget([
                'options' => ['class' => 'breadcrumb','style'=>'background-color:white'],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <div class="row">
            <div class="col-sm-2" style="text-align: center;">
                <div class="list-group" style="box-shadow: 2px 12px 30px -15px rgba(133,133,133,1);">
                    <a href="/" class="list-group-item <?= Yii::$app->request->url === '/site/index' || Yii::$app->request->url == '/'  ? 'active': '' ?>">Home</a>
                    <a href="/site/docs" class="list-group-item <?= strpos(Yii::$app->request->url, 'site/docs') ? 'active': '' ?>">Documents</a>
                    <a href="/site/help" class="list-group-item <?= Yii::$app->request->url === '/site/help' ? 'active': '' ?>">Help (API)</a>
                    <?=
                    Yii::$app->user->isGuest ? '<a href="/site/login" class="list-group-item list-group-item-success">Login</a>' :
                        Html::beginForm(['/site/logout'], 'post').
                         Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'list-group-item list-group-item-danger logout', 'style'=>'text-align: center']
                        ).
                        Html::endForm();
                    ?>
                </div>
                <?php

                if(Yii::$app->user->isGuest){

                }else{
                    $roleArray = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                    foreach ($roleArray as $roleItem){
                        $role = $roleItem->name;
                    }
                    if($role === 'sadmin'){
                        $url = Yii::$app->basePath.'/views/layouts/sidenav_sadmin.php';
                        include $url;
                    }
                    elseif ($role === 'editor'){
                        $url = Yii::$app->basePath.'/views/layouts/sidenav_editor.php';
                        include $url;
                    }
                    elseif ($role === 'media_editor'){
                        $url = Yii::$app->basePath.'/views/layouts/sidenav_media_editor.php';
                        include $url;
                    }
                    else{
                        echo "ROLE ERROR!";
                    }
                    $url = Yii::$app->basePath.'/views/layouts/userinfo.php';
                    include $url;
                }

                ?>
            </div>
            <div class="col-sm-10">
                <?= $content ?>
            </div>
        </div>


        <footer class="footer" style="background-color: white">
            <div class="container">
                <p class="pull-left">&copy; Sachith <?= date('Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>
    </div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
