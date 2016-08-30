<?php


/* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\grid\ActionColumn;
    use macgyer\yii2materializecss\widgets\grid\GridView;

    /* @var $searchModel app\models\search\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'eventType.name',
            'creator.username',
            'title',
            //'photo:ntext',
            // 'desc:ntext',
            // 'organizators:ntext',
            // 'particip:ntext',
            // 'condition:ntext',
             'date_start',
             'date_end',
            // 'date_creation',
             'status',
             'rate',

            ['class' => ActionColumn::className()],
        ],
    ]); ?>
</div>
