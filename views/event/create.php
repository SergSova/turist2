<?php


    /* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;

    /* @var $model app\models\Event */
    /** @var \yii\data\ActiveDataProvider $dataProvider */

    $this->title = 'Create Event';
    $this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
