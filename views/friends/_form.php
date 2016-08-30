<?php


    /* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;

    /* @var $model app\models\Friends */
    /* @var $form yii\widgets\ActiveForm */
    /* @var \yii\data\ActiveDataProvider $dataProvider */
    /* @var \app\models\search\FriendsSearch $searchFriend */

    $this->registerJsFile('/web/js/friend.js', ['depends' => 'app\assets\AppAsset']);
    $this->title = 'Edit Friends';
    $this->params['breadcrumbs'][] = ['label' => 'Friends', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="friends-form">

    <?php \yii\widgets\Pjax::begin(['id' => 'friends']) ?>

    <?php
        $user = \app\models\User::findOne(Yii::$app->user->id);
        if($user->friends0){
            echo '<h2>In Friend</h2>';
        }
        foreach($user->friends0 as $friend){
            echo '<p><b class="remove-friend" data-userId="'.$friend->friend_id.'">'.$friend->friend->username.'</b></p>';
        } ?>
    <?php \yii\widgets\Pjax::end() ?>

    <?php \yii\widgets\Pjax::begin(['id' => 'users']) ?>
    <?php
        if($searchFriend->username || $dataProvider->count > 0){
            echo '<h2>Users</h2>';
            $form = ActiveForm::begin();
            echo $form->field($searchFriend, 'username');
            echo Html::submitButton('Search');
            ActiveForm::end();
            echo \yii\widgets\ListView::widget([
                                                   'dataProvider' => $dataProvider,
                                                   'itemView'     => '_list',
                                               ]);
        }
    ?>


    <?php \yii\widgets\Pjax::end() ?>

</div>


