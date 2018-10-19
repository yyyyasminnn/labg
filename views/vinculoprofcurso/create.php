<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VinculoProfCurso */

$this->title = 'Create Vinculo Prof Curso';
$this->params['breadcrumbs'][] = ['label' => 'Vinculo Prof Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vinculo-prof-curso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
