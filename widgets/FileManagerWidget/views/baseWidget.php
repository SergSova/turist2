<?php
    use yii\sergsova\fileManager\FileManager;

    /**
     * @var array $notSavedFiles
     * @var array $savedFiles
     */

?>
<div class="fmw-container card" id="fmw">
    <div class="card-content">
        <span class="card-title">Gallery Upload Photo</span>
        <div class="fmw-content">
            <?php
                if(!empty($notSavedFiles)):
                    ?>
                    <div class="card red lighten-2 fmw-notsaved">
                        <div class="card-content">
                            <span class="card-title">Not Saved Files</span>
                            <div class="row fmw-notsaved-gallery">
                                <?php foreach($notSavedFiles as $file): ?>
                                    <div class="col l6 fmw-notsaved-item">
                                        <img src="<?= FileManager::getInstance()->getStorageUrl().$file ?>">
                                        <div class="fmw-actions">
                                            <button type="button" class="btn red fmw-removeBtn" data-path="<?= $file ?>">
                                                <i class="material-icons">remove</i>
                                            </button>
                                            <button type="button" class="btn green fmw-replaceBtn" data-path="<?= $file ?>">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
            ?>
            <div class="fmw-messageBox" id="fmw-messageBox">
                <?php if(empty($savedFiles)): ?>
                    <div class="fmw-message card-panel red lighten-2">Нет загруженых файлов</div>
                <?php endif; ?>
            </div>
            <div class="fmw-galleryBox row" id="fmw-galleryBox">
                <?php
                    if(!empty($savedFiles)):
                        foreach($savedFiles as $file):
                            ?>
                            <div class="col l6 fmw-galleryBox-item">
                                <img src="<?= FileManager::getInstance()->getStorageUrl().$file?>">
                                <div class="fmw-actions">
                                    <button type="button" class="btn red fmw-removeBtn" data-path="<?= $file?>">
                                        <i class="material-icons">remove</i>
                                    </button>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                ?>
            </div>
            <div class="fmw-preloader" id="fmw-preloader">
                <span>Loading....</span>
            </div>
        </div>
    </div>
    <div class="card-action">
        <div class="file-field input-field">
            <div class="btn">
                <span>File</span>
                <input type="file" name="<?= FileManager::getInstance()->getAttributeName()?>" class="form-control" id="fmw-input">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
        </div>
    </div>
</div>
