<?php

    namespace app\widgets\CommentWidget;

    use app\models\Comments;
    use app\models\Event;
    use app\models\User;
    use yii\base\Widget;
    use yii\data\ActiveDataProvider;

    class CommentWidget extends Widget{
        /** @var Event|User $model */
        public $model;


        public function run(){
            $commentModel = new Comments();
            $commentQuery = $this->model->getComments();
            $dataProvider = new ActiveDataProvider(['query' => $commentQuery]);

            return $this->render('comment', [
                'commentModel' => $commentModel,
                'model' => $this->model,
                'dataProvider' => $dataProvider
            ]);
        }

    }