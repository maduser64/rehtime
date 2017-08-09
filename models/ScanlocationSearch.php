<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Scanlocation;

/**
 * ScanlocationSearch represents the model behind the search form about `app\models\Scanlocation`.
 */
class ScanlocationSearch extends Scanlocation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scan_id', 'status_id'], 'integer'],
            [['scan_ip', 'scan_location', 'last_update'], 'safe'],
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
        $query = Scanlocation::find();

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
            'scan_id' => $this->scan_id,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'scan_ip', $this->scan_ip])
            ->andFilterWhere(['like', 'scan_location', $this->scan_location])
            ->andFilterWhere(['like', 'last_update', $this->last_update]);

        return $dataProvider;
    }
}
