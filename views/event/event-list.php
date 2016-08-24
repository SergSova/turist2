<?php
    /** @var \yii\data\ActiveDataProvider $dataProvider */
    use yii\widgets\ListView;

    $events =  $dataProvider->models
    ?>
<?php
    $flashMessages = Yii::$app->session->getAllFlashes();
    if ($flashMessages) {
        echo '<ul class="flashes">';
        foreach($flashMessages as $key => $message) {
            echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
        }
        echo '</ul>';
    }
?>
<?=ListView::widget([
    'dataProvider'=>$dataProvider,
    'itemView'=>'_list'
                    ])?>