<?php

    use app\models\Friends;
    use app\widgets\FileManagerWidget\FileManagerWidget;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use macgyer\yii2materializecss\widgets\form\DatePicker;
    use macgyer\yii2materializecss\widgets\form\TimePicker;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Json;
    use yii\helpers\Url;

    /**
     * @var $this  yii\web\View
     * @var $model app\models\Event
     * @var $form  yii\widgets\ActiveForm
     */
    $this->registerJsFile('/web/js/eventCondition.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('/web/js/particip.js', ['depends' => 'app\assets\AppAsset']);
    $permissions = json_encode([
                                   1 => 'perm1',
                                   2 => 'perm2'
                               ]);
    $initJS = <<<JS
$('select').material_select();
var permissions = {$permissions};
  
 var particEvent = JSON.parse('{$model->getParticToEvent()}');
JS;
    $this->registerJs($initJS, 3);

?>

<div class="event-form">
    <?php
        if($model->hasErrors()){
            var_dump($model->getErrors());
        }
    ?>
    <div class="card">
        <div class="card-content">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?php if($model->isNewRecord || Yii::$app->user->can('updateOwnPost', ['event' => $model])): ?>
                <div class="row">
                    <div class="col s8">
                        <div class="row">
                            <div class="col s6">
                                <?= $form->field($model, 'event_type_id')
                                         ->dropDownList($model->getTypes(), [
                                             'prompt' => 'Выберите тип',
                                             'class' => 'dropdown-button'
                                         ]) ?>
                            </div>
                            <div class="col s6">
                                <?= $form->field($model, 'status')
                                         ->dropDownList([
                                                            'ACTIVE' => 'Активно',
                                                            'INACTIVE' => 'Неактивно',
                                                            'BLOCKED' => 'Заблокировано',
                                                            'FINISH' => 'Закончено'
                                                        ]) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'title')
                                 ->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'desc')
                                 ->textarea(['rows' => 2]) ?>
                        <div class="row">
                            <div class="col s6">
                                <h6 class="center-align">Старт</h6>
                                <div class="row">
                                    <div class="col s6">
                                        <div class="input-field">
                                            <?= DatePicker::widget([
                                                                       'model' => $model,
                                                                       'attribute' => 'date_start',
                                                                       'options' => [
                                                                           'id' => 'event-date_start',
                                                                           'readonly' => false
                                                                       ],
                                                                       'clientOptions' => [
                                                                           'format' => 'yyyy-mm-dd'
                                                                       ]
                                                                   ]) ?>
                                            <label for="event-date_start">Дата</label>
                                        </div>
                                    </div>
                                    <div class="col s6">
                                        <div class="input-field">
                                            <?= TimePicker::widget([
                                                                       'model' => $model,
                                                                       'attribute' => 'time_start',
                                                                       'options' => ['id' => 'event-time_start'],
                                                                   ]) ?>
                                            <label for="event-time_start">Время</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s6">
                                <h6 class="center-align">Финиш</h6>
                                <div class="row">
                                    <div class="col s6">
                                        <div class="input-field">
                                            <?= DatePicker::widget([
                                                                       'model' => $model,
                                                                       'attribute' => 'date_end',
                                                                       'options' => [
                                                                           'id' => 'event-date_end'
                                                                       ],
                                                                       'clientOptions' => [
                                                                           'format' => 'yyyy-mm-dd'
                                                                       ]
                                                                   ]) ?>
                                            <label for="event-date_end">Дата</label>
                                        </div>
                                    </div>
                                    <div class="col s6">
                                        <div class="input-field">
                                            <?= TimePicker::widget([
                                                                       'model' => $model,
                                                                       'attribute' => 'time_end',
                                                                       'options' => ['id' => 'event-time_end'],
                                                                       'clientOptions' => [
                                                                           'formatSubmit' => "H:i"
                                                                       ]
                                                                   ]) ?>
                                            <label for="event-time_end">Время</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6">
                                <div class="card">
                                    <?= Html::activeHiddenInput($model, 'particip') ?>
                                    <?= Html::button('<i class="material-icons right">add</i>Должности', [
                                        'class' => 'btn btn-success fullWidth',
                                        'id' => 'btn_addParticip'
                                    ]) ?>
                                    <div class="particip_list">
                                    </div>
                                </div>
                            </div>
                            <div class="col s6">
                                <div class="card">
                                    <?= Html::activeHiddenInput($model, 'condition') ?>
                                    <?= Html::button('<i class="material-icons right">add</i>Требование', [
                                        'id' => 'btn_addContition',
                                        'class' => 'btn btn-success btn_addCondition fullWidth'
                                    ]) ?>
                                    <div class="condition"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s4">
                        <div class="card">
                            <?= Html::activeHiddenInput($model, 'organizators') ?>
                            <div class="card-content">
                                <?= Html::dropDownList('friend-list', null, Friends::getAllFriendArrayId(), [
                                    'prompt' => 'Организаторы',
                                    'multiple' => true
                                ]) ?>
                            </div>
                        </div>
                        <h5>Участники</h5>
                        <?php
                            if($model->particEvents):?>
                                <ul class="collection">
                                    <?php
                                        foreach($model->particEvents as $person):
                                            ?>
                                            <li class="collection-item">
                                                <div class="chip">
                                                    <?= $person->user->getPhoto() ?>
                                                    <?= $person->user->username ?>
                                                </div>
                                            </li>
                                            <?php
                                        endforeach; ?>
                                </ul>
                                <?php
                            else: ?>
                                <div class="card-panel">Нет участников</div>
                            <?php endif; ?>
                        <div class="particEvents col-lg-12" id="particEvents"></div>
                    </div>
                </div>

            <?php endif; ?>

            <!-- add photo-->
            <?php if(!$model->isNewRecord): ?>
                <?php if(Yii::$app->user->can('updateOwnPost', ['event' => $model]) || Yii::$app->user->can('addPhoto', ['event' => $model])): ?>
                    <?= Html::activeHiddenInput($model, 'photo', ['id' => 'event-photo']) ?>
                    <?= FileManagerWidget::widget([
                                                      'uploadUrl' => Url::to(['event-upload-photo']),
                                                      'removeUrl' => Url::to(['event-remove-photo']),
                                                      'maxFiles' => 20,
                                                      'targetInputId' => 'event-photo',
                                                      'files' => $model->photo
                                                  ]) ?>
                <?php endif; ?>
            <?php endif; ?>
            <!-- end add photo-->

                <?= $form->field($model, 'track')
                         ->fileInput() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
                                       ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
