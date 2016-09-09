<?php

    /** @var \yii\web\View $this */

    use app\components\MapParser\MapParser;

    $crd = MapParser::getInstance()->getLatLng($path);
$js = <<<JS
var coord = JSON.parse('{$crd}');
init2();
JS;

    $this->registerCssFile('/web/css/map.css', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('/web/js/map/draggable_directions.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyABhH01dCe6IhW78H8uPNfySJn-qOa1tKQ', [
        'depends' => 'app\assets\AppAsset',
    ]);
    $this->registerJs($js,3);

?>
<div id="map"></div>

