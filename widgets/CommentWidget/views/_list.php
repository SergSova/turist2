<?php

use app\widgets\rateCounter\rateCounterWidget;

/** @var \app\models\Comments $model */
?>

<div class="card">
    <div class="card-title">
        <?= $model->user->username ?>
    </div>
    <div class="card-content">
        <?= $model->text ?>
    </div>
    <div class="card-action">
        <?= rateCounterWidget::widget([
            'rate' => $model->rate,
            'action_vote' => [
                '/event/vote-comment',
                'model_id' => $model->id
            ]
        ]) ?>
    </div>
</div>