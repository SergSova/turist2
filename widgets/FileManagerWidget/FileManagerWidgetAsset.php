<?php
    namespace app\widgets\FileManagerWidget;

    use yii\web\AssetBundle;

    /**
     * Class FileManagerWidgetAsset
     * @package backend\widgets\FileManagerWidget
     */
    class FileManagerWidgetAsset extends AssetBundle{
        public $sourcePath = '@app/widgets/FileManagerWidget/assets';

        public $css = ['fileManagerWidget.css'];
        public $js  = [
            'fileManager.js',
            'fileManagerWidget.js'
        ];

        public $depends = [
            'app\assets\AppAsset'
        ];
    }
