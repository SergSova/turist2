<?php
    /** @var \app\models\User $model */
    use macgyer\yii2materializecss\lib\Html;

?>
<p class="chip"><?= $model->username ?>
    <?= Html::a('<i class="close material-icons">add</i>', [
            'add',
            'id' => $model->id
        ], ['data-pjax' => true]) ?>
</p>
