<?php

    /* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;
    use yii\widgets\Pjax;

    /**
     * @var $searchModel  app\models\search\FriendsSearch
     * @var $dataProvider yii\data\ActiveDataProvider
     */

    $this->title = 'Друзья';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="friends-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Friends', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(['id' => 'friends']) ?>

    <?php foreach(Yii::$app->user->identity->friends0 as $friend): ?>
        <p>
            <b class="remove-friend" data-userId="<?= $friend->friend_id ?>">
                <?= $friend->friend->username ?>
            </b>
        </p>
    <?php endforeach; ?>
    <?php Pjax::end() ?>
</div>
