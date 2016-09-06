<?php
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;

?>
<div class="card">
    <p class="card-title">Новая почта</p>
    <div class="card-content">
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'newEmail') ?>
        <?= Html::submitButton('Изменить') ?>
        <?php ActiveForm::end() ?>
    </div>
</div>