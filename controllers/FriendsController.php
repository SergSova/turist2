<?php

    namespace app\controllers;

    use Yii;
    use app\models\Friends;
    use app\models\search\FriendsSearch;
    use yii\helpers\ArrayHelper;
    use yii\web\Controller;
    use yii\filters\VerbFilter;

    /**
     * FriendsController implements the CRUD actions for Friends model.
     */
    class FriendsController extends Controller{
        /**
         * @inheritdoc
         */
        public function behaviors(){
            return [
                'verbs' => [
                    'class' => VerbFilter::className(),
                ],
            ];
        }

        /**
         * Lists all Friends models.
         * @return mixed
         */
        public function actionIndex(){
            return $this->render('index');
        }


        public function actionCreate(){
            $model = new Friends();
            $model->user_id = Yii::$app->user->id;
            $searchFriend = new FriendsSearch();
            $searchFriend->selfFriends = ArrayHelper::getColumn($model->getAllFriendArrayId(), 'friend_id');

            $dataProvider = $searchFriend->search(Yii::$app->request->post());

            if(Yii::$app->request->isAjax && $userId = Yii::$app->request->post('userId')){
                $model->addFriend($userId);
            }

            if(Yii::$app->request->isAjax && $userId = Yii::$app->request->post('removeId')){
                $model->removeFriend($userId);
            }

            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                return $this->render('_form', [
                    'model'        => $model,
                    'searchFriend' => $searchFriend,
                    'dataProvider' => $dataProvider
                ]);
            }
        }

    }
