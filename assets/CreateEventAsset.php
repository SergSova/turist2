<?php

    namespace app\assets;

    use yii\web\AssetBundle;

    class CreateEventAsset extends AssetBundle{
        public $basePath = '@webroot';
        public $baseUrl  = '@web';
        public $css      = [
        ];
        public $js       = [
            'js/autocomplete.js', 'js/eventForm.js'
        ];
        public $depends  = [
            'app\assets\AppAsset'
        ];
    }