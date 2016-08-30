<?php


/* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;

    /* @var $searchModel app\models\search\FriendsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Friends';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friends-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Friends', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php \yii\widgets\Pjax::begin(['id' => 'friends']) ?>

    <?php
        $user = \app\models\User::findOne(Yii::$app->user->id);
        foreach($user->friends0 as $friend){
            echo '<p><b class="remove-friend" data-userId="'.$friend->friend_id.'">'.$friend->friend->username.'</b></p>';
        } ?>
    <?php \yii\widgets\Pjax::end() ?>
</div>
