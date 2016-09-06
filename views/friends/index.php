<?php

    /* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use yii\widgets\ListView;
    use yii\widgets\Pjax;

    /**
     * @var                                  $model app\models\Friends
     * @var \yii\data\ActiveDataProvider     $dataProvider
     * @var \app\models\search\FriendsSearch $searchFriend
     */

    $this->title = 'Добавить друга';

?>


<?php Pjax::begin(['id' => 'friends']) ?>
<?php if(Yii::$app->user->identity->friends0): ?>
    <div class="card">
        <p class="card-title">В друзьях</p>
        <div class="card-content">
            <?php foreach(Yii::$app->user->identity->friends0 as $friend): ?>
                <p class="chip"><?= $friend->friend->username ?>
                    <?= Html::a('<i class="close material-icons">close</i>', [
                            'remove',
                            'id' => $friend->id
                        ], [
                                    'data' => [
                                        'pjax' => true,
                                        'confirm' => "Вы уверены, что хотите удалить этот элемент?"
                                    ]
                                ]) ?>
                </p>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
<?php Pjax::end() ?>

<?php Pjax::begin(['id' => 'users']) ?>
<?php if($searchFriend->username || $dataProvider->count > 0): ?>
    <div class="card">
        <p class="card-title">Все пользователи</p>
        <div class="card-content">
            <?php $form = ActiveForm::begin() ?>
            <?= $form->field($searchFriend, 'username') ?>
            <?= Html::submitButton('Search') ?>
            <?php ActiveForm::end() ?>
            <?= ListView::widget([
                                     'dataProvider' => $dataProvider,
                                     'itemView' => '_list',
                                 ]) ?>
        </div>
    </div>
<?php endif; ?>
<?php Pjax::end() ?>



