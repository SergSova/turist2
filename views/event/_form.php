<?php

    use app\assets\CreateEventAsset;
    use app\models\Event;
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
//    $this->registerJsFile('/web/js/autocomplete.js', [
//        'position' => \yii\web\View::POS_END,
//        'depends' => \app\assets\AppAsset::className()
//    ]);
//
//    $this->registerJsFile('/web/js/eventForm.js', [
//        'position' => \yii\web\View::POS_END,
//        'depends' => \app\assets\AppAsset::className()
//    ]);
    CreateEventAsset::register($this);
?>
<div class="section event">
    <div class="participants card-panel">
        <h5 class="center-align">Учасники</h5>
        <ul class="collection no-margin-bot">
            <li class="collection-item avatar">
                <a href="#">
                    <img src="img/ava.jpg" alt="" class="circle">
                    <span class="title">UserName</span>
                </a>
                <div class="secondary-content">
                    <i class="material-icons tooltipped" data-position="top" data-tooltip="Организатор">child_care</i>
                    <i class="material-icons tooltipped grey-text" data-position="top" data-tooltip="в друзья">grade</i>
                </div>

            </li>
            <li class="collection-item avatar">
                <a href="#">
                    <img src="img/ava.jpg" alt="" class="circle">
                    <span class="title">UserName</span>
                </a>
                <div class="secondary-content">
                    <i class="material-icons tooltipped grey-text" data-position="top" data-tooltip="в друзья">grade</i>
                    <i class="material-icons tooltipped" data-position="top" data-tooltip="название должности">assignment_ind</i>
                    <i class="material-icons tooltipped red-text" data-position="top" data-tooltip="удалить">remove_circle_outline</i>
                </div>
            </li>
            <li class="collection-item avatar">
                <a href="#">
                    <img src="img/ava.jpg" alt="" class="circle">
                    <span class="title">UserName</span>
                </a>
                <div class="secondary-content">
                    <i class="material-icons tooltipped grey-text" data-position="top" data-tooltip="в друзья">grade</i>
                    <i
                        class="material-icons tooltipped grey-text modal-trigger" data-position="top"
                        data-tooltip="назначить должность"
                        data-target="positionModal"
                    >assignment_ind</i>
                    <i class="material-icons tooltipped red-text" data-position="top" data-tooltip="удалить">remove_circle_outline</i>
                </div>

            </li>
        </ul>
    </div>
    <?php $form = ActiveForm::begin([
                                        'fieldConfig' => [
                                            'template' => "{input}\n{label}\n{error}"
                                        ]
                                    ]) ?>
    <div class="row">
        <div class="col s12 m9">
            <h1>Создать Событие</h1>
            <ul class="collapsible" data-collapsible="expandable">
                <li class="card-panel">
                    <h4 class="collapsible-header active">Информация о событии</h4>
                    <div class="collapsible-body">
                        <div class="row">
                            <?= $form->field($model, 'title') ?>
                        </div>
                        <div class="row no-margin-bot">
                            <div class="col s4">
                                <div class="input-field col s6">
                                    <?= $form->field($model, 'event_type_id')
                                             ->dropDownList($model->getTypes()) ?>
                                </div>
                                <div class="input-field col s6">
                                    <?= $form->field($model, 'status')
                                             ->dropDownList([
                                                                Event::STATUS_ACTIVE => 'Активно',
                                                                Event::STATUS_INACTIVE => 'Не активное'
                                                            ]) ?>
                                </div>
                                <p>Старт</p>
                                <div class="input-field col s6">
                                    <input type="text" value="<?=$model->date_start?>" class="c-datepicker-input">
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" value="<?=$model->time_start?>">
                                    <label>время</label>
                                </div>
                                <p>финиш</p>
                                <div class="input-field col s6">
                                    <input type="text" value="<?=$model->date_end?>">
                                    <label>дата</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" value="<?=$model->time_end?>">
                                    <label>время</label>
                                </div>
                            </div>
                            <div class="col s8">
                                <div class="row">
                                    <div class="col s12">
                                        <ul class="tabs">
                                            <li class="tab col s3"><a class="active" href="#description">Описание</a></li>
                                            <li class="tab col s3"><a href="#map">Трек</a></li>
                                            <li class="tab col s3"><a href="#gallery">Галерея</a></li>
                                        </ul>
                                    </div>
                                    <div id="description" class="col s12">
                                        <?=$form->field($model,'desc')->label(false)->textarea(['placeholder'=>'Введите описание'])?>
                                    </div>
                                    <div id="map" class="col s12">
                                        <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Загрузить трек</span>
<!--                                                <input type="file" name="Event['track']">-->
                                                <?= Html::activeFileInput($model, 'track')?>
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text"
                                                       placeholder=".kml .gpx .plt .wpt track types are supported">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="gallery" class="col s12">
                                        <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Добавить фото</span>
                                                <input type="file">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="card-panel">
                    <h4 class="collapsible-header">Условия участия</h4>
                    <div class="collapsible-body">
                        <p class="condition-item">
                            <input type="checkbox" id="test5"/>
                            <label for="test5">Red</label>
                        </p>
                        <p class="condition-item">
                            <input type="checkbox" id="test5"/>
                            <label for="test5">Red</label>
                        </p>
                        <p class="condition-item">
                            <input type="checkbox" id="test5"/>
                            <label for="test5">Red</label>
                        </p>
                    </div>
                </li>
                <li class="card-panel">
                    <h4 class="collapsible-header">Организаторы и должности</h4>
                    <div class="row collapsible-body">
                        <div class="col s6">
                            <h5>Организаторы</h5>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="text" id="autocomplete-input" class="autocomplete">
                                    <label for="autocomplete-input">Найти пользователя</label>
                                </div>
                                <div class="col s6">
                                    <br>
                                    <button class="btn teal waves-effect waves-light full-width">Добавить организатора</button>
                                </div>
                            </div>
                            <div class="collection org-list">
                                <a href="#!" class="collection-item">Alvin
                                    <div class="secondary-content right-align">
                                        <button class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">remove</i>
                                        </button>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col s6">
                            <h5>Должности</h5>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="text">
                                    <label>Введите название должности</label>
                                </div>
                                <div class="input-field col s6">
                                    <select multiple>
                                        <option selected disabled>Выберите права</option>
                                        <option>Rule 1</option>
                                        <option>Rule 2</option>
                                        <option>Rule 3</option>
                                    </select>
                                </div>
                                <div class="col s12">
                                    <button class="btn teal waves-effect waves-light full-width">Добавить должность</button>
                                </div>
                            </div>
                            <ul class="collection position-list">
                                <li class="collection-item">
                                    <button class="btn-floating btn-small waves-effect waves-light red right"><i class="material-icons">remove</i>
                                    </button>
                                    <span class="title">Название должности</span>
                                    <p><strong>Права: </strong>rule, rule 2</p>
                                    <p><a href="#">User 1</a> <a href="#">User 1</a> <a href="#">User 1</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
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
