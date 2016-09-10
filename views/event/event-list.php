<?php
    /**
     * @var \yii\data\ActiveDataProvider   $dataProvider
     * @var \app\models\search\EventSearch $searchModel
     */

    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use yii\helpers\Url;
    use yii\widgets\ListView;
    use yii\widgets\Pjax;

    $events = $dataProvider->models
?>
<?= $this->render('_search', ['model' => $searchModel]) ?>

<?php Pjax::begin() ?>
<div class="page-content">
    <?= ListView::widget([
                             'dataProvider' => $dataProvider,
                             'itemView'     => '_list',
                             'layout'       => '{items}{summary}{pager}'
                         ]) ?>
</div>
<?php Pjax::end() ?>