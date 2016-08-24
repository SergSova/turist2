<?php

    //    use kartik\datetime\DateTimePicker;
    //    use kartik\file\FileInput;
    use yii\bootstrap\Modal;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $model app\models\Event */
    /* @var $form yii\widgets\ActiveForm */

    $this->registerJsFile('/web/js/event.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('/web/js/eventCondition.js', ['depends' => 'app\assets\AppAsset']);
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'event_type_id')
             ->dropDownList($model->getTypes(), ['prompt' => 'Выберите тип']) ?>

    <?= $form->field($model, 'title')
             ->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo')
             ->textarea(['rows' => 6]) ?>

    <!--    --><? //= $form->field($model, 'imageFiles')
        //             ->widget(FileInput::classname(), [
        //                 'options' => ['accept' => 'image/*', 'multiple' => true],
        //             ]) ?>

    <?= $form->field($model, 'desc')
             ->textarea(['rows' => 6]) ?>

<!--    участинки-->
    <div class="form-group">
        <?php if($model->particEvents){echo '<label class="control-label" for="particEvent">Участники</label>';}?>
        <div class="particEvent col-lg-12" id="particEvent"></div>
    </div>
    <?php
        foreach($model->getParticToEvent() as $key => $item):?>
            <script>
                if(!particEvent){
                    var particEvent = {};
                }
                particEvent[<?=$key?>]={};
                particEvent[<?=$key?>]['<?=$item['username']?>']='<?=$item['foto']?>';
            </script>
        <?php endforeach; ?>
<!--    участинки-->

    <div class="form-group">
        <?= Html::button('Добавить организаторов', ['class' => 'btn btn-success btn_addOrganisator']) ?>
    </div>

    <div class="form-group">
        <?= Html::button('Добавить должность', ['class' => 'btn btn-success btn_addPartic']) ?>
    </div>
    <div id="particip"></div>

    <!-- condition-->
    <?= $form->field($model, 'condition')
             ->hiddenInput()
             ->label(false) ?>
    <div class="form-group">
        <?= Html::button('Добавить требование', ['id' => 'btn_addContition', 'class' => 'btn btn-success']) ?>
    </div>
    <div class="condition"></div>
    <!-- end condition-->

    <?= $form->field($model, 'date_start')
        /*->widget(DateTimePicker::className(), [
            'language' => 'ru',
            'size'     => 'ms',
        ])*/ ?>
    <?= $form->field($model, 'date_end')
        /*->widget(DateTimePicker::className(), [
            'language' => 'ru',
            'size'     => 'ms',
        ])*/ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
