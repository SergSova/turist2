<?php

    /* @var $this yii\web\View */
    /* @var $form yii\bootstrap\ActiveForm */
    /* @var $model app\models\LoginForm */

    $this->title = 'Login';
?>
<div class="site-login">
    <div class="row">
        <div class="col s12 m8 offset-m2 l6 offset-l3">
            <?php if($model->hasErrors()): ?>
                <div class="card-panel materialize-red center-align">Ошибка входа!</div>
            <?php endif; ?>
            <div class="card-panel">
                <?= $this->render('inc/formLogin', ['model' => $model]); ?>
            </div>
        </div>
    </div>

</div>
