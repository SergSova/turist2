<?php


    /* @var $this yii\web\View */
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\grid\GridView;

    /* @var $searchModel app\models\search\UserSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title = 'Users';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
                             'dataProvider' => $dataProvider,
                             'filterModel'  => $searchModel,
                             'columns'      => [
                                 ['class' => 'yii\grid\SerialColumn'],

                                 'id',
                                 [
                                     'attribute' => 'photo',
                                     'content'   => function($model){
                                         return $model->getPhoto();
                                     }
                                 ],
                                 'username',
                                 //            'password',
                                 //            'auth_key',
                                 'status',
                                 'email:email',
                                 // 'access_token',
                                 'created_at',
                                 'rate',
                                 'f_name',
                                 'l_name',

                                 ['class' => 'yii\grid\ActionColumn'],
                             ],
                         ]); ?>
</div>
