<?php

    use yii\helpers\Html;
    use yii\widgets\DetailView;

    /* @var $this yii\web\View */
    /* @var $model app\models\Event */
    /** @var \yii\data\ActiveDataProvider $participDataProvider */

    $this->title = $model->title;
    $this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">


    <p>

    </p>

    <div class="panel-default">
        <div class="panel-heading">
            Событие: <?= Html::encode($this->title) ?>
            <b><?= $model->status ?></b>
        </div>
        <div class="panel-body">
            <label for="desc">Описание</label>
            <div id="desc">
                <?= $model->desc ?>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-9">
                    <div class="alert-info">
                        <label for="dateStart">Дата начала</label>
                        <div id="dateStart"><?= $model->date_start ?></div>
                    </div>
                    <div class="alert-danger">
                        <label for="dateEnd">Дата завершения</label>
                        <div id="dateEnd"><?= $model->date_end ?></div>
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    Timer
                </div>
            </div>
            <?php if($model->condition): ?>
                <br>
                <label for="conditionData">Требования</label>
                <table class="table table-striped conditionData" id="conditionData">
                    <?php $conditions = json_decode($model->condition);
                        foreach($conditions as $condition): ?>
                            <tr>
                                <?php foreach($condition as $key => $value): ?>
                                    <td class="col-lg-6 "><?= $key ?>:</td>
                                    <td class="col-lg-6"><?= $value ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                </table>
            <?php endif; ?>

            <label for="w0">Запросы на участие</label>
            <?= \yii\grid\GridView::widget([
                                               'dataProvider' => $participDataProvider,
                                               'columns'      => [
                                                   ['class' => 'yii\grid\SerialColumn'],

                                                   'user.username',
                                                   'confirmedtext',
                                                   [
                                                       'label'   => 'Подтверждение',
                                                       'content' => function($data){
                                                           return Html::a('Подтвердить', [
                                                               'confirm-particip',
                                                               'id' => $data->id
                                                           ], ['data-pjax' => 0]).' | '.Html::a('Отказать', [
                                                               'confirm-particip',
                                                               'id'      => $data->id,
                                                               'confirm' => false,
                                                           ], ['data-pjax' => 0]);
                                                       }
                                                   ]
                                               ],
                                           ]) ?>
        </div>
        <div class="panel-footer">
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data'  => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method'  => 'post',
                ],
            ]) ?>
            <div class="text-right">Создано: <?= $model->date_creation ?></div>
            <div class="text-right">Рейтинг: <?= $model->rate ?></div>
            <div class="text-right">Создатель: <strong><?= $model->creator->username ?></strong></div>
        </div>
    </div>


    <? /*= DetailView::widget([
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
    ]) */ ?>

</div>
