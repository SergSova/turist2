<?php
    use macgyer\yii2materializecss\lib\Html;


?>

<?=Html::a('Создать',['create-org-role'])?>

<?php foreach($model as $item):?>
        <div class="card-panel">
            <?= $item->name ?>
            <?= $item->desc ?>
            <?= Html::a('редактировать', [
                'update-org-role',
                'id' => $item->id
            ]) ?>

            <?= Html::a('удалить', [
                'delete-org-role',
                'id' => $item->id
            ], ['data-confirm' => "Вы уверены, что хотите удалить этот элемент?"]) ?>
        </div>
    <?php endforeach; ?>
