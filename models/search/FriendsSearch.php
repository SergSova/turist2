<?php

    namespace app\models\search;

    use app\models\User;
    use Yii;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;

    /**
     * FriendsSearch represents the model behind the search form about `app\models\Friends`.
     */
    class FriendsSearch extends User{
        public $selfId;
        public $selfFriends;

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
                        'id',
                        'rate'
                    ],
                    'integer'
                ],
                [
                    [
                        'username',
                        'password',
                        'auth_key',
                        'status',
                        'email',
                        'access_token',
                        'created_at',
                        'f_name',
                        'l_name'
                    ],
                    'safe'
                ],
            ];
        }

        /**
         * @inheritdoc
         */
        public function scenarios(){
            // bypass scenarios() implementation in the parent class
            return Model::scenarios();
        }

        /**
         * Creates data provider instance with search query applied
         *
         * @param array $params
         *
         * @return ActiveDataProvider
         */
        public function search($params){
            $query = User::find();

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                                                       'query' => $query,
                                                   ]);

            $this->load($params);

            if(!$this->validate()){
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            // grid filtering conditions

            $query->andFilterWhere([
                                       'not in',
                                       'id',
                                       Yii::$app->user->id
                                   ]);
            $query->andFilterWhere([
                                       'not in',
                                       'id',
                                       $this->selfFriends
                                   ]);

            $query->andFilterWhere([
                                       'like',
                                       'username',
                                       $this->username
                                   ]);

            return $dataProvider;
        }
    }
