<?php
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

?>

<?php Pjax::begin(['enablePushState' => false]); ?>
<div class="row no-marg-bot">
    <div class="col s4 right-align">
        <?php $form = ActiveForm::begin(['action' => Url::to($params['action_vote'])]) ?>
        <?= Html::hiddenInput('rate_type', 'up') ?>
        <?= Html::hiddenInput('rate', $params['rate']) ?>
        <?= Html::hiddenInput('goBack', Url::to('')) ?>
        <?= Html::submitButton('<i class="material-icons">add</i>', ['class' => 'btn-floating waves-effect waves-light teal']) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col s4 rate-count"><strong><?= $params['rate'] ? $params['rate'] : 0 ?></strong></div>
    <div class="col s4">
        <?php $form = ActiveForm::begin(['action' => Url::to($params['action_vote'])]) ?>
        <?= Html::hiddenInput('rate_type', 'down') ?>
        <?= Html::hiddenInput('rate', $params['rate']) ?>
        <?= Html::hiddenInput('goBack', Url::to('')) ?>
        <?= Html::submitButton('<i class="material-icons">remove</i>', ['class' => 'btn-floating waves-effect waves-light materialize-red']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
<?php Pjax::end()?>





