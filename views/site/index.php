<?php
use yii\bootstrap\Carousel;

/* @var $this yii\web\View */

$this->title = 'SCMA';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="box-shadow: 2px 12px 30px -12px rgba(133,133,133,1);">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active" align="center">
                <img src="/img/slides/1.png" alt="Los Angeles" style="width:80%; height: 400px;">
            </div>

            <div class="item" align="center">
                <img src="/img/slides/2.png" alt="Chicago" style="width:80%; height: 400px;">
            </div>

            <div class="item" align="center">
                <img src="/img/slides/3.jpg" alt="New york" style="width:80%; height: 400px;">
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="body-content">

        <?php
        if($exist){
           echo " <div class='row' style='margin-top: 20px'>";
           foreach ($documents as $document){
               $content = \yii\helpers\HtmlPurifier::process(str_split($document->content,200)[0]);

               echo "<div class='col-lg-4'>
                <div class='panel panel-info' style='height: 210px; box-shadow: 2px 12px 30px -15px rgba(133,133,133,1);'>
                <div class='panel-heading' style='text-align: center'><strong>$document->title</strong></div>
                <div class='panel-body' style='max-height: 100px; overflow: auto'>$content</div>
                <div class='panel-footer'><p><a class='btn btn-default' href='/document/view?id=$document->id'>Read More &raquo;</a></p></div>
                </div>
            </div>";
           }
            echo " </div>";
        }



        ?>
    </div>
</div>
