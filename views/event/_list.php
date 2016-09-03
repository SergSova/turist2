<?php
    /** @var \app\models\Event $model */
    use app\widgets\rateCounter\rateCounterWidget;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use macgyer\yii2materializecss\widgets\Modal;

    $d = new DateTime($model->date_start);
?>

<div class="card">
    <div class="card-content">
        <div class="row no-marg-bot">
            <div class="col s8">
                <p class="card-title"><strong>Событие: </strong><?= $model->title ?></p>
                <?= $model->desc ?>
                <div class="event-conditions">
                    <?php
                        $conditions = json_decode($model->condition);
                        if(is_array($conditions)):
                            foreach($conditions as $condition):
                                ?>
                                <div class="chip"><?= $condition ?></div>
                                <?php
                            endforeach;
                        endif;
                    ?>
                </div>
            </div>
            <div class="col s4">
                <ul class="collection">
                    <li class="collection-item center-align">
                        <i class="material-icons left">timer</i><strong><?= Yii::$app->formatter->asDatetime($model->date_start) ?></strong>
                    </li>
                    <li class="collection-item center-align">
                        <i class="material-icons left">timer_off</i><strong><?= Yii::$app->formatter->asDatetime($model->date_end) ?></strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-action">
        <div class="row no-marg-bot">
            <div class="col s3">
                <?= rateCounterWidget::widget([
                                                  'rate' => $model->rate,
                                                  'vote' => [
                                                      'vote-event',
                                                      'model_id' => $model->id
                                                  ],
                                              ]) ?>
            </div>
            <div class="col s4 push-s5">
                <?php
                    $event_type = $model->eventType->name;
                    /** @var \app\models\ParticEvent $particip если существует возвращает связку пользователь-событие */
                    $particip = $model->isRegistred(); ?>
                <?php switch($event_type):
                    case 'free': ?>
                        <?php if($particip): ?>
                            <?= Html::a('Отменить', [
                                '/event/remove-particip',
                                'id' => $model->id
                            ], [
                                            'class' => 'btn amber waves-effect waves-light fullWidth',
                                            'data-pjax' => 0
                                        ]) ?>
                        <?php else: ?>
                            <?= Html::a('Участвовать', [
                                '/event/add-particip',
                                'id' => $model->id
                            ], [
                                            'class' => 'btn light-blue waves-effect waves-light fullWidth',
                                            'data-pjax' => 0
                                        ]) ?>
                            <?php
                        endif;
                        break; ?>

                    <?php case 'cash': ?>
                        <?= 'заплатить' ?>
                        <?php break; ?>
                    <?php case 'registred': ?>
                        <?php if($particip): ?>
                            <?php if(!$particip->confirmed): ?>
                                <?= 'подтверждается ' ?>
                            <?php endif; ?>
                            <?= Html::a('Отменить', [
                                '/event/remove-particip',
                                'id' => $model->id
                            ], ['data-pjax' => 0]) ?>
                        <?php else: ?>
                            <?php Modal::begin([
                                                   //'header'       => '<h2>Отправить запрос на добавление</h2>',
                                                   'modalType' => Modal::TYPE_LEAN,
                                                   'toggleButton' => [
                                                       //                                               'tag'   => 'a',
                                                       //                                               'class' => '',
                                                       'label' => 'Подать заявку!',
                                                   ],
                                                   'closeButton' => [
                                                       'label' => 'Закрыть',
                                                       'tag' => 'span'
                                                   ],
                                               ]) ?>
                            <?php $form = ActiveForm::begin(['action' => ['event/send-confirm']]) ?>
                            <?= Html::hiddenInput('Mail[event_id]', $model->id) ?>
                            <?= Html::textarea('Mail[body]', null, ['class' => 'col-lg-12']) ?>
                            <?= Html::submitButton('Отправить') ?>
                            <?php ActiveForm::end();
                            Modal::end(); ?>
                        <?php endif; ?>
                        <?php break; ?>

                    <?php default: ?>
                    <?php endswitch; ?>
            </div>
        </div>
    </div>
</div>
