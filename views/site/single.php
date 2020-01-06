<?php
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<!--main content start-->
<div class="main-content" style= "margin-top: 0px; background: url(/public/images/1.jpg); background-size: 100%;">
    <div class="container">
        <div class="row">
            <div class="col-md-8" style = "margin-top: 20px;">
                <article class="post">
                    <div class="post-thumb">
                        <a href="blog.html"><img src="<?= $article->getImage();?>" alt=""></a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="<?= Url::toRoute(['site/category', 'id'=>$article->category->id]);?>"> <?= $article->category->title; ?></a></h6>

                            <h1 class="entry-title"><a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]);?>"><?= $article->title ?></a></h1>

                        </header>
                        <div class="entry-content">
                            <?= $article->content ?>
                        </div>
                        <div class="social-share">
							<span
                                    class="social-share-title pull-left text-capitalize">Автор <a style = "color: #FF8C00;" href="#"><?= $article->author->name;?></a> написав(-ла) <a style = "color: #3CB371;"><?= $article->getDate(); ?></span>
                            </div>
                    </div>
                </article>
            <?= $this->render('/partials/comment',[
                'article'=>$article,
                'comments'=>$comments,
                'commentForm'=>$commentForm
            ])?>    

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