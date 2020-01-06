<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::dropDownList('tags', $selectedTags, $tags, ['class'=>'form-control', 'multiple'=>true])?>

    <div class="form-group">
        <?= Html::submitButton('Надіслати', ['class' => 'btn btn-success']) /* отправка в форму */?>
    </div>

    <?php ActiveForm::end(); ?>

</div>