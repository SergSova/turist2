<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

?>

<?php Pjax::begin(['enablePushState' => false]); ?>
<div class="row">
    <div class="pull-left">
        <?php $form = ActiveForm::begin(['action' => Url::to($params['vote'])]) ?>
        <?= Html::hiddenInput('rate_type', 'up') ?>
        <?= Html::hiddenInput('rate', $params['rate']) ?>
        <?= Html::hiddenInput('goBack', Url::to('')) ?>
        <?= Html::submitButton('', ['class' => 'btn  btn-warning glyphicon glyphicon-arrow-up']) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="pull-left"><strong><?= $params['rate'] ? $params['rate'] : 0 ?></strong></div>
    <div class="pull-left">
        <?php $form = ActiveForm::begin(['action' => Url::to($params['vote'])]) ?>
        <?= Html::hiddenInput('rate_type', 'down') ?>
        <?= Html::hiddenInput('rate', $params['rate']) ?>
        <?= Html::hiddenInput('goBack', Url::to('')) ?>
        <?= Html::submitButton('', ['class' => 'btn  btn-primary glyphicon glyphicon-arrow-down']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>






