<?php
    /** @var \app\models\User $model */
    use macgyer\yii2materializecss\lib\Html;

?>
<div class="card-panel">
    <p><?= $model->username ?></p>
    <p>
        <?= $model->email ?>
        <?= Html::a('Изменить почту', ['request-change-mail']) ?>
    </p>
    <?= Html::a('Изменить пароль', ['change-password'], ['class' => 'btn']) ?>
</div>