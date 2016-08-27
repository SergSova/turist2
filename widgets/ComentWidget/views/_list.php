<?php

    use app\widgets\rateCounter\rateCounterWidget;

    /** @var \app\models\Coments $model */
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
                                          'vote' => ''
                                      ]) ?>
    </div>
</div>