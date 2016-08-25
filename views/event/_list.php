<?php
    /** @var \app\models\Event $model */
    use yii\bootstrap\Modal;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

?>
<div class="panel-primary"">
    <div class="panel-heading">
        Событие: <strong><?= $model->title ?></strong>
    </div>
    <div class="panel-body">
        <div class="col-lg-9"><?= $model->desc ?></div>
        <div class="col-lg-3 text-right">
            <?php
                $event_type = $model->eventType->name;
                /** @var \app\models\ParticEvent $particip если существует возвращает связку пользователь-событие*/
                $particip = $model->isRegistred(); ?>
            <?php switch($event_type):
                case 'free': ?>
                    <?php if($particip): ?>
                        <?= Html::a('Отменить', ['/event/remove-particip', 'id' => $model->id],['data-pjax'=>0]) ?>
                    <?php else: ?>
                        <?= Html::a('Участвовать', ['/event/add-particip', 'id' => $model->id],['data-pjax'=>0]) ?>
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
                        <?= Html::a('Отменить', ['/event/remove-particip', 'id' => $model->id],['data-pjax'=>0]) ?>
                    <?php else: ?>
                        <?php Modal::begin([
                                               'header'       => '<h2>Отправить запрос на добавление</h2>',
                                               'toggleButton' => [
                                                   'tag'   => 'a',
                                                   'class' => '',
                                                   'label' => 'Подать заявку!',
                                               ]
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
    <div class="panel-footer ">
        <div class="text-right">
            Создатель: <strong><?= $model->creator->username ?></strong>
        </div>
    </div>
</div>
