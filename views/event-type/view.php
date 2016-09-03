<?php

    /* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\data\DetailView;

    /* @var $model app\models\EventType */

    $this->title = $model->name;
    $this->params['breadcrumbs'][] = [
        'label' => 'Event Types',
        'url' => ['index']
    ];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', [
            'update',
            'id' => $model->id
        ], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', [
            'delete',
            'id' => $model->id
        ], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
    </p>

    <?= DetailView::widget([
                               'model' => $model,
                               'attributes' => [
                                   'id',
                                   'name',
                               ],
                           ]) ?>

</div>
