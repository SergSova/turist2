<?php
    namespace app\widgets\FileManagerWidget;

    use Yii;
    use yii\sergsova\fileManager\FileManager;
    use yii\base\Widget;
    use yii\web\View;

    /**
     * Class FileManagerWidget
     * @package app\widgets\FileManagerWidget
     */
    class FileManagerWidget extends Widget{
        public $uploadUrl;
        public $removeUrl;
        public $files;
        public $targetInputId;
        public $maxFiles;

        public function init(){
            parent::init();
            if($this->files){
                $this->files = json_decode($this->files);
            }
        }

        public function run(){

            $notSaveFiles = FileManager::getFilesFromSession();

            $script = <<<JS
var fileManagerWidgetSetting = {
    uploadUrl: "{$this->uploadUrl}",
    removeUrl: "{$this->removeUrl}",
    targetInputId: "{$this->targetInputId}",
    maxFiles: "{$this->maxFiles}"
}

JS;
            Yii::$app->getView()
                     ->registerJs($script, View::POS_END);
            FileManagerWidgetAsset::register(Yii::$app->getView());

            return $this->render('baseWidget', [
                'notSavedFiles' => $notSaveFiles,
                'savedFiles' => $this->files,
            ]);
        }
    }