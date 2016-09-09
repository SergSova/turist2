<?php

    /* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;

    /* @var $model app\models\Event */
    /** @var \yii\data\ActiveDataProvider $dataProvider */

    $this->title = 'Создать событие';
?>
<div class="event-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
