<?php

    /* @var $this yii\web\View */
    use app\models\Event;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;

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
                    <input type="checkbox" checked>
                    <span class="lever"></span>
                    <span class="switch-label">Открытые</span>
                </label>
            </div>
            <div class="switch">
                <label>
                    <input type="checkbox">
                    <span class="lever"></span>
                    <span class="switch-label">Платные</span>
                </label>
            </div>
            <div class="switch">
                <label>
                    <span class="switch-label">Предварительная регистрация</span>
                    <input type="checkbox">
                    <span class="lever"></span>
                </label>
            </div>
        </div>
        <div class="input-field">
            <?= $form->field($model, 'date_start')
                     ->datetimeInput(['class'=>"datepicker"]) ?>
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
