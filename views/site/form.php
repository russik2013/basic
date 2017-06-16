<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;

?>
<?php if(!empty($name && $email)){ ?> <p><?=$name?><?=$email?></p> <?php  }?>
<div class="site-about">

    <?php $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

        <?=$f->field($form,'name');?>
        <?=$f->field($form,'email');?>
        <?=$f->field($form,'file')->fileInput();?>
        <?=Html::submitButton('Enter');?>
    <?php ActiveForm::end();?>
</div>
