<?php

    /* @var $this yii\web\View */
    /* @var $form yii\bootstrap\ActiveForm */
    /* @var $model \app\models\forms\RegistrationForm */

    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;

    $this->title = 'Registration';
?>
<div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card-panel">
            <?php
                $form = ActiveForm::begin([
                                              'fieldConfig' => [
                                                  'template' => "{input}\n{label}\n{error}"
                                              ]
                                          ]);
            ?>
                    <h3>Регистрация</h3>
                    <?= $form->field($model, 'username') ?>
                    <?= $form->field($model, 'email')
                             ->input('email') ?>
                    <?= $form->field($model, 'password_repeat')
                             ->passwordInput() ?>
                    <?= $form->field($model, 'password')
                             ->passwordInput() ?>
                </div>
                <div class="card-action">
                    <?= Html::submitButton('Зарегистрироваться<i class="material-icons right">send</i>',
                                           ['class' => 'btn waves-effect waves-light full-width']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
