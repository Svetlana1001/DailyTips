<?php if(!empty($comments)):?>
                    <?php foreach($comments as $comment):?>
                        <div class="bottom-comment"><!--bottom comment-->
                    <div class="comment-text">
                        <a ><?= $comment->user->name;?></a>
                        <p class="comment-date">
                            <?= $comment->getDate(); ?>
                        </p>
                        <p class="para"><?= $comment->text; ?></p>
                    </div>
                        </div>
                        <!-- end bottom comment-->
                    <?php endforeach;?>
                <?php endif;?>

            <?php if(!Yii::$app->user->isGuest):?>   
                <div class="leave-comment"><!--leave comment-->
                    <h4>Залишити коментарій</h4>
<?php if(Yii::$app->session->getFlash('comment')):?>
<div class = "alert alert-success" role = "alert">
    <?= Yii::$app->session->getFlash('comment');?>
</div>
<?php endif;?>
<?php $form = \yii\widgets\ActiveForm::begin([
    'action'=>['site/comment', 'id'=>$article->id],
    'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>
                    <div class="form-group">
                            <div class="col-md-12">
<?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Місце для вашого коменту...'])->label(false)?>
                            </div>
                        </div>
                        <button type="submit" class="btn send-btn">Відправити </a>
                        <?php \yii\widgets\ActiveForm::end();?>
                    </div><!--end leave comment-->
                <?php endif;?>
            </div>