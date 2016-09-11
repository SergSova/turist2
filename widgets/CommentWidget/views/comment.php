<?php

    /**
     * @var \yii\data\ActiveDataProvider       $dataProvider
     * @var \app\models\User|\app\models\Event $model
     * @var \app\models\Comments               $commentModel
     */
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
use yii\widgets\ListView;

?>

<div class="form-coment">
    <?php $commentForm = ActiveForm::begin([
                                               'action'  => 'add-comment',
                                               'options' => ['class' => 'form-inline'],
                                           ]) ?>
    <?= $commentForm->field($commentModel, 'text')
                    ->textarea(['rows' => 6, 'placeholder' => 'Ваш комментарий']) ?>

    <?= Html::activeHiddenInput($commentModel, 'user_id', ['value' => Yii::$app->user->id]) ?>
    <?= Html::activeHiddenInput($commentModel, 'event_id', ['value' => $model->id]) ?>
    <?= Html::submitButton('Отправить'); ?>
    <?php ActiveForm::end() ?>
</div>
<?= ListView::widget([
                         'dataProvider' => $dataProvider,
                         'itemView'     => '_list',
                         'emptyText'    => 'Комментариев нет'
                     ]) ?>
