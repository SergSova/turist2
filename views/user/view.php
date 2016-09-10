<?php
    /** @var \app\models\User $user */
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\data\DetailView;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url;

    $friends = [];
    if(!Yii::$app->user->isGuest){
        $user = Yii::$app->user->identity;

        $friends = $user->friends0;
        $friends = ArrayHelper::map($friends, 'id', 'friend_id');
    }
?>

<div class="row">
    <div class="card col s6 offset-s6 l4 offset-l4">
        <?php
            if($user->id != $model->id):
                if(count($friends) && array_search($model->id, $friends)): ?>
                    <i class="material-icons tooltipped yellow-text" data-position="top" data-tooltip="в друзьях">grade</i>
                    <?php
                else: ?>
                    <?= Html::a('<i class="material-icons tooltipped grey-text" data-position="top" data-tooltip="в друзья">grade</i>', [
                        '/friends/add',
                        'id'     => $model->id,
                        'return' => Url::to('')
                    ]) ?>
                    <?php
                endif;
            endif; ?>
        <div class="card-content">
            <?= DetailView::widget([
                                       'model'      => $model,
                                       'attributes' => [
                                           'email',
                                           'f_name',
                                           'l_name',
                                           'photo',
                                           'rate',
                                           'username',
                                       ]
                                   ]) ?>
        </div>
    </div>
</div>

