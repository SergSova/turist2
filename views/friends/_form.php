<?php

    /* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use yii\widgets\ListView;
    use yii\widgets\Pjax;

    /**
     * @var                                  $model app\models\Friends
     * @var                                  $form  yii\widgets\ActiveForm
     * @var \yii\data\ActiveDataProvider     $dataProvider
     * @var \app\models\search\FriendsSearch $searchFriend
     */

    $this->registerJsFile('/web/js/friend.js', ['depends' => 'app\assets\AppAsset']);
    $this->title = 'Добавить друга';
    $this->params['breadcrumbs'][] = ['label' => 'Friends', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="friends-form">

    <?php Pjax::begin(['id' => 'friends']) ?>
    <?php if(Yii::$app->user->identity->friends0): ?>
        <?=Html::tag('h2','В друзьях')?>
    <?php endif; ?>
    <?php foreach(Yii::$app->user->identity->friends0 as $friend): ?>
        <p>
            <?= Html::tag('b', $friend->friend->username, ['data-userId' => $friend->friend_id, 'class' => 'remove-friend']) ?>
        </p>
    <?php endforeach; ?>
    <?php Pjax::end() ?>

    <?php Pjax::begin(['id' => 'users']) ?>
    <?php if($searchFriend->username || $dataProvider->count > 0): ?>
        <h2>Все пользователи</h2>
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($searchFriend, 'username') ?>
        <?= Html::submitButton('Search') ?>
        <?php ActiveForm::end() ?>
        <?= ListView::widget([
                                 'dataProvider' => $dataProvider,
                                 'itemView'     => '_list',
                             ]) ?>
    <?php endif; ?>
    <?php Pjax::end() ?>

</div>


