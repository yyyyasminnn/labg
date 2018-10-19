<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Curso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instituicao_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unid_bloco_id')->textInput() ?>

    <?= $form->field($model, 'curso_original')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'ativo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
