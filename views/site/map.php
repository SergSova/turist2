<?php

    /** @var \yii\web\View $this */

    use app\components\MapParser;
    use yii\sergsova\fileManager\FileManager;

    $crd = MapParser::getInstance()->getLatLng_kml(FileManager::getInstance()->getStorageUrl().'1473169288.kml');
$js = <<<JS
var coord = JSON.parse('{$crd}');
JS;

    $this->registerJs($js , 3);
    $this->registerCssFile('/web/css/map.css', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('/web/js/map/draggable_directions.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyABhH01dCe6IhW78H8uPNfySJn-qOa1tKQ', [
        'depends' => 'app\assets\AppAsset',
        'async' => true,
        'defer' => true
    ]);

?>
<div id="map"></div>

