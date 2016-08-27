<?php

    use app\widgets\ComentWidget\ComentWidget;
    use app\widgets\rateCounter\rateCounterWidget;
    use yii\bootstrap\ActiveForm;
    use yii\grid\GridView;
    use yii\helpers\Html;

    /* @var $this yii\web\View */
    /* @var $model app\models\Event */
    /** @var \yii\data\ActiveDataProvider $participantsDataProvider */
    /** @var \yii\data\ActiveDataProvider $pendingDataProvider */
    /** @var \app\models\Coments $comentModel */

    $this->title = $model->title;
    $this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
    $event = $model;
?>
<div class="event-view">

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
            <? if(Yii::$app->user->can('createPost')): ?>
                <label for="w0">Запросы на участие</label>
                <?= GridView::widget([
                                         'dataProvider' => $pendingDataProvider,
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
            <? endif ?>
            <label for="w0">Участники</label>
            <?= GridView::widget([
                                     'dataProvider' => $participantsDataProvider,
                                     'columns'      => [
                                         ['class' => 'yii\grid\SerialColumn'],

                                         'user.username',
                                         [
                                             'attribute' => 'user.rate',
                                             'content'   => function($data){
                                                 return rateCounterWidget::widget([
                                                                                      'rate' => $data->user->rate,
                                                                                      'vote' => [
                                                                                          'user/vote-user',
                                                                                          'model_id' => $data->user->id
                                                                                      ],
                                                                                  ]);
                                             }
                                         ],
                                         [
                                             'label'   => 'ФИО',
                                             'content' => function($data){
                                                 return $data->user->f_name.' '.$data->user->l_name;
                                             }
                                         ],
                                         'user.email',
                                         [
                                             'label'   => 'Подтверждение',
                                             'content' => function($data){
                                                 return Yii::$app->user->can('updatePost', ['event' => $data->event]) ? Html::tag('div', Html::a('Отказать', [
                                                     'confirm-particip',
                                                     'id'      => $data->id,
                                                     'confirm' => false,
                                                 ], ['data-pjax' => 0]), ['class' => 'row']) : '';
                                             }
                                         ],

                                     ],
                                 ]) ?>
        </div>
        <div class="panel-footer">
            <?php if(Yii::$app->user->can('updatePost', ['event' => $model])): ?>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data'  => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post',],
                ]) ?>
            <?php endif; ?>
            <div class="text-right">Создано: <?= $model->date_creation ?></div>
            <div class="text-right">Рейтинг: <?= $model->rate ?></div>
            <div class="text-right">Создатель: <strong><?= $model->creator->username ?></strong></div>
        </div>
    </div>

    <div class="form-coment">
        <?php $comentForm = ActiveForm::begin([
                                                  'action'  => 'add-coment',
                                                  'options' => ['class' => 'form-inline'],
                                              ]) ?>
        <?= $comentForm->field($comentModel, 'text')
                       ->textarea(['rows' => 6, 'placeholder' => 'Ваш комментарий']) ?>
        <?= $comentForm->field($comentModel, 'user_id')
                       ->hiddenInput(['value' => Yii::$app->user->id]) ?>
        <?= $comentForm->field($comentModel, 'event_id')
                       ->hiddenInput(['value' => $model->id]) ?>
        <?= Html::submitButton('Отправить'); ?>
        <?php ActiveForm::end() ?>
    </div>

    <?= ComentWidget::widget([
                                 'model_id' => $model->id
                             ]) ?>
</div>
