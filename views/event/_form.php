<?php

    use app\assets\CreateEventAsset;
    use app\models\Condition;
    use app\models\Event;
    use app\models\EventRule;
    use app\widgets\FileManagerWidget\FileManagerWidget;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use macgyer\yii2materializecss\widgets\form\DatePicker;
    use macgyer\yii2materializecss\widgets\form\TimePicker;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url;

    /**
     * @var                  $this  yii\web\View
     * @var                  $model app\models\Event
     * @var                  $form  yii\widgets\ActiveForm
     * @var \app\models\User $user
     **/

    CreateEventAsset::register($this);
    $requestUsersUrl = Url::to(['user/get-users']);
    $userUrl = Url::to(['user/view']);
    $js = <<<JS
var requestUsersUrl = "{$requestUsersUrl}";
var userUrl = "{$userUrl}";
JS;
    $this->registerJs($js, 3);
    $friends = [];
    if(!Yii::$app->user->isGuest){
        $user = Yii::$app->user->identity;

        $friends = $user->friends0;
        $friends = ArrayHelper::map($friends, 'id', 'friend_id');
    }
?>
<div class="section event">
    <div class="participants card-panel">
        <h5 class="center-align">Учасники</h5>
        <ul class="collection no-margin-bot">
            <?php if($model->isNewRecord): ?>
                <li class="collection-item avatar">
                    <a href="<?= Url::to([
                                             'user/view',
                                             'id' => $user->id
                                         ]) ?>">
                        <img src="<?= $user->getPhoto() ?>" alt="" class="circle">
                        <span class="title"><?= $user->username ?></span>
                    </a>
                    <div class="secondary-content">
                        <i class="material-icons tooltipped" data-position="top" data-tooltip="организатор">child_care</i>
                    </div>
                </li>
            <?php endif; ?>
            <?php foreach($model->particEvents as $participant): ?>
                <li class="collection-item avatar">
                    <a href="<?= Url::to([
                                             'user/view',
                                             'id' => $participant->user_id
                                         ]) ?>">
                        <img src="<?= $participant->user->getPhoto() ?>" alt="" class="circle">
                        <span class="title"><?= $participant->user->username ?></span>
                    </a>
                    <div class="secondary-content">
                        <?php if($user->id != $participant->user_id):
                            if(count($friends) && array_search($participant->user_id, $friends)): ?>
                                <i class="material-icons tooltipped yellow-text" data-position="top" data-tooltip="в друзьях">grade</i>
                                <?php
                            else: ?>
                                <?= Html::a('<i class="material-icons tooltipped grey-text" data-position="top" data-tooltip="в друзья">grade</i>', [
                                    '/friends/add',
                                    'id'     => $participant->user_id,
                                    'return' => Url::to('')
                                ]) ?>
                                <?php
                            endif;
                        endif; ?>
                        <? if($model->canAllChange() || $model->canParticipiat() || $model->isNewRecord): ?>
                            <i class="material-icons tooltipped grey-text modal-trigger" data-position="top"
                               data-tooltip="назначить должность"
                               data-target="positionModal">assignment_ind</i>
                        <? endif ?>
                        <?php if(($model->canAllChange() || $model->canParticipiat()) and !$model->isNewRecord and $participant->user_id != $user->id): ?>
                            <?= Html::a('<i class="material-icons tooltipped red-text" data-position="top" data-tooltip="удалить">remove_circle_outline</i>', [
                                'confirm-particip',
                                'id'      => $participant->user_id,
                                'confirm' => false
                            ]) ?>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php $form = ActiveForm::begin([
                                        'fieldConfig' => [
                                            'template' => "{input}\n{label}\n{error}"
                                        ],
                                        'options' => ['enctype' => 'multipart/form-data']
                                    ]) ?>
    <div class="row">
        <div class="col s12 m9">
            <h1><?= $this->title ?></h1>
            <ul class="collapsible" data-collapsible="expandable">
                <li class="card-panel">
                    <h4 class="collapsible-header active">Информация о событии</h4>
                    <div class="collapsible-body">
                        <? if($model->canAllChange() || $model->isNewRecord): ?>
                            <div class="row">
                                <?= $form->field($model, 'title') ?>
                            </div>
                        <? endif ?>
                        <div class="row no-margin-bot">
                            <? if($model->canAllChange() || $model->isNewRecord): ?>
                                <div class="col s4">
                                    <div class="input-field col s6">
                                        <?= $form->field($model, 'event_type_id')
                                                 ->dropDownList($model->getTypes()) ?>
                                    </div>
                                    <div class="input-field col s6">
                                        <?= $form->field($model, 'status')
                                                 ->dropDownList([
                                                                    Event::STATUS_ACTIVE   => 'Активно',
                                                                    Event::STATUS_INACTIVE => 'Не активное',
                                                                    Event::STATUS_FINISH   => 'Завершенное',
                                                                ]) ?>
                                    </div>
                                    <div class="col s12">
                                        <p class="input-field-ladel">Старт</p>
                                    </div>
                                    <div class="input-field col s6">
                                        <?= DatePicker::widget([
                                                                   'model'     => $model,
                                                                   'attribute' => 'date_start',
                                                                   'options'   => ['id' => 'date_start_W']
                                                               ]) ?>
                                        <label for="date_start_W">Дата</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <?= TimePicker::widget([
                                                                   'model'         => $model,
                                                                   'attribute'     => 'time_start',
                                                                   'clientOptions' => ['formatSubmit' => 'HH:i'],
                                                                   'options'       => ['id' => 'time_start_W']
                                                               ]) ?>
                                        <label for="time_start_W">Время</label>
                                    </div>
                                    <div class="col s12">
                                        <p class="input-field-ladel">Финиш</p>
                                    </div>
                                    <div class="input-field col s6">
                                        <?= DatePicker::widget([
                                                                   'model'     => $model,
                                                                   'attribute' => 'date_end',
                                                                   'options'   => ['id' => 'date_end_W']
                                                               ]) ?>
                                        <label for="date_end_W">Дата</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <?= TimePicker::widget([
                                                                   'model'         => $model,
                                                                   'attribute'     => 'time_end',
                                                                   'clientOptions' => ['formatSubmit' => 'HH:i'],
                                                                   'options'       => ['id' => 'time_end_W']
                                                               ]) ?>
                                        <label for="time_end_W">Время</label>
                                    </div>
                                </div>
                            <? endif ?>
                            <div class="col s8">
                                <div class="row">
                                    <div class="col s12">
                                        <ul class="tabs">
                                            <? if($model->canAllChange() || $model->isNewRecord): ?>
                                                <li class="tab col s3"><a class="active" href="#description">Описание</a></li>
                                                <li class="tab col s3"><a href="#map">Трек</a></li>
                                            <? endif ?>
                                            <li class="tab col s3"><a href="#gallery">Галерея</a></li>
                                        </ul>
                                    </div>
                                    <? if($model->canAllChange() || $model->isNewRecord): ?>
                                        <div id="description" class="col s12">
                                            <?= $form->field($model, 'desc')
                                                     ->label(false)
                                                     ->textarea(['placeholder' => 'Введите описание']) ?>
                                        </div>
                                        <div id="map" class="col s12">
                                            <div class="file-field input-field">
                                                <div class="btn">
                                                    <span>Загрузить трек</span>
                                                    <?= Html::activeFileInput($model, 'track') ?>
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text"
                                                           placeholder=".kml .gpx .plt .wpt track types are supported">
                                                </div>
                                            </div>
                                        </div>
                                    <? endif ?>
                                    <div id="gallery" class="col s12">
                                        <?= Html::activeHiddenInput($model, 'photo', ['id' => 'event-photo']) ?>
                                        <?= FileManagerWidget::widget([
                                                                          'uploadUrl'     => Url::to(['event/event-upload-photo']),
                                                                          'removeUrl'     => Url::to(['event/event-remove-photo']),
                                                                          'targetInputId' => 'event-photo',
                                                                          'files'         => $model->photo,
                                                                          'maxFiles'      => 20
                                                                      ]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <? if($model->canAllChange() || $model->isNewRecord): ?>
                    <li class="card-panel">
                        <h4 class="collapsible-header">Условия участия</h4>
                        <div class="collapsible-body">
                            <?php
                                $condition = Condition::find()
                                                      ->asArray()
                                                      ->all();
                                foreach($condition as $cond):
                                    ?>
                                    <p class="condition-item">
                                        <input type="checkbox" id="cond<?= $cond['id'] ?>"/>
                                        <label for="cond<?= $cond['id'] ?>"><?= $cond['name'] ?></label>
                                    </p>
                                <?php endforeach; ?>
                        </div>
                    </li>
                    <li class="card-panel">
                        <h4 class="collapsible-header">Организаторы и должности</h4>
                        <div class="row collapsible-body">
                            <div class="col s6">
                                <h5>Организаторы</h5>
                                <?= Html::activeHiddenInput($model, 'organizators', ['id' => 'organizators']) ?>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input type="text" id="autocomplete-input" class="autocomplete">
                                        <label for="autocomplete-input">Найти пользователя</label>
                                    </div>
                                    <div class="col s6">
                                        <br>
                                        <button type="button" class="btn teal waves-effect waves-light full-width disabled" disabled id="add-org">
                                            Добавить
                                            организатора
                                        </button>
                                    </div>
                                </div>
                                <div class="collection org-list" id="org_list"></div>
                            </div>
                            <div class="col s6">
                                <h5>Должности</h5>
                                <?= Html::activeHiddenInput($model, 'particip', ['id' => 'particip']) ?>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input type="text" id="rule-name">
                                        <label for="rule-name">Введите название должности</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <select multiple id="rules-select">
                                            <option selected disabled>Выберите права</option>
                                            <?php foreach(EventRule::find()
                                                                   ->all() as $rule): ?>
                                                <option ><?=$rule->name?></option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                    <div class="col s12">
                                        <button type="button" id="add-rule" disabled class="btn teal waves-effect waves-light full-width disabled">
                                            Добавить должность
                                        </button>
                                    </div>
                                </div>
                                <ul class="collection position-list" id="rules-list">

                                </ul>
                            </div>
                        </div>
                    </li>
                <? endif ?>

            </ul>
        </div>
        <div class="col s12 m9">
            <button class="btn full-width teal">Создать событие</button>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>
<div id="positionModal" class="modal">
    <div class="modal-content">
        <h4>Назначить должность</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>
