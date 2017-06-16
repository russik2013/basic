<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;

?>

<div class="film-add">

    <?php $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

    <?=$f->field($form,'title')->textInput(['value' => $title]);?>
    <img src="/<?=$image?>" alt="" width="200" height="250">
    <?=$f->field($form,'image')->fileInput();?>
    <?php for($i = 0; $i < count($gallery); $i++) {?>
        <img src="/<?=$gallery[$i]->images_url?>" alt="" width="200" height="250">
    <?php }?>
    <?=$f->field($form,'gallery[]')->fileInput(['multiple' => 'multiple']) ?>
    <?=$f->field($form,'trailer_url')->textInput(['value' => $trailer_url]);?>
    <?=$f->field($form,'film_type')->checkboxList(['2D' => '2D','3D' => '3D','IMAX' => 'IMAX']);?>
    <?=$f->field($form,'seo_url')->textInput(['value' => $seo_url]);?>
    <?=$f->field($form,'seo_title')->textInput(['value' => $seo_title]);?>
    <?=$f->field($form,'seo_keywords')->textInput(['value' => $seo_keywords]);?>
    <?=$f->field($form,'seo_description')->textInput(['value' => $seo_description]);?>
    <?=Html::submitButton('Enter');?>
    <?php ActiveForm::end();?>
</div>
