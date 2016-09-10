<?php

    namespace app\models\search;

    use Yii;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;
    use app\models\Event;

    /**
     * EventSearch represents the model behind the search form about `app\models\Event`.
     */
    class EventSearch extends Event{
        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [['id', 'creator_id', 'rate', 'people_count', 'difficult'], 'integer'],
                [['title', 'event_type_id', 'desc', 'condition', 'date_start', 'date_end', 'date_creation', 'status'], 'safe'],
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
            $query = Event::find();

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                                                       'query' => $query,
                                                   ]);

            $this->load($params);

            if(!$this->validate()){
                return $dataProvider;
            }

            // grid filtering conditions
            $query->andFilterWhere([
                                       'id' => $this->id,

                                       'creator_id'    => $this->creator_id,
                                       'date_end'      => $this->date_end,
                                       'date_creation' => $this->date_creation,
                                       'rate'          => $this->rate,
                                       'people_count'  => $this->people_count,
                                       'difficult'     => $this->difficult,
                                   ]);

            $query->andFilterWhere(['like', 'title', $this->title])
                  ->andFilterWhere(['like', 'desc', $this->desc])
                  ->andFilterWhere(['>', 'date_start', date('Y-m-d',strtotime($this->date_start))])
                  ->andFilterWhere(['like', 'condition', $this->condition])
                  ->andFilterWhere(['like', 'status', $this->status])
                  ->andFilterWhere(['in', 'event_type_id', $this->event_type_id]);

            return $dataProvider;
        }

        public function searchCalendar($post){
            $events = $this->search($post)->models;
            $calEvents = [];
            /** @var Event $event */
            foreach($events as $event){
                $cur = new \yii2fullcalendar\models\Event();
                $cur->id = $event->id;
                $cur->title = $event->title;
                $cur->start = $event->date_start;
                $cur->end = $event->date_end;
                $cur->description = $event->desc;
                $cur->source = '<div class= "test">testContent</div>';
                $cur->url = Yii::$app->urlManager->createUrl([
                                                                 'event/view',
                                                                 'id' => $event->id
                                                             ]);
                switch($event->eventType->name){
                    case 'cash':
                        $cur->backgroundColor = 'green';
                        break;
                    case 'registred':
                        $cur->backgroundColor = 'red';
                        break;
                }
                $calEvents[] = $cur;
            }

            return $calEvents;
        }

    }
