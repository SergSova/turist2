<?php
    /**
     * @var \app\models\LoginForm $model
     * @var \yii\web\View         $this
     */
    use app\widgets\uLogin\uLoginWidget;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;

?>
<div class="card">
    <div class="card-content <?= ($model->hasErrors()) ? 'invalid' : ''; ?>">
        <p class="card-title">Вход</p>
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
        <?= $form->field($model, 'password') ?>
        <div class="input-field checkbox-wrap">
            <?= Html::activeInput('checkbox', $model, 'rememberMe', [
                'id' => 'rm',
                'checked' => true
            ]) ?>
            <label for="rm">Запомнить меня</label>
        </div>
        <?php if($model->hasErrors()): ?>
            <div class="row">
                <div class="col s12 m6">
                    <?= Html::submitButton('Войти<i class="material-icons right">send</i>', ['class' => 'btn waves-effect waves-light fullWidth']) ?>
                </div>
                <div class="col s12 m6">
                    <?= Html::a('Забыли пароль?<i class="material-icons right">restore</i>', ['site/restore'],
                                ['class' => 'btn light-blue waves-effect waves-light fullWidth']) ?>
                </div>
            </div>
        <?php else: ?>
            <?= Html::submitButton('Войти<i class="material-icons right">send</i>', ['class' => 'btn waves-effect waves-light fullWidth']) ?>
        <?php endif; ?>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="card-action">
        <div class="row  center-align">
            <?= uLoginWidget::widget([
                                         'redirect' => \yii\helpers\Url::to(['user/login'])
                                     ]) ?>
        </div>
        <?= Html::a('Регистрация<i class="material-icons right">account_circle</i>', ['user/registration'],
                    ['class' => 'btn amber waves-effect waves-light fullWidth']) ?>
    </div>
</div>




