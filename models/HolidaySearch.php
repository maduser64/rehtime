<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Holiday;

/**
 * HolidaySearch represents the model behind the search form about `app\models\Holiday`.
 */
class HolidaySearch extends Holiday
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FisYear'], 'integer'],
            [['PublicHoliday', 'Descripiton'], 'safe'],
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
        $query = Holiday::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             //จัดเรียงข้อมูลเริ่มต้น 
            'sort'=> ['defaultOrder' => ['PublicHoliday'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'FisYear' => $this->FisYear,
            'PublicHoliday' => $this->PublicHoliday,
        ]);

        $query->andFilterWhere(['like', 'Descripiton', $this->Descripiton]);

        return $dataProvider;
    }
}
