<?php
    /**
     * @var \yii\web\View                $this
     * @var \yii\data\ActiveDataProvider $model
     * @var \app\models\Event[]          $events
     */
    use yii\helpers\Url;

    $this->registerJsFile('/web/js/landing.js', [
        'position' => \yii\web\View::POS_END,
        'depends'  => \app\assets\AppAsset::className()
    ]);
    $js = <<<JS
var a = $('.event-list').find('.modal');
a.clone().insertAfter($('footer'));
a.remove();
JS;
    $this->registerJs($js, 3);
?>
<div class="section no-padding" id="herobox">
    <div class="parallax-container">
        <div class="parallax"><img src="<?= Url::to('/web/img/parallax1.JPG') ?>"></div>
        <div class="valign-wrapper white-text full-height bg-shadow">
            <div class="valign full-width center-align">
                <div class="container">
                    <h1>Lets go somewhere!</h1>
                </div>
                <div class="row">
                    <div class="col s10 offset-s1 m4 offset-m2 l3 offset-l3">
                        <a href="<?= Url::to(['event/event-calendar']) ?>" class="full-width btn btn-large red waves-effect waves-light">Календарь
                            событий</a>
                    </div>
                    <div class="col s10 offset-s1 m4 l3">
                        <a href="<?= Url::to(['event/create']) ?>" class="full-width btn btn-large orange waves-effect waves-light">Создать
                            событие</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <h2 class="center-align no-margin-top">Актуальные события</h2>
    <?php
        $events = $model->getModels();
        if(!empty($events)):
            ?>
            <div class="row no-margin-bot event-list">
                <?php foreach($events as $event): ?>
                    <div class="col s12 m6 l3">
                        <div class="card large event-small">
                            <div class="card-content">
                                <i class="material-icons event-small-type tooltipped" data-position="top"
                                   data-tooltip="<?= $event->eventType->name ?>"><?= $event->eventType->icon ?></i>
                                <a href="<?= Url::to(['user/view', 'id' => $event->creator_id]) ?>" class="right ava-container-small tooltipped"
                                   data-position="top"
                                   data-tooltip="<?= $event->creator->username ?>">
                                    <img src="<?= $event->creator->getPhoto() ?>" class="responsive-img circle">
                                </a>
                                <p class="card-title truncate"><?= $event->title ?></p>
                                <p class="description"><?= $event->desc ?></p>
                                <div class="row info">
                                    <div class="col s12 m5 time-start">
                                        <p class="info-title">Старт</p>
                                        <div class="info-item">
                                            <i class="material-icons">event</i>
                                            <span><?= date('Y-m-d', strtotime($event->date_start)) ?></span>
                                        </div>
                                        <div class="info-item">
                                            <i class="material-icons">access_time</i>
                                            <span><?= $event->time_start ?></span>
                                        </div>
                                    </div>
                                    <div class="col s12 m5 time-finish">
                                        <p class="info-title">Финиш</p>
                                        <div class="info-item">
                                            <i class="material-icons">event</i>
                                            <span><?= date('Y-m-d', strtotime($event->date_end)) ?></span>
                                        </div>
                                        <div class="info-item">
                                            <i class="material-icons">access_time</i>
                                            <span><?= $event->time_end ?></span>
                                        </div>
                                    </div>
                                    <div class="col s12 m2 graph-wrap">
                                        <div class="info-graph tooltipped"
                                             data-position="bottom"
                                             data-tooltip="Участники: 25"
                                        >
                                            <div class="graph graph-people"></div>
                                        </div>
                                        <div class="info-graph tooltipped"
                                             data-position="bottom"
                                             data-tooltip="Рейтинг: 52"
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
                                    <div class="col s12 m12">
                                        <a href="<?= Url::to(['event/view', 'id' => $event->id]) ?>"
                                           class="full-width btn teal darken-2 waves-effect waves-light more-but">Подробнее</a>
                                    </div>
                                    <div class="col s12 m12">
                                        <?=$event->getButton()?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        else:
            ?>
            <div class="row no-margin-bot">
                <div class="col s10 offset-s1 m8 offset-m2">
                    <div class="card-panel">Событий не найдено....</div>
                </div>
            </div>
            <?php
        endif;
    ?>
</div>
