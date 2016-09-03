<?php

    /* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;

    /* @var $model app\models\EventType */

    $this->title = 'Update Event Type: '.$model->name;
    $this->params['breadcrumbs'][] = [
        'label' => 'Event Types',
        'url' => ['index']
    ];
    $this->params['breadcrumbs'][] = [
        'label' => $model->name,
        'url' => [
            'view',
            'id' => $model->id
        ]
    ];
    $this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
