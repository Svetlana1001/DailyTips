<?php
use yii\widgets\LinkPager;
use yii\helpers\Url;

?>
<!--main content start-->
<div class="main-content" style= "margin-top: 0px; background: url(/public/images/1.jpg); background-size: 100%;">
    <div class="container">
        <div class="row">
            <div class="col-md-8" style = "margin-top: 60px;">
                <?php foreach ($articles as $article):?>
                <article class="post post-list">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="post-thumb">
                                <a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]);?>"><img src="<?= $article->getImage();?>" alt="" class="pull-left"></a>

                                <a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]);?>" class="post-thumb-overlay text-center">
                                    <div class="text-uppercase text-center">Переглянути</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="post-content">
                                <header class="entry-header text-uppercase">
                                    <h6><a href="<?= Url::toRoute(['site/category', 'id'=>$article->category->id]);?>"> <?= $article->category->title?></a></h6>

                                    <h1 class="entry-title"><a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]);?>"><?= $article->title?></a></h1>
                                </header>
                                <div class="entry-content">
                                    <p><?= $article->description?>
                                    </p>
                                </div>
                                <div class="social-share" >
                                    <span class="social-share-title pull-left text-capitalize">Автор <a style = "color: #FF8C00;" href="#"><?= $article->author->name;?></a> написав(-ла) <a style = "color: #3CB371;"><?= $article->getDate(); ?></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>

                <!-- навигация по страницам(кнопочки страниц)-->
                <?php
                echo LinkPager::widget([
                    'pagination'=>$pagination,
                ]);?>

            </div>
           <?= $this->render('/partials/sidebar',[
            'popular'=>$popular,
            'recent'=>$recent,
            'categories'=>$categories
           ]);?>
            </div>
        </div>
    </div>

<!-- end main content-->