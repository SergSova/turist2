<?php

    /* @var $this yii\web\View */
    /* @var $form yii\bootstrap\ActiveForm */
    /* @var $model app\models\RegistrationForm */

    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;

    $this->title = 'Registration';
?>
<div class="row">
    <div class="col s12 m8 offset-m3 l6 offset-l5">
        <?php
            $form = ActiveForm::begin([
                                          'fieldConfig' => [
                                              'template' => "{input}\n{label}\n{error}"
                                          ]
                                      ]);
        ?>
        <div class="card">
            <div class="card-content">
                <p class="card-title">Регистрация</p>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email')
                         ->input('email') ?>
                <?= $form->field($model, 'password_repeat') ?>
                <?= $form->field($model, 'password') ?>
            </div>
            <div class="card-action">
                <?= Html::submitButton('Зарегистрироваться<i class="material-icons right">send</i>',
                                       ['class' => 'btn waves-effect waves-light fullWidth']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
