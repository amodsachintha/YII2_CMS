<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Category;

$this->title = 'Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <div class="row">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" style="box-shadow: 2px 12px 30px -15px rgba(133,133,133,1);">
                    <div class="panel-heading" style="background-color: white">
                        <p style="font-size: x-large; text-align: center; margin-top: -4px; margin-bottom: -5px"><?= Html::encode($this->title) ?></p>
                    </div>
                    <div class="panel-body">
                        <form action="/site/docs" method="GET">
                            <div class="row">
                                <div class="col-sm-3">
                                    <form>
                                        <select id="target" accesskey="E" onchange="goToNewPage()" class="form-control form-control-sm">
                                            <?php
                                            foreach (Category::find()->orderBy('title')->all() as $category){
                                                if(isset($_GET['category'])){
                                                    if($category->title == $_GET['category']){
                                                        $selected = "selected";
                                                    }
                                                    else{
                                                        $selected = "";
                                                    }
                                                }else{
                                                    $selected = "";
                                                }
                                                $catTitle = urlencode($category->title);
                                                echo "<option value='/site/docs?category=$catTitle' $selected>$category->title</option>";
                                            }
                                            ?>
                                        </select>
                                    </form>
                                </div>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <?php
                                        $data = ArrayHelper::map(Category::find()
                                            ->orderBy('title')
                                            ->asArray()
                                            ->all(), 'title', 'title');

                                        if (isset($cats_from_get)) {
                                            if ($cats_from_get == null) {
                                                $values = null;
                                            } else {
                                                $values = $cats_from_get;
                                            }
                                        } else {
                                            $values = null;
                                        }
                                        echo Select2::widget([
                                            'name' => 'cat',
                                            'value' => $values,
                                            'data' => $data,
                                            'options' => [
                                                'placeholder' => 'Select categories..',
                                                'multiple' => true
                                            ],
                                            'pluginOptions' => [
                                                'tags' => true,
                                                'tokenSeparators' => [',', ' '],
                                                'maximumInputLength' => 10
                                            ],
                                        ]);
                                        ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input id="search" name="search" type="text" class="form-control" placeholder="Search.." value="<?= isset($search) ? $search : '' ?>">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" type="submit">Search</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($count) && isset($message)) {
        echo "
            <div class='row'>
                $message
            </div>
            ";
    }
    ?>

    <?php
    $i = 1;
    foreach ($posts as $post) {
        $content = \yii\helpers\HtmlPurifier::process(str_split($post->content, 500)[0]);
        $author = $post->user->username;
        $category = $post->category->title;
        $urlEncodedCat = urlencode($post->category->title);
        try {
            $created_at = \Yii::$app->formatter->asDatetime($post->created_at);
        }catch (\yii\base\InvalidConfigException $exception){
            $created_at = "";
        }
        echo "
              <div class='row'>
                <div class='panel panel-default'>
                   <div class='panel-heading'>
                <div class='panel-title'><strong><a href='/document/view?id=$post->id'> $post->title</a></strong></div>
                   </div>
                    <div class='panel-body'>
                        $content  <a href='/document/view?id=$post->id'>more...</a>
                    </div>
                    <div class='panel-footer' style='background-color: white'>
                        <div class='row'>
                            <div class='col-md-3'><a href='/site/docs?category=$urlEncodedCat'><button type='button' class='btn btn-default btn-xs'>
                                            <span class='glyphicon glyphicon-tags' aria-hidden='true'></span> $category
                                    </button></a></div>
                            <div class='col-md-3'><span class='glyphicon glyphicon-user'></span> <span class='badge' style='background-color: #5cb85c'> $author</span></div>
                            <div class='col-md-3'><small>$created_at</small></div>
                            <div class='col-md-3' align='right'><a href='/document/view?id=$post->id' class='btn btn-primary btn-sm'>View Full</a></div>
                        </div>
                    </div>
                 </div>
              </div>
";
        $i++;
    }

    ?>

    <script>
        function goToNewPage() {
            if(document.getElementById('target').value){
                window.location.href = document.getElementById('target').value;
            }
        }
    </script>

</div>
