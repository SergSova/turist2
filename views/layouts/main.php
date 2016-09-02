<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\LoginForm;
use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\Breadcrumbs;
    use macgyer\yii2materializecss\widgets\Nav;
    use macgyer\yii2materializecss\widgets\NavBar;
use app\assets\AppAsset;
use yii\helpers\Url;

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
        'wrapperOptions' =>[
            'class' => 'container'
        ]
    ]);
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'События', 'url' => ['/event/event-list']],
        ['label' => 'Календарь событий', 'url' => ['/event/event-calendar']],

    ];
    if(!Yii::$app->user->isGuest){
        $menuItems[] = ['label' => 'Личный кабинет', 'url' => ['/user/index']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>
<main>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <div class="row">
            <div class="col s12 m9">
                <?= $content ?>
            </div>
            <div class="col s12 m3">
                <?php if(Yii::$app->user->isGuest && Yii::$app->controller->action->id != 'login' && Yii::$app->controller->action->id != 'registration'):?>
                    <?= $this->render('../site/inc/formLogin', ['model' => new LoginForm()]);?>
                <?php else:?>
                    <div class="collection">
                        <h5 class="collection-header center-align">Мои события</h5>
                        <a href="<?= Url::to(['event/create'])?>" class="collection-item">Добавить событие</a>
                        <a href="<?= Url::to(['event/index'])?>" class="collection-item ">Все события</a>
                    </div>
                <?php endif;?>
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
