<?php
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

?>

<?php Pjax::begin(['enablePushState' => false]); ?>
<?php $form = ActiveForm::begin(['action' => Url::to($params['action_vote']), 'id' => 'rate_up']) ?>
<?= Html::hiddenInput('rate_type', 'up') ?>
<?= Html::hiddenInput('rate', $params['rate']) ?>
<?= Html::hiddenInput('goBack', Url::to('')) ?>
<?= Html::submitButton('<i class="materialize-icons"><i class="material-icons">thumb_up</i></i>', ['form'  => 'rate_up',
                                                                                             'class' => 'btn-floating btn-small waves-effect waves-light green'
]) ?>
<?php ActiveForm::end() ?>
<span><?= $params['rate'] ? $params['rate'] : 0 ?></span>
<?php $form = ActiveForm::begin(['action' => Url::to($params['action_vote']), 'id' => 'rate_down']) ?>
<?= Html::hiddenInput('rate_type', 'down') ?>
<?= Html::hiddenInput('rate', $params['rate']) ?>
<?= Html::hiddenInput('goBack', Url::to('')) ?>
<?= Html::submitButton('<i class="materialize-icons"><i class="material-icons">thumb_down</i></i>', ['form'  => 'rate_down',
                                                                                               'class' => 'btn-floating btn-small waves-effect waves-light red'
]) ?>
<?php ActiveForm::end() ?>

<?php Pjax::end() ?>





