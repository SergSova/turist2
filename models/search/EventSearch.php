<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Event;

/**
 * EventSearch represents the model behind the search form about `app\models\Event`.
 */
class EventSearch extends Event
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'event_type_id', 'creator_id', 'rate'], 'integer'],
            [['title', 'photo', 'desc', 'organizators', 'particip', 'condition', 'date_start', 'date_end', 'date_creation', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Event::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'event_type_id' => $this->event_type_id,
            'creator_id' => $this->creator_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'date_creation' => $this->date_creation,
            'rate' => $this->rate,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'organizators', $this->organizators])
            ->andFilterWhere(['like', 'particip', $this->particip])
            ->andFilterWhere(['like', 'condition', $this->condition])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
