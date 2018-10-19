<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VinculoProfCursoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vinculo Prof Cursos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vinculo-prof-curso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vinculo Prof Curso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'situacao_id',
            'curso_id',
            'prof_id',
            'created',
            //'updated',
            //'ativo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
