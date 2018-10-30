<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VarietySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Varieties');
$this->params['breadcrumbs'][] = $this->title;

$template = ' {view} ';

if (\Yii::$app->user->can('varietyRW')) {
    $template .= '{update} {delete} ';
}

?>
<div class="variety-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if (\Yii::$app->user->can('varietyRW')) {
            echo Html::a(Yii::t('app', 'Create Variety'), ['create'], ['class' => 'btn btn-success']);   
        }
        //<?= Html::a(Yii::t('app', 'Create Variety'), ['create'], ['class' => 'btn btn-success'])
         ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',

            ['class' => 'yii\grid\ActionColumn',
            'template' => $template
            ],
        ],
    ]); ?>
</div>
