<?php

    /* @var $this yii\web\View */
    use app\models\Event;
    use app\models\EventType;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use macgyer\yii2materializecss\widgets\form\DatePicker;

    /* @var $model app\models\search\EventSearch */

    $searchJs = <<<JS
$('select').material_select();
$('.datepicker').pickadate();
JS;

    $this->registerJs($searchJs, \yii\web\View::POS_END);
?>


<div class="filter">
    <?php $form = ActiveForm::begin([
                                        'action'      => ['event-list'],
                                        'method'      => 'get',
                                        'fieldConfig' => [
                                            'template' => "{input}\n{label}\n{error}"
                                        ]
                                    ]); ?>
    <div class="card-panel teal lighten-5">
        <div class="input-field">
            <?= $form->field($model, 'status')
                     ->label('Показывать события')
                     ->dropDownList([
                                        Event::STATUS_ACTIVE => 'Актуальные',
                                        ''                   => 'Все'
                                    ]) ?>

        </div>

        <div class="switches-group"><p class="label">Доступность события</p>
            <div class="switch">
                <label>
                    <input type="checkbox" name="EventSearch[event_type_id][0]" value="<?= EventType::TYPE_FREE ?>">
                    <span class="lever"></span>
                    <span class="switch-label">Открытые</span>
                </label>
            </div>
            <div class="switch">
                <label>
                    <input type="checkbox" name="EventSearch[event_type_id][1]" value="<?= EventType::TYPE_CASH ?>">
                    <span class="lever"></span>
                    <span class="switch-label">Платные</span>
                </label>
            </div>
            <div class="switch">
                <label>
                    <span class="switch-label">Предварительная регистрация</span>
                    <input type="checkbox" name="EventSearch[event_type_id][2]" value="<?= EventType::TYPE_REGISTRED ?>">
                    <span class="lever"></span>
                </label>
            </div>
        </div>
        <div class="input-field">
            <?= DatePicker::widget([
                                       'model'     => $model,
                                       'attribute' => 'date_start',
                                   ]) ?>
        </div>
        <p class="label">Сложность</p>
        <p class="range-field">
            <input type="range" id="test5" min="0" max="30" step="10"/>
        </p>
        <div class="card-action">
            <?= Html::submitButton('Подобрать', ['class' => 'btn blue full-width']) ?>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>
