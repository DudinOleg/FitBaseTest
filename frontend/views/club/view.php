<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Club $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Clubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="club-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'address:ntext',
            'created_at' => [
            'attribute' => 'created_at',
            'format' => ['datetime', 'php:Y-m-d H:i:s'],
            ],
            'created_by',
            'updated_at' => [
            'attribute' => 'updated_at',
            'format' => ['datetime', 'php:Y-m-d H:i:s'], 
            ],
            'updated_by',
            'deleted_at' => [
            'attribute' => 'deleted_at',
            'format' => ['datetime', 'php:Y-m-d H:i:s'],
            ],
            'deleted_by',
        ],
    ]) ?>

</div>
