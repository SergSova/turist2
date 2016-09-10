<?php
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use yii\helpers\Url;

?>
<div id="confirmModal-<?= $model->id ?>" class="modal">
    <div class="modal-content">
        <h4 class="center-align">Подать заявку</h4>
        <?php $form = ActiveForm::begin(['action' => ['event/send-confirm', 'returnUrl' => Url::to('')]]) ?>
            <?= Html::hiddenInput('Mail[event_id]', $model->id) ?>
            <?= Html::textarea('Mail[body]', null, ['class' => 'col-lg-12']) ?>
        <?= Html::submitButton('Отправить') ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>