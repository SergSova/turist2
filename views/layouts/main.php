<?php
    /* @var $this \yii\web\View */
    use app\assets\AppAsset;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\Nav;
    use macgyer\yii2materializecss\widgets\NavBar;
    use yii\helpers\Url;

    /* @var $content string */
    AppAsset::register($this);

    if(!Yii::$app->user->isGuest){
        $user = Yii::$app->user->identity;
    }

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
<body class="grey lighten-4">
<?php $this->beginBody() ?>
<header>
    <?php if(!Yii::$app->user->isGuest):?>
        <ul id="personalBox" class="dropdown-content">
            <li><a href="<?=Url::to(['/event'])?>"><div class="right"><span class="badge"><?=count($user->events)?></span></div>Мои события</a></li>
            <li><a href="#!"><div class="right"><span class="new badge">1</span></div>Мои заявки</a></li>
            <li><a href="<?=Url::to(['/user'])?>">Настройки</a></li>
            <li class="divider"></li>
            <li><a href="<?= Url::to(['user/logout'])?>" data-method="post"><i class="material-icons right">exit_to_app</i>Выход</a></li>
        </ul>
        <?php endif;?>
    <?php
        NavBar::begin([
                          'brandLabel' => '<i class="material-icons left">directions_bike</i>Go somewhere!',
                          'brandUrl' => Yii::$app->homeUrl,
                          'options' => [
                              'class' => (Yii::$app->controller->action->id == 'index') ? 'transparent': '',
                          ],
                          'fixed' => true,
                          'wrapperOptions' => [
                              'class' => 'nav-container'
                          ]
                      ]);
        $menuItems = [
            [
                'label' => '<i class="material-icons left">event</i>Все события',
                'encode' => false,
                'url' => ['/event/event-list']
            ],

        ];
        if(!Yii::$app->user->isGuest){
           $menuItems[] = [
                'label' => '<i class="material-icons left">face</i><i class="material-icons right">arrow_drop_down</i>Личный кабинет',
                'encode' => false,
                'url' => '#!',
                'linkOptions' => ['class'=> 'dropdown-button', 'data-activates'=>'personalBox']
           ];
        }else{
            $menuItems[] = [
                'label' => '<i class="material-icons left">account_box</i>Воити',
                'encode' => false,
                'url' => '#loginModal',
                'linkOptions' => ['class'=>'modal-trigger']
            ];
        }
        echo Nav::widget([
                             'items' => $menuItems,
                             'options' => ['class'=> 'right hide-on-med-and-down']
                         ]);
        NavBar::end();
    ?>
</header>
<main>
    <?= $content ?>
</main>
<footer></footer>
<?= $this->render('_loginModal'); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>