<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            [
                'label'=>'Тип события',
                'value'=>$model->eventType->name
            ],
            'creator_id',
            'title',
            'photo:ntext',
            'desc:ntext',
            [
                'label'=>'Организаторы',
                'value'=>$model->getOrganizatorsList()
            ],
            'particip:ntext',
            'condition:ntext',
            'date_start',
            'date_end',
            'date_creation',
            'status',
            'rate',
        ],
    ]) ?>

</div>
