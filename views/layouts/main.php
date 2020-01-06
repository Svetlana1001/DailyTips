<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\PublicAsset;
use yii\helpers\Url;

PublicAsset::register($this);// подключение ресурсов
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

<!--шапка start-->
<nav class="navbar main-menu navbar-default"style = "margin-bottom: 0px;">
    <div class="container" >
        <div class="menu-content" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div style="height: 70px; " class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/site"><img src="/public/images/logo1.jpg" alt="" width="200" height="50"></a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                 <div class="i_con">
                    <ul class="nav navbar-nav text-uppercase">
                        <?php if(Yii::$app->user->isGuest):?>
                            <li><a style = "margin-left: 50%; font-family: 'Times New Roman'; font-size: 18pt;" href="<?= Url::toRoute(['auth/login'])?>">Вхід</a></li>
                            <li><a style = " margin-left: 20%; font-family: 'Times New Roman'; font-size: 18pt;"  href="<?= Url::toRoute(['auth/signup'])?>">Зареєструватися</a></li>
                        <?php else: ?>
                            <?= Html::beginForm(['/auth/logout'], 'post')
                            . Html::submitButton(
                                'Вітаємо ' . Yii::$app->user->identity->name . '! (вихід)',
                                ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px;"]
                            )
                            . Html::endForm() ?>
                        <?php endif;?>
                    </ul>
                </div>

            </div>
            <!-- /.navbar-collapse -->
        </div>
    </div>
            <!-- /.container-fluid -->
</nav>
 
<?= $content ?>

<!--footer start-->

 <div class="footer-copy" style = "background:  #5F9EA0;">
        <div class="container" >
            <div class="row" >
                <div class="col-md-12" style="height: 20px;">
                    <div class="text-center">&copy; 2019 <a href="#"> DAILY_TIPS </a> <i
                            class="fa fa-heart"></i>  Виконали: <a href="https://www.facebook.com/svetochka.vakal">Sveta</a> та <a href="https://www.facebook.com/profile.php?id=100011350038176">Yulia</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
