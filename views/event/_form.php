<?php

    use kartik\datetime\DateTimePicker;
    use kartik\file\FileInput;
    use yii\bootstrap\Modal;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $model app\models\Event */
    /* @var $form yii\widgets\ActiveForm */

    $this->registerJsFile('/web/js/event.js', ['depends' => 'app\assets\AppAsset']);
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'event_type_id')
             ->dropDownList($model->getTypes(), ['prompt' => 'Выберите тип']) ?>

    <?= $form->field($model, 'title')
             ->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'photo')
        //             ->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'imageFiles')
             ->widget(FileInput::classname(), [
                 'options' => ['accept' => 'image/*', 'multiple' => true],
             ]) ?>

    <?= $form->field($model, 'desc')
             ->textarea(['rows' => 6]) ?>

    <?= Html::label('Выбор организаторов', 'organizators') ?>
    <?= Html::dropDownList('organizators', '', $model->getAllOrganizators(), ['id' => 'organizators', 'prompt' => 'selected']) ?>

    <?= $form->field($model, 'organizators')
             ->checkboxList($model->getOrganizators()) ?>

    <div id="particip"><div class="form-inline " >
        <?= $form->field($model, 'particip[name][]')
                 ->textInput()
                 ->label('Particip') ?>
        <?= $form->field($model, 'particip[user_id][]')
                 ->dropDownList($model->getOrganizators())
                 ->label('user') ?>
            <?= Html::button('Добавить должность', ['id' => 'btn_addPartic', 'class' => 'btn btn-success']) ?>
    </div></div>
    <?= $form->field($model, 'condition')
             ->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_start')
             ->widget(DateTimePicker::className(), [
                 'language' => 'ru',
                 'size'     => 'ms',
             ]) ?>
    <?= $form->field($model, 'date_end')
             ->widget(DateTimePicker::className(), [
                 'language' => 'ru',
                 'size'     => 'ms',
             ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
