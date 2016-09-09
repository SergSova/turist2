<?php
    /**
     * @var \yii\base\View $this
     */
    use app\models\forms\LoginForm;

?>
<div id="loginModal" class="modal">
    <div class="modal-content">
        <h4 class="center-align">Вход</h4>
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <?= $this->render('//user/inc/formLogin', ['model' => new LoginForm()]) ?>
            </div>
        </div>
    </div>
</div>