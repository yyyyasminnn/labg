<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CursoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'ppc') ?>

    <?= $form->field($model, 'instituicao_id') ?>

    <?php // echo $form->field($model, 'unid_bloco_id') ?>

    <?php // echo $form->field($model, 'curso_original') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'ativo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
