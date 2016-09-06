<?php
    /** @var string $newEmail */
    use macgyer\yii2materializecss\lib\Html;

    $resetLink = Yii::$app->urlManager->createAbsoluteUrl([
                                                              'user/change-email-token',
                                                              'token' => $user->password_reset_token,
                                                              'newEmail' => $newEmail
                                                          ]);
?>

    Получен запрос на изменение почты на <?= $newEmail ?>
    <br>
    Для изменения почты перейдите по ссылке <?= Html::a(Html::encode($resetLink), $resetLink) ?>