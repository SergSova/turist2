<?php
    use macgyer\yii2materializecss\lib\Html;


?>

<?=Html::a('Создать',['create-event-type'])?>
<?php  foreach($model as $item):?>
        <div class="card-panel">
            <?= $item->name ?>
            <?= Html::a('редактировать', [
                'update-event-type',
                'id' => $item->id
            ]) ?>

            <?= Html::a('удалить', [
                'delete-event-type',
                'id' => $item->id
            ], ['data-confirm' => "Вы уверены, что хотите удалить этот элемент?"]) ?>
        </div>
    <?php endforeach; ?>
