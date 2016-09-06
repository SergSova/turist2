<?php

    /* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;

    /* @var $model app\models\EventType */

    $this->title = 'Create Event Type';
?>
<div class="event-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
