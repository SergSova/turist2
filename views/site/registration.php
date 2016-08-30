<?php

    /* @var $this yii\web\View */
    /* @var $form yii\bootstrap\ActiveForm */
    /* @var $model app\models\RegistrationForm */

    use app\widgets\FileManagerWidget\FileManagerWidget;
    use app\widgets\uLogin\uLoginWidget;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use yii\helpers\Url;

    $this->title = 'Registration';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
                                        'id'          => 'registr-form',
                                        'options'     => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
                                        'fieldConfig' => [
                                            'template'     => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                            'labelOptions' => ['class' => 'col-lg-1 control-label'],

                                        ],
                                    ]); ?>

    <?= $form->field($model, 'username')
             ->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'email')
             ->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')
             ->passwordInput() ?>
    <?= $form->field($model, 'password_repeat')
             ->passwordInput() ?>


    <?= Html::activeHiddenInput($model, 'photo', ['id' => 'user-photo']) ?>
    <?= FileManagerWidget::widget([
                                      'uploadUrl' => Url::to(['user-upload-photo']),
                                      'removeUrl' => Url::to(['user-remove-photo']),
                                      'maxFiles' => 1,
                                      'targetInputId' => 'user-photo',
                                      'files' => $model->photo
                                  ]) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?= uLoginWidget::widget(['redirect' => '/site/token']) ?>
</div>
