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
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'На головну', 'url' => ['/site']],
            ['label' => 'Статті', 'url' => ['/admin/article/index']],
            ['label' => 'Коменти', 'url' => ['/admin/comment/index']],
            ['label' => 'Категорії', 'url' => ['/admin/category/index']],
            ['label' => 'Теги', 'url' => ['/admin/tag/index']]           
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container" >
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <img style = "width:50%; height:50%;" src='/public/images/2.jpg'>
        <?= $content ?>
        
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Daily TIPS <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<?php $this->registerJsFile('/ckeditor/ckeditor.js');?>
<?php $this->registerJsFile('/ckfinder/ckfinder.js');?>
<script>
    $(document).ready(function(){
        var editor = CKEDITOR.replaceAll();
        CKFinder.setupCKEditor( editor );
    })

</script>

</body>
</html>
<?php $this->endPage() ?>
