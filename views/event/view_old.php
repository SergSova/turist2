<?php

    use app\widgets\CommentWidget\CommentWidget;
    use app\widgets\rateCounter\rateCounterWidget;
    use esoftkz\timer\Timer;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\grid\GridView;
    use macgyer\yii2materializecss\widgets\Modal;
    use yii\helpers\Json;
    use yii\sergsova\fileManager\FileManager;

    /**
     * @var                              $this yii\web\View
     *
     * @var \app\models\Event            $model
     * @var \yii\data\ActiveDataProvider $participantsDataProvider
     * @var \yii\data\ActiveDataProvider $pendingDataProvider
     * @var \app\models\Comments         $commentModel
     */
    $this->title = $model->title;

    $conditions = $model->condition ? json_decode($model->condition) : null;

?>
<div class="event-view">
    <?php if($model->track_path && file_exists(FileManager::getInstance()
                                                          ->getStoragePath().Json::decode($model->track_path)[0])
    ): ?>
        <?= Html::a('Скачать трек', [
            'download-track',
            'path' => Json::decode($model->track_path)[0]
        ], ['class' => 'btn']) ?>
        <div class="card-panel">
            <?= $this->render('//site/map', [
                'path' => FileManager::getInstance()
                                     ->getStoragePath().Json::decode($model->track_path)[0]
            ]) ?>
            <?php Modal::begin(['toggleButton' => ['label' => 'Показать трек']]) ?>
            <?php Modal::end() ?>
        </div>
    <?php endif; ?>
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
                    <?= Timer::widget([
                                          'clientOptions' => [
                                              'scaleColor' => true,
                                              'trackColor' => 'rgba(255,255,255,0.3)',
                                              'barColor' => '#E7F7F5',
                                              'lineWidth' => 6,
                                              'lineCap' => 'butt',
                                              'size' => 50
                                          ],
                                          'endTimeStamp' => $model->date_end,
                                      ]) ?>
                </div>
            </div>
            <?php if($conditions): ?>
                <br>
                <label for="conditionData">Требования</label>
                <table class="table table-striped conditionData" id="conditionData">
                    <?php foreach($conditions as $condition): ?>
                        <tr>
                            <?php foreach($condition as $key => $value): ?>
                                <td class="col-lg-6 "><?= $key ?>:</td>
                                <td class="col-lg-6"><?= $value ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
            <?php if(Yii::$app->user->can('updatePost', ['event' => $model])): ?>
                <label for="w0">Запросы на участие</label>
                <?= GridView::widget([
                                         'dataProvider' => $pendingDataProvider,
                                         'columns' => [
                                             ['class' => '\yii\grid\SerialColumn'],
                                             'user.username',
                                             'confirmedtext',
                                             [
                                                 'label' => 'Подтверждение',
                                                 'content' => function($data){
                                                     return Html::a('Подтвердить', [
                                                         'confirm-particip',
                                                         'id' => $data->id
                                                     ], ['data-pjax' => 0]).' | '.Html::a('Отказать', [
                                                         'confirm-particip',
                                                         'id' => $data->id,
                                                         'confirm' => false,
                                                     ], ['data-pjax' => 0]);
                                                 }
                                             ]
                                         ],
                                     ]) ?>
            <?php endif; ?>
            <label for="w0">Участники</label>
            <?= GridView::widget([
                                     'dataProvider' => $participantsDataProvider,
                                     'columns' => [
                                         ['class' => 'yii\grid\SerialColumn'],
                                         [
                                             'attribute' => 'user.photo',
                                             'content' => function($data){
                                                 return $data->user->getPhoto();
                                             }
                                         ],
                                         'user.username',
                                         [
                                             'attribute' => 'user.rate',
                                             'content' => function($data){
                                                 return rateCounterWidget::widget([
                                                                                      'rate' => $data->user->rate,
                                                                                      'action_vote' => [
                                                                                          'user/vote-user',
                                                                                          'model_id' => $data->user->id
                                                                                      ],
                                                                                  ]);
                                             }
                                         ],
                                         [
                                             'label' => 'ФИО',
                                             'content' => function($data){
                                                 return $data->user->f_name.' '.$data->user->l_name;
                                             }
                                         ],
                                         'user.email',
                                         [
                                             'label' => 'Подтверждение',
                                             'content' => function($data){
                                                 return Yii::$app->user->can('updatePost', ['event' => $data->event]) ? Html::tag('div',
                                                                                                                                  Html::a('Отказать',
                                                                                                                                          [
                                                                                                                                              'confirm-particip',
                                                                                                                                              'id' => $data->id,
                                                                                                                                              'confirm' => false,
                                                                                                                                          ],
                                                                                                                                          ['data-pjax' => 0]),
                                                                                                                                  ['class' => 'row']) : '';
                                             }
                                         ],

                                     ],
                                 ]) ?>
        </div>
        <div class="panel-footer">
            <?php if(Yii::$app->user->can('updatePost', ['event' => $model])): ?>
                <?= Html::a('Изменить', [
                    'update',
                    'id' => $model->id
                ], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', [
                    'delete',
                    'id' => $model->id
                ], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
            <?php endif; ?>
            <div class="text-right">Создано: <?= $model->date_creation ?></div>
            <div class="text-right">Рейтинг: <?= $model->rate ?></div>
            <div class="text-right">Создатель: <strong><?= $model->creator->username ?></strong></div>
        </div>
    </div>

    <?= CommentWidget::widget([
                                  'model' => $model
                              ]) ?>
</div>
