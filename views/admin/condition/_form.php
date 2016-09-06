<?php
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;

?>

<?php $form = ActiveForm::begin() ?>
<div class="card">
    <p class="card-title"><?= $this->title ?></p>
    <div class="card-content">
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'desc')
                 ->textarea() ?>
    </div>
    <div class="card-action">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить',
                               ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>

