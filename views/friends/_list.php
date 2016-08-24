<?php
    /** @var \app\models\User $model */

?>
<div class="row friend-info">
    <div class="user_id" hidden><?= $model->id ?></div>
    <div class="col-lg-6">
        <?= $model->username ?>
    </div>
    <div class="col-lg-6">
        <?= $model->f_name.' '.$model->l_name ?>
    </div>
</div>
