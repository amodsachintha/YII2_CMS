<div class="list-group" style="box-shadow: 2px 12px 30px -15px rgba(133,133,133,1);">
    <li class="list-group-item">
        User
    </li>
    <li class="list-group-item">
        <small><kbd><?= \app\models\User::findOne(Yii::$app->user->id)->email ?></kbd></small>
        <small><kbd><?= $_SERVER['REMOTE_ADDR'] ?></kbd></small>
        <small><kbd><?= $_SERVER['REQUEST_METHOD'] ?></kbd></small>
        <small><kbd><?= $_SERVER['SERVER_PROTOCOL'] ?></kbd></small>
    </li>
</div>