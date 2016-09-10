<?php

    use macgyer\yii2materializecss\lib\Html;

    /**
     * @var \app\models\Event $model
     * @var                   $this yii\web\View
     */
    $this->title = 'Изменить: '.$model->title;
?>
<div class="event-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
