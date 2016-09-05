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

    <br>
    <?php if($model->socialAccs): ?>
        <div class="card">
            <p class="card-title">Социальные сети</p>
            <div class="card-content">
                <?php foreach($model->socialAccs as $socialAcc): ?>
                    <div class="chip">
                        <a href="<?= $socialAcc->social_id ?>">
                            <?= $socialAcc->social_name ?>
                            <?= Html::a('<i class="close material-icons">close</i>', [
                                'user/remove-social',
                                'id' => $socialAcc->id
                            ]) ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    <?php endif; ?>
</div>