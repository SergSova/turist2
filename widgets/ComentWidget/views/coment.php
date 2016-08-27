<?php
    use yii\widgets\ListView;

    /** @var \yii\data\ActiveDataProvider $dataProvider */
?>
<?= ListView::widget([
                         'dataProvider' => $dataProvider,
                         'itemView'     => '_list'
                     ]) ?>
