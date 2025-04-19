<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\ClientSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="client-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'gender')->radioList(
    ['Male' => 'Male', 'Female' => 'Female']
    ) ?>

    <?= $form->field($model, 'start_date')->input('date', [
        'max' => date('Y-m-d'),
    ]) ?>

    <?= $form->field($model, 'end_date')->input('date', [
        'max' => date('Y-m-d'),
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
