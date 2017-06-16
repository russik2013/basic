<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;

?>
<div class="film-add">

    <?php $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

    <?=$f->field($form,'title');?>
    <?=$f->field($form,'description')->textarea(['rows' => 2, 'cols' => 5]);?>
    <?=$f->field($form,'image')->fileInput();?>
    <?=$f->field($form,'gallery[]')->fileInput(['multiple' => 'multiple']) ?>
    <?=$f->field($form,'trailer_url');?>
    <?=$f->field($form,'film_type')->checkboxList(['2D' => '2D','3D' => '3D','IMAX' => 'IMAX']);?>
    <?=$f->field($form,'seo_url');?>
    <?=$f->field($form,'seo_title');?>
    <?=$f->field($form,'seo_keywords');?>
    <?=$f->field($form,'seo_description');?>
    <?=Html::submitButton('Enter');?>
    <?php ActiveForm::end();?>
</div>
