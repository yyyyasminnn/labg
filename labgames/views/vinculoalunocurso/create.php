<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VinculoAlunoCurso */

$this->title = 'Create Vinculo Aluno Curso';
$this->params['breadcrumbs'][] = ['label' => 'Vinculo Aluno Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vinculo-aluno-curso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
