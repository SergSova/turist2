<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\EventSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'event_type_id') ?>

    <?= $form->field($model, 'creator_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'organizators') ?>

    <?php // echo $form->field($model, 'particip') ?>

    <?php // echo $form->field($model, 'condition') ?>

    <?php // echo $form->field($model, 'date_start') ?>

    <?php // echo $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'date_creation') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
