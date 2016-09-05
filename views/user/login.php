<?php

    /* @var $this yii\web\View */
    /* @var $form yii\bootstrap\ActiveForm */
    /* @var $model app\models\LoginForm */

    $this->title = 'Login';
?>
<div class="site-login">
    <div class="row">
        <div class="col s12 m8 offset-m3 l6 offset-l5">
            <?php if($model->hasErrors()): ?>
                <div class="card-panel materialize-red center-align">Ошибка входа!</div>
            <?php endif; ?>
            <?= $this->render('inc/formLogin', ['model' => $model]); ?>
        </div>
    </div>

</div>
