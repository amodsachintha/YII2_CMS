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
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="/site/docs" method="GET">
                            <div class="row">
                                <div class="col-sm-2">
                                    <p style="font-size: x-large; text-align: center"><?= Html::encode($this->title) ?></p>
                                </div>
                                <div class="col-sm-6">
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
        echo "
              <div class='row'>
                <div class='panel panel-default'>
                   <div class='panel-heading'>
                <div class='panel-title'><strong><a href='/document/view?id=$post->id'> $post->title</a></strong></div>
                   </div>
                    <div class='panel-body'>
                        $content  <a href='/document/view?id=$post->id'>more...</a>
                    </div>
                    <div class='panel-footer'>
                        <div class='row'>
                            <div class='col-md-3'>Category: <span class='label label-default'> $category</span></div>
                            <div class='col-md-3'>author: <span class='label label-primary'> $author</span></div>
                            <div class='col-md-3'><i>created at: $post->created_at</i></div>
                            <div class='col-md-3' align='right'><a href='/document/view?id=$post->id' class='btn btn-success'>View Full</a></div>
                        </div>
                    </div>
                 </div>
              </div>
";
        $i++;
    }

    ?>

</div>
