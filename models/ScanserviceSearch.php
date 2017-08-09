<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Scanservice;

/**
 * ScanserviceSearch represents the model behind the search form about `app\models\Scanservice`.
 */
class ScanserviceSearch extends Scanservice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'user_id', 'depart_id'], 'integer'],
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
        $query = Scanservice::find()->select('user_id')->distinct();
        //$total = YourMOdel::find()->select('company_name')->distinct()->count();

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
            'service_id' => $this->service_id,
            'user_id' => $this->user_id,
            'depart_id' => $this->depart_id,
        ]);

        return $dataProvider;
    }
}
