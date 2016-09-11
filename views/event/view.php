<?php

    /**
     * @var                              $this yii\web\View
     *
     * @var \app\models\Event            $model
     * @var \app\models\User             $user
     **/
    use app\models\EventType;
    use app\widgets\rateCounter\rateCounterWidget;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Json;
    use yii\helpers\Url;
    use yii\sergsova\fileManager\FileManager;

    $this->title = $model->title;

    $conditions = $model->condition ? json_decode($model->condition) : null;

    if(!Yii::$app->user->isGuest){
        $user = Yii::$app->user->identity;
        $friends = $user->friends0;
        $friends = ArrayHelper::map($friends, 'id', 'friend_id');

        $particip = '';
        if($model->particip){
            $particip = json_decode($model->particip);
        }
    }
?>
<?php if($model->eventType->name == 'registred'){
    $this->render('_confirmForm', ['model' => $model->id]);
} ?>
<div class="section event">
    <div class="row">
        <div class="col s12 m9">
            <div class="right actions-box">
                <div class="rating-box right-align">
                    <!--                    <button class="sBtn btn-floating btn-small waves-effect waves-light blue"><i class="material-icons">share</i></button>-->
                    <?= rateCounterWidget::widget([
                                                      'rate'        => $model->rate,
                                                      'action_vote' => [
                                                          'vote-event',
                                                          'model_id' => $model->id
                                                      ],
                                                  ]) ?>

                </div>
                <div class="button-box">
                    <?= $model->getButton() ?>
                </div>
            </div>
            <h1><i class="material-icons"><?= $model->eventType->icon ?></i><?= $model->title ?></h1>
            <div class="row card-panel">
                <div class="col s3">
                    <div class="conditions">
                        <p>Условия</p>
                        <i class="material-icons">beach_access</i>
                        <i class="material-icons">smoke_free</i>
                        <i class="material-icons">airline_seat_individual_suite</i>
                    </div>
                    <table class="info">
                        <tr>
                            <td class="grey" colspan="2">Старт</td>
                        </tr>
                        <tr>
                            <td><i class="material-icons">event</i></td>
                            <td><?= date('Y-m-d', strtotime($model->date_start)) ?></td>
                        </tr>
                        <tr>
                            <td><i class="material-icons">access_time</i></td>
                            <td><?= $model->time_start ?></td>
                        </tr>
                        <tr>
                            <td class="grey" colspan="2">Финиш</td>
                        </tr>
                        <tr>
                            <td><i class="material-icons">event</i></td>
                            <td><?= date('Y-m-d', strtotime($model->date_end)) ?></td>
                        </tr>
                        <tr>
                            <td><i class="material-icons">access_time</i></td>
                            <td><?= $model->time_end ?></td>
                        </tr>
                        <tr>
                            <td class="grey" colspan="2">Сложность</td>
                        </tr>
                        <tr>
                            <td colspan="2">Высокая</td>
                        </tr>
                    </table>
                </div>
                <div class="col s9">
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s3"><a class="active" href="#description">Описание</a></li>
                                <li class="tab col s3"><a href="#track">Трек</a></li>
                                <li class="tab col s3"><a href="#gallery">Галерея</a></li>
                            </ul>
                        </div>
                        <div id="description" class="col s12">
                            <p><?= $model->desc ?></p>
                        </div>
                        <div id="track" class="col s12">
                            <?php if($model->track_path && file_exists(FileManager::getInstance()
                                                                                  ->getStoragePath().Json::decode($model->track_path)[0])
                            ): ?>
                                <?= Html::a('Скачать трек', [
                                    'download-track',
                                    'path' => Json::decode($model->track_path)[0]
                                ], ['class' => 'btn teal waves-effect waves-light']) ?>
                                <div class="map">
                                    <?= $this->render('//site/map', [
                                        'path' => FileManager::getInstance()
                                                             ->getStoragePath().Json::decode($model->track_path)[0]
                                    ]) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div id="gallery" class="col s12">
                            <?php
                                if($model->photo):
                                    foreach(json_decode($model->photo) as $itemphoto):?>
                                        <img src="<?= FileManager::getInstance()
                                                                 ->getStorageUrl().$itemphoto ?>" class="materialboxed" width="350">
                                        <?php
                                    endforeach;
                                endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="participants">-->
    <div class="participants card-panel">
        <h5 class="center-align">Учасники</h5>
        <ul class="collection no-margin-bot">
            <?php foreach($model->particEvents as $participant): ?>
                <li class="collection-item avatar">
                    <a href="<?= Url::to([
                                             'user/view',
                                             'id' => $participant->user_id
                                         ]) ?>">
                        <img src="<?= $participant->user->getPhoto() ?>" alt="" class="circle">
                        <span class="title"><?= $participant->user->username ?></span>
                    </a>
                    <div class="secondary-content">
                        <?php
                            if(!Yii::$app->user->isGuest):
                                if($user->id != $participant->user_id):
                                    if(count($friends) && array_search($participant->user_id, $friends)): ?>
                                        <i class="material-icons tooltipped yellow-text" data-position="top" data-tooltip="в друзьях">grade</i>
                                        <?php
                                    else: ?>
                                        <?= Html::a('<i class="material-icons tooltipped grey-text" data-position="top" data-tooltip="в друзья">grade</i>', [
                                            '/friends/add',
                                            'id'     => $participant->user_id,
                                            'return' => Url::to('')
                                        ]) ?>
                                        <?php
                                    endif;
                                endif; ?>
                                <i
                                    class="material-icons tooltipped orange-text" data-position="top"
                                    data-tooltip="Должность"
                                >assignment_ind</i>
                            <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!--</div>-->
</div>

