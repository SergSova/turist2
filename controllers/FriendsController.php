<?php

    namespace app\controllers;

    use Yii;
    use app\models\Friends;
    use app\models\search\FriendsSearch;
    use yii\helpers\ArrayHelper;
    use yii\web\Controller;

    /**
     * FriendsController implements the CRUD actions for Friends model.
     */
    class FriendsController extends Controller{

        public function actionIndex(){
            $model = new Friends(['user_id' => Yii::$app->user->id]);

            $searchFriend = new FriendsSearch();
            $searchFriend->selfFriends = ArrayHelper::getColumn($model->getAllFriendArrayId(), 'friend_id');

            $dataProvider = $searchFriend->search(Yii::$app->request->post());

            return $this->render('index', [
                'model' => $model,
                'searchFriend' => $searchFriend,
                'dataProvider' => $dataProvider
            ]);
        }

        public function actionAdd($id, $return = 'index'){
            $friend = new Friends([
                                      'user_id' => Yii::$app->user->id,
                                      'friend_id' => $id
                                  ]);
            $friend->save();
            return $this->redirect($return);
        }

        public function actionRemove($id){
            Friends::findOne($id)
                   ->delete();

            return $this->redirect('index');
        }

    }
