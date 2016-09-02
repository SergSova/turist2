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
    selectYears: 15, // Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd'
  });
 var particEvent = JSON.parse('{$model->getParticToEvent()}');
 console.log(particEvent);
JS;
    $this->registerJs($initJS, 3);

?>

<div class="event-form">
    <div class="card">
        <div class="card-content">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if($model->isNewRecord || Yii::$app->user->can('upupdateOwnPost', ['event' => $model])): ?>
        <div class="row">
            <div class="col s9">
                <?= $form->field($model, 'event_type_id')
                    ->dropDownList($model->getTypes(), ['prompt' => 'Выберите тип', 'class' => 'dropdown-button']) ?>

                <?= $form->field($model, 'title')
                    ->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'desc')
                    ->textarea(['rows' => 4]) ?>
                <div class="row">
                    <div class="col s3">
                        <div class="input-field">
                        <?= Html::activeInput('date', $model, 'date_start', ['class' => 'datepicker']) ?>
                        <label for="event-date_start">Дата старта</label>
                        </div>
                    </div>
                    <div class="col s3">
                        <div class="input-field">
                        <?= Html::activeInput('text', $model, 'time_start', ['class' => 'timepicker']) ?>
                        <label for="event-time_start">Время старта</label>
                        </div>
                    </div>
                    <div class="col s3">
                        <div class="input-field">
                            <?= Html::activeInput('date', $model, 'date_end', ['class' => 'datepicker']) ?>
                            <label for="event-date_start">Дата окончания</label>
                        </div>
                    </div>
                    <div class="col s3">
                        <div class="input-field">
                            <?= Html::activeInput('text', $model, 'time_end', ['class' => 'timepicker']) ?>
                            <label for="event-time_start">Время окончания</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s6">
                        <div class="card-panel">
                            <?= Html::button('<i class="material-icons right">add</i>Организатор', ['class' => 'btn btn-success btn_addOrganisator fullWidth']) ?>
                        </div>
                    </div>
                    <div class="col s6">
                        <div class="card-panel">
                                <?= Html::activeHiddenInput($model, 'condition')?>
                                <?= Html::button('<i class="material-icons right">add</i>Требование', ['id' => 'btn_addContition', 'class' => 'btn btn-success fullWidth']) ?>
                            <div class="condition"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s3">
                <h5>Участники</h5>
                <?php
                if($model->particEvents):?>
                    <ul class="collection">
                    <?php
                    foreach ($model->particEvents as $person):
                    ?>
                        <li class="collection-item"><div class="chip">
                            <img src="<?= $person->user->getPhoto()?>" alt="Contact Person">
                            <?= $person->user->username?>
                        </div></li>
                <?php
                    endforeach; ?>
                    </ul>
                        <?php
                else: ?>
                    <div class="card-panel">Нет участников</div>
                <?php endif;?>
                <div class="particEvents col-lg-12" id="particEvents"></div>
            </div>
        </div>

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
    </div>

</div>
