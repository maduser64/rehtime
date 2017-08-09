<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Leavetype;

/**
 * LeavetypeSearch represents the model behind the search form about `app\models\Leavetype`.
 */
class LeavetypeSearch extends Leavetype
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leavetype_id', 'leavetype_status'], 'integer'],
            [['leavetype_name'], 'safe'],
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
        $query = Leavetype::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //จัดเรียงข้อมูลเริ่มต้น 
            'sort'=> ['defaultOrder' => ['leavetype_id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'leavetype_id' => $this->leavetype_id,
            'leavetype_status' => $this->leavetype_status,
        ]);

        $query->andFilterWhere(['like', 'leavetype_name', $this->leavetype_name]);

        return $dataProvider;
    }
}
