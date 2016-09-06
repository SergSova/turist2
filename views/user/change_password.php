<?php
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;

    /** @var \app\models\forms\PasswordChangeModel $model */

?>

<?php $form = ActiveForm::begin() ?>
<div class="card">
    <div class="card-content">
        <?= $form->field($model, 'password_repeat')
                 ->passwordInput() ?>
        <?= $form->field($model, 'password')
                 ->passwordInput() ?>
        <?= Html::submitButton('Изменить') ?>
    </div>
</div>
<?php ActiveForm::end() ?>
