<?php

    /* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;

    /* @var $model app\models\search\EventSearch */
?>

<div class="event-search">

    <?php $form = ActiveForm::begin([
                                        'action' => ['index'],
                                        'method' => 'get',
                                    ]); ?>


    <?= $form->field($model, 'event_type_id') ?>

    <?= $form->field($model, 'creator_id') ?>

    <?= $form->field($model, 'title') ?>

    <?php //echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'organizators') ?>

    <?php // echo $form->field($model, 'particip') ?>

    <?php // echo $form->field($model, 'condition') ?>

    <?php // echo $form->field($model, 'date_start') ?>

    <?php // echo $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'date_creation') ?>

    <?php echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'track_path') ?>

    <?php // echo $form->field($model, 'people_count') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
