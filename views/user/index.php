<?php
    /** @var \app\models\User $model */
    use app\widgets\FileManagerWidget\FileManagerWidget;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use yii\helpers\Url;

?>
<div class="card-panel">
    <?= $model->getPhoto() ?>

    <?php //todo сделать модалку для изменения аватары?>
    <?php $form = ActiveForm::begin([
                                        'action' => Url::to('change-photo'),
                                        'method' => 'post'
                                    ]) ?>
    <?= Html::activeHiddenInput($model, 'photo', ['id' => 'user_foto']) ?>
    <?= FileManagerWidget::widget([
                                      'uploadUrl' => Url::to('user-upload-photo'),
                                      'removeUrl' => Url::to('user-remove-photo'),
                                      'files' => $model->photo,
                                      'targetInputId' => 'user_foto',
                                      'maxFiles' => 1,
                                  ]) ?>
    <?= Html::submitButton('Изменить') ?>
    <?php ActiveForm::end() ?>

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