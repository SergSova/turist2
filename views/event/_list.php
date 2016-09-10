<?php
    /** @var \app\models\Event $model */

    use app\models\EventType;
    use yii\helpers\Url;

    $d = new DateTime($model->date_start);
?>


    <div class="card event-medium">
        <div class="card-content">
            <i class="material-icons event-type tooltipped" data-position="top"
               data-tooltip="<?= $model->eventType->name ?>"><?= $model->eventType->icon ?></i>
            <a href="<?= Url::to(['user/view', 'id' => $model->creator_id]) ?>" class="right ava-container-small tooltipped" data-position="top"
               data-tooltip="<?= $model->creator->username ?>">
                <img src="<?= $model->creator->getPhoto() ?>" alt="<?= $model->creator->username ?>" class="responsive-img circle">
            </a>
            <p class="card-title truncate"><?= $model->title ?></p>
            <p class="description"><?= $model->desc ?></p>
            <div class="row info">
                <div class="col s12 m4 l2 time-start">
                    <p class="info-title">Старт</p>
                    <div class="info-item">
                        <i class="material-icons">event</i>
                        <span><?= date('Y-m-d', strtotime($model->date_start)) ?></span>
                    </div>
                    <div class="info-item">
                        <i class="material-icons">access_time</i>
                        <span><?= $model->time_start ?></span>
                    </div>
                </div>
                <div class="col s12 m4 l2 time-finish">
                    <p class="info-title">Финиш</p>
                    <div class="info-item">
                        <i class="material-icons">event</i>
                        <span><?= date('Y-m-d', strtotime($model->date_end)) ?></span>
                    </div>
                    <div class="info-item">
                        <i class="material-icons">access_time</i>
                        <span><?= $model->time_end ?></span>
                    </div>
                </div>
                <div class="col s12 m4 l1 offset-l7 graph-wrap">
                    <div class="info-graph tooltipped"
                         data-position="bottom"
                         data-tooltip="Участники: " .<?= count($model->particEvents) ?>
                    >
                        <div class="graph graph-people"></div>
                    </div>
                    <div class="info-graph tooltipped"
                         data-position="bottom"
                         data-tooltip="Рейтинг: " .<?= $model->rate ?>
                    >
                        <div class="graph graph-rate"></div>
                    </div>
                    <div class="info-graph tooltipped"
                         data-position="bottom"
                         data-tooltip="Сложность: высокая"
                    >
                        <div class="graph graph-difficult"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-action">
            <div class="row no-margin-bot">
                <div class="col s12 m6">
                    <a href="<?= Url::to(['event/view', 'id' => $model->id]) ?>"
                       class="full-width btn teal darken-2 waves-effect waves-light more-but">Подробнее</a>
                </div>
                <div class="col s12 m6">
                    <?= $model->getButton() ?>
                </div>
            </div>
        </div>
    </div>
