<?php
    /** @var \app\models\Event $model */
    use yii\bootstrap\Modal;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

?>
<?php \yii\widgets\Pjax::begin()?>
<div class="form-inline">
    <div class="alert-success col-lg-3"><?= $model->title ?></div>
    <div class="alert-danger col-lg-3"><?= $model->desc ?></div>
    <div class="alert-info col-lg-3"><?= $model->creator->username ?></div>
    <div class="col-lg-3">
        <?php
            $particip = $model->getParticEvents()
                              ->where(['event_id' => $model->id, 'user_id' => Yii::$app->user->id])
                              ->one();
            if(!$particip){
                if($model->eventType->name == 'registred' && !$particip->confirmed){
                    Modal::begin([
                                     'header'       => '<h2>Отправить запрос на добавление</h2>',
                                     'toggleButton' => [
                                         'tag'   => 'a',
                                         'class' => '',
                                         'label' => 'Подать заявку!',
                                     ]
                                 ]);

                    $form = ActiveForm::begin(['action' => ['event/send-confirm']]);
                    echo Html::hiddenInput('Mail[event_id]', $model->id);
                    echo Html::textarea('Mail[body]', null, ['class' => 'col-lg-12']);
                    echo Html::submitButton('Отправить');
                    ActiveForm::end();
                    Modal::end();;
                }else{
                    echo Html::a('Участвовать', ['/event/add-particip', 'id' => $model->id]);
                }
            }else{
                if(!$particip->confirmed){
                    echo 'подтвеждается ';
                    echo Html::a('Отменить', ['/event/remove-particip', 'id' => $model->id]);
                }else{
                    echo Html::a('Отменить', ['/event/remove-particip', 'id' => $model->id]);
                }
            }
        ?>
    </div>
</div>
<?php \yii\widgets\Pjax::end()?>