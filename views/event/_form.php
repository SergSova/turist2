<?php

    use app\widgets\FileManagerWidget\FileManagerWidget;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use yii\helpers\Url;

    /**
     * @var $this  yii\web\View
     * @var $model app\models\Event
     * @var $form  yii\widgets\ActiveForm
     */
    $this->registerJsFile('/web/js/event.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('/web/js/eventCondition.js', ['depends' => 'app\assets\AppAsset']);

    $initJS = <<<JS
$('select').material_select();
$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
 var particEvent = JSON.parse('{$model->getParticToEvent()}');
 console.log(particEvent);
JS;
    $this->registerJs($initJS, 3);

?>

<div class="event-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if($model->isNewRecord || Yii::$app->user->can('upupdateOwnPost', ['event' => $model])): ?>

        <?= $form->field($model, 'event_type_id')
                 ->dropDownList($model->getTypes(), ['prompt' => 'Выберите тип', 'class' => 'dropdown-button']) ?>

        <?= $form->field($model, 'title')
                 ->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'desc')
                 ->textarea(['rows' => 6]) ?>

        <!--    участинки-->
        <div class="form-group">
            <?php if($model->particEvents): ?>
                <label class="control-label" for="particEvent">Участники</label>
            <?php endif; ?>
            <div class="particEvents col-lg-12" id="particEvents"></div>
        </div>
        <!-- end участинки-->

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

        <?= Html::activeInput('datetime-local', $model, 'date_start', ['class' => 'datepicker']) ?>
        <?= Html::activeInput('datetime-local', $model, 'date_end') ?>

    <?php endif; ?>

    <!-- add photo-->
    <?php if(!$model->isNewRecord): ?>
        <?php if(Yii::$app->user->can('updateOwnPost', ['event' => $model]) || Yii::$app->user->can('addPhoto', ['event' => $model])): ?>
            <?= Html::activeHiddenInput($model, 'photo', ['id' => 'event-photo']) ?>
            <?= FileManagerWidget::widget([
                                              'uploadUrl'     => Url::to(['event-upload-photo']),
                                              'removeUrl'     => Url::to(['event-remove-photo']),
                                              'maxFiles'      => 20,
                                              'targetInputId' => 'event-photo',
                                              'files'         => $model->photo
                                          ]) ?>
        <?php endif; ?>
    <?php endif; ?>
    <!-- end add photo-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
