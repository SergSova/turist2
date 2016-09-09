<?php

    /* @var $this \yii\web\View */
    /* @var $content string */

    use app\models\Comments;
    use app\models\forms\LoginForm;
    use app\models\search\EventSearch;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\Nav;
    use macgyer\yii2materializecss\widgets\NavBar;
    use app\assets\AppAsset;
    use yii\helpers\Url;
    use yii\web\JsExpression;
    use yii2fullcalendar\yii2fullcalendar;

    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header>
    <?php
        NavBar::begin([
                          'brandLabel' => 'Туристы!',
                          'brandUrl' => Yii::$app->homeUrl,
                          'options' => [
                              'class' => 'teal navbar-fixed-top',
                          ],
                          //                          'wrapperOptions' => [
                          //                              'class' => 'container'
                          //                          ]
                      ]);
        $menuItems = [
            [
                'label' => 'Главная',
                'url' => ['/site/index']
            ],
            [
                'label' => 'События',
                'url' => ['/event/event-list']
            ],
            [
                'label' => 'Календарь событий',
                'url' => ['/event/event-calendar']
            ],

        ];
        if(!Yii::$app->user->isGuest){
            //            $menuItems[] = [
            //                'label' => 'Личный кабинет',
            //                'url' => ['/user/index']
            //            ];
            $menuItems[] = '<li>'.Html::beginForm(['/user/logout'], 'post',
                                                  ['class' => 'navbar-form']).Html::submitButton('Выйти ('.Yii::$app->user->identity->username.')',
                                                                                                 ['class' => 'btn btn-link']).Html::endForm().'</li>';
        }
        echo Nav::widget([
                             'options' => ['class' => 'right'],
                             'items' => $menuItems,
                         ]);
        NavBar::end();
    ?>
</header>
<main>
    <div class="row">
        <div class="col s12 m9">
            <?= $content ?>
        </div>
        <div class="col s12 m3">
            <?php if(Yii::$app->user->isGuest && Yii::$app->controller->action->id != 'login' && Yii::$app->controller->action->id != 'registration'): ?>
                <?= $this->render('//user/inc/formLogin', ['model' => new LoginForm()]); ?>
            <?php else: ?>
                <div class="collection">
                    <h5 class="collection-header center-align">Мои события</h5>
                    <a href="<?= Url::to(['event/create']) ?>" class="collection-item">Добавить событие</a>
                    <a href="<?= Url::to(['event/index']) ?>" class="collection-item ">Все события</a>
                </div>
            <?php endif; ?>
            <div class="card-panel">
                <?php $eventsSearch = new EventSearch();
                    $eventsSearch->status = 'active';
                    $events = $eventsSearch->searchCalendar(Yii::$app->request->post()); ?>
                <?= yii2fullcalendar::widget([
                                                 'events' => $events,
                                                 'options' => [
                                                     'id' => 'calendar',
                                                     'lang' => 'ru',
                                                 ],
                                                 'clientOptions' => [
                                                     'eventClick' => new JsExpression('function(calEvent, jsEvent, view) {
                                    jsEvent.preventDefault();
var eventTitle = $("#eventHeading");
var eventBody = $("#eventBody");
var buttonRedirect = $("#buttonRedirect");
var eventPopup = $("#eventPopup");

eventTitle.text(calEvent.title);
eventBody.text(calEvent.description);
buttonRedirect.attr("href", calEvent.url);
eventPopup.css({
    background: calEvent.backgroundColor?calEvent.backgroundColor:"white",
    display: "block",
    top: (parseInt(jsEvent.pageY) - $(window).scrollTop()) + "px",
    left: jsEvent.pageX
});
}')
                                                 ]

                                             ]); ?>
            </div>
            <div class="card-panel">
                <p class="card-title">Комментарии</p>
                <?php $comments = Comments::find()
                                                      ->orderBy(['id' => 'DESC'])
                                                      ->limit(10)
                                                      ->all(); ?>
                <?php foreach($comments as $comment): ?>
                    <div class="card-panel">
                        <?= Html::a($comment->user->username, [
                            '//friends/add',
                            'id' => $comment->user->id,
                            'return' => Url::to('')
                        ], [
                                        'data-confirm' => 'Добавить '.$comment->user->username.' вам в друзья?',
                                        'data-pjax' => true
                                    ]) ?> :
                        <?= $comment->text ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<footer class="footer">
    <div class="divider"></div>
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
