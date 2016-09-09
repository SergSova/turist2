<?php
    /**
     * @var \app\models\forms\LoginForm $model
     * @var \yii\web\View         $this
     */
    use app\widgets\uLogin\uLoginWidget;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;

?>
        <?php
            $form = ActiveForm::begin([
                                          'action' => ['user/login'],
                                          'method' => 'post',
                                          'fieldConfig' => [
                                              'template' => "{input}\n{label}\n{error}"
                                          ]
                                      ]);
        ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <p>
            <?= Html::activeInput('checkbox', $model, 'rememberMe', [
                'id' => 'rm',
                'checked' => true
            ]) ?>
            <label for="rm">Запомнить меня</label>
        </p>
            <?php if($model->hasErrors()): ?>
            <div class="row">
                <div class="col s12 m6">
                    <?= Html::submitButton('Войти<i class="material-icons right">send</i>', ['class' => 'btn waves-effect waves-light full-width']) ?>
                </div>

                <div class="col s12 m6">
                    <?= Html::a('Забыли пароль?<i class="material-icons right">restore</i>', ['site/restore'],
                                ['class' => 'btn light-blue waves-effect waves-light full-width']) ?>
                </div>
            </div>
            <?php else: ?>
                <div class="row">
                    <div class="col s10 offset-s1 m8 offset-m2">
                        <?= Html::submitButton('Войти<i class="material-icons right">send</i>', ['class' => 'btn waves-effect waves-light full-width']) ?>
                    </div>
                </div>
            <?php endif;?>

        <?php ActiveForm::end(); ?>
        <div class="row center-align">
            <div class="col s10 offset-s1 m8 offset-m2">
                <div class="card-panel">
                    <?= uLoginWidget::widget([
                                                 'redirect' => \yii\helpers\Url::to(['user/login'])
                                             ]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s10 offset-s1 m8 offset-m2">
                <?= Html::a('Регистрация<i class="material-icons right">account_circle</i>', ['user/registration'],
                            ['class' => 'btn amber waves-effect waves-light full-width']) ?>
            </div>
        </div>





