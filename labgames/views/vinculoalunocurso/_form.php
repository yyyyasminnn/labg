<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VinculoAlunoCurso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vinculo-aluno-curso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'situacao_id')->textInput() ?>

    <?= $form->field($model, 'curso_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aluno_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'ativo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
