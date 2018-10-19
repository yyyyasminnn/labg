<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VinculoAlunoCurso */

$this->title = 'Update Vinculo Aluno Curso: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vinculo Aluno Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vinculo-aluno-curso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
