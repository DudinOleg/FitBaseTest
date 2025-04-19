<?php

use app\models\Client;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var frontend\models\ClientSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Client', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'full_name',
            'gender',
            'birth_date',
            'created_at' => [
            'attribute' => 'created_at',
            'format' => ['datetime', 'php:Y-m-d H:i:s'],
            ],
            [
                'attribute' => 'clubs',
                'value' => function($model) {
                    return implode(', ', ArrayHelper::getColumn($model->clubs, 'name'));
                },
                'format' => 'raw',
                ],
            [

            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Client $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            }
            ],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
