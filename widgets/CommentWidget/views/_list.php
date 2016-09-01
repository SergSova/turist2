<?php

    use app\widgets\rateCounter\rateCounterWidget;

    /** @var \app\models\Comments $model */
?>

<div class="panel-info">
    <div class="panel-heading">
        <?= $model->user->username ?>
    </div>
    <div class="panel-body">
        <?= $model->text ?>
    </div>
    <div class="panel-footer">
        <?= rateCounterWidget::widget([
                                          'rate' => $model->rate,
                                          'vote' => [
                                              '/event/vote-comment',
                                              'model_id' => $model->id
                                          ]
                                      ]) ?>
    </div>
</div>