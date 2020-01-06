<?php
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<!--main content start-->
<div class="main-content" style= "margin-top: 0px; background: url(/public/images/1.jpg); background-size: 100%;">
    <div  class="container" >
        <div class="row">
           
            <div class="col-md-8" style = "margin-top: 20px;">
<?php foreach($articles as $article):?>
    <article class="post" >
                    <div class="post-thumb">
                        <a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]);?>"><img src="<?= $article->getImage();?>" alt=""></a>

                        <a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]);?>" class="post-thumb-overlay text-center">
                            <div class="text-uppercase text-center">Перегляд</div>
                        </a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="<?= Url::toRoute(['site/category', 'id'=>$article->category->id]);?>"> <?= $article->category->title; ?></a></h6>

                            <h1 class="entry-title"><a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]);?>"><?= $article->title ?></a></h1>
                        </header>
                        <div class="entry-content">
                            <p><?= $article->description ?>
                            </p>

                            <div class="btn-continue-reading text-center text-uppercase">
                                <a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]);?>" class="more-link">Продовження</a>
                            </div>
                        </div>
                        <div class="social-share">
                            <span class="social-share-title pull-left text-capitalize">Автор <a style = "color: #FF8C00;" href="#"><?= $article->author->name;?></a> написав(-ла) <a style = "color: #3CB371;"><?= $article->getDate(); ?></a></span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li><?= (int) $article->viewed ?>
                            </ul>
                        </div>
                    </div>
                </article>
<?php endforeach;?>
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
</div>
<!-- end main content-->
