<?php

    /* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;

    /* @var $model app\models\User */

    $this->title = 'Create User';
    $this->params['breadcrumbs'][] = [
        'label' => 'Users',
        'url' => ['index']
    ];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
